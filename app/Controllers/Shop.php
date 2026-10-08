<?php

namespace App\Controllers;

use App\Models\ShopConfig;
use App\Models\ShopMedia;
use App\Models\ShopOrder;
use App\Models\ShopPlan;
use App\Models\UserModel;
use CodeIgniter\Config\Services;

class Shop extends BaseController
{
    protected function cfg()
    {
        return (new ShopConfig())->bag();
    }

    protected function pageOn()
    {
        $cfg = $this->cfg();
        return !isset($cfg['page_on']) || $cfg['page_on'] === '1';
    }

    public function index()
    {
        $cfg = $this->cfg();
        if (!$this->pageOn()) {
            return view('Shop/offline', ['cfg' => $cfg]);
        }
        $feat = [];
        try {
            $feat = (new \App\Models\Feature())->find(1) ?: [];
        } catch (\Throwable $e) {
            $feat = [];
        }
        return view('Shop/index', [
            'cfg' => $cfg,
            'plans' => (new ShopPlan())->publicList(),
            'media' => (new ShopMedia())->gallery(),
            'feat' => $feat,
        ]);
    }

    public function legal($page = 'privacy')
    {
        $cfg = $this->cfg();
        if (!$this->pageOn()) {
            return view('Shop/offline', ['cfg' => $cfg]);
        }
        $map = [
            'privacy' => ['Privacy Policy', $cfg['privacy_text'] ?? ''],
            'terms' => ['Terms of Service', $cfg['terms_text'] ?? ''],
            'refund' => ['Refund Policy', $cfg['refund_text'] ?? ''],
            'about' => ['About', $cfg['about_text'] ?? ''],
            'contact' => ['Contact', $cfg['contact_text'] ?? ''],
        ];
        if (!isset($map[$page])) {
            $page = 'privacy';
        }
        return view('Shop/legal', [
            'cfg' => $cfg,
            'heading' => $map[$page][0],
            'body' => $map[$page][1],
            'page' => $page,
        ]);
    }

    public function buy($planId = 0)
    {
        $cfg = $this->cfg();
        if (!$this->pageOn()) {
            return view('Shop/offline', ['cfg' => $cfg]);
        }
        $plan = (new ShopPlan())->find((int) $planId);
        if (!$plan || !(int) $plan['visible']) {
            return redirect()->to('shop')->with('msgDanger', 'Plan is not available.');
        }
        return view('Shop/buy', [
            'cfg' => $cfg,
            'plan' => $plan,
        ]);
    }

    public function order()
    {
        if (!hudRateLimit('shop_order', 6, 600)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Too many orders. Wait and retry.');
        }
        $cfg = $this->cfg();
        if (!$this->pageOn()) {
            return redirect()->to('shop');
        }
        $plan = (new ShopPlan())->find((int) $this->request->getPost('plan_id'));
        if (!$plan || !(int) $plan['visible']) {
            return redirect()->to('shop')->with('msgDanger', 'Plan is not available.');
        }
        $rules = [
            'customer_name' => 'required|min_length[2]|max_length[80]',
            'customer_phone' => 'required|min_length[8]|max_length[32]',
            'txn_id' => 'required|min_length[4]|max_length[80]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('msgDanger', 'Check name, phone and UPI txn id.');
        }
        $orderModel = new ShopOrder();
        $id = $orderModel->insert([
            'plan_id' => (int) $plan['id'],
            'customer_name' => esc($this->request->getPost('customer_name')),
            'customer_phone' => esc($this->request->getPost('customer_phone')),
            'customer_note' => esc((string) $this->request->getPost('customer_note')),
            'txn_id' => esc($this->request->getPost('txn_id')),
            'amount' => (int) $plan['price'],
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        writeAudit('shop_order', 'order#' . $id . ' plan=' . $plan['title'], 'public');
        pingShopOrder($id, $plan);
        return redirect()->to('shop/thanks/' . $id);
    }

    public function thanks($id = 0)
    {
        $cfg = $this->cfg();
        $order = (new ShopOrder())->find((int) $id);
        if (!$order) {
            return redirect()->to('shop');
        }
        $plan = (new ShopPlan())->find((int) $order['plan_id']);
        return view('Shop/thanks', [
            'cfg' => $cfg,
            'order' => $order,
            'plan' => $plan,
        ]);
    }

    public function status($id = 0)
    {
        $order = (new ShopOrder())->find((int) $id);
        if (!$order) {
            return $this->response->setStatusCode(404)->setJSON(['ok' => false]);
        }
        return $this->response->setJSON([
            'ok' => true,
            'id' => (int) $order['id'],
            'status' => $order['status'],
            'issued_key' => $order['issued_key'] ?: '',
        ]);
    }

    public function lookup()
    {
        $cfg = $this->cfg();
        if (!$this->pageOn()) {
            return redirect()->to('shop');
        }
        if ($this->request->getPost()) {
            if (!hudRateLimit('shop_lookup', 8, 300)) {
                return redirect()->to('shop/lookup')->with('msgDanger', 'Too many lookups. Wait and retry.');
            }
            $phone = waDigits($this->request->getPost('customer_phone'));
            $txn = trim((string) $this->request->getPost('txn_id'));
            if ($phone === '' || $txn === '') {
                return redirect()->to('shop/lookup')->withInput()->with('msgDanger', 'Phone and txn id required.');
            }
            $order = (new ShopOrder())
                ->like('customer_phone', $phone)
                ->where('txn_id', $txn)
                ->orderBy('id', 'DESC')
                ->first();
            if (!$order) {
                return redirect()->to('shop/lookup')->withInput()->with('msgDanger', 'Order not found.');
            }
            return redirect()->to('shop/thanks/' . (int) $order['id']);
        }
        return view('Shop/lookup', ['cfg' => $cfg]);
    }

    public function lang($code = 'en')
    {
        $code = strtolower((string) $code) === 'hi' ? 'hi' : 'en';
        setcookie('bb_lang', $code, [
            'expires' => time() + 86400 * 400,
            'path' => '/',
            'samesite' => 'Lax',
        ]);
        $back = (string) $this->request->getServer('HTTP_REFERER');
        if ($back === '') {
            return redirect()->to('shop');
        }
        return redirect()->to($back);
    }

    public function control()
    {
        $user = (new UserModel())->getUser();
        if (!$user) {
            return redirect()->to('login')->with('msgWarning', 'Please login first');
        }
        if ((int) $user->level > 2) {
            return redirect()->to('dashboard')->with('msgWarning', 'Access Denied!');
        }
        $cfgModel = new ShopConfig();
        $planModel = new ShopPlan();
        $mediaModel = new ShopMedia();
        $orderModel = new ShopOrder();

        if ($this->request->getPost('save_page')) {
            $fields = [
                'page_on', 'hero_title', 'hero_sub', 'hero_type',
                'about_text', 'features_text', 'updates_text',
                'privacy_text', 'terms_text', 'refund_text', 'contact_text',
                'upi_id', 'upi_name', 'youtube_url', 'instagram_url',
                'telegram_url', 'telegram_support', 'owner_whatsapp', 'admin_whatsapp',
                'loader_name', 'loader_size', 'loader_game', 'apk_url',
            ];
            $pairs = [];
            foreach ($fields as $f) {
                $pairs[$f] = (string) $this->request->getPost($f);
            }
            $pairs['page_on'] = $this->request->getPost('page_on') ? '1' : '0';
            $apk = $this->request->getFile('apk_file');
            if ($apk && $apk->isValid() && !$apk->hasMoved()) {
                $ext = strtolower($apk->getExtension());
                if ($ext === 'apk') {
                    $dest = FCPATH . 'uploads/shop/';
                    if (!is_dir($dest)) {
                        mkdir($dest, 0755, true);
                    }
                    $name = 'blackbunny-loader.' . $ext;
                    $apk->move($dest, $name, true);
                    $pairs['apk_url'] = 'uploads/shop/' . $name;
                }
            }
            $hero = $this->request->getFile('hero_media');
            if ($hero && $hero->isValid() && !$hero->hasMoved()) {
                $ext = strtolower($hero->getExtension());
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'mp4', 'webm'], true)) {
                    $name = 'hero_' . time() . '.' . $ext;
                    $hero->move(FCPATH . 'uploads/shop/', $name, true);
                    $pairs['hero_media'] = 'uploads/shop/' . $name;
                    $pairs['hero_type'] = in_array($ext, ['mp4', 'webm'], true) ? 'video' : 'photo';
                }
            }
            $qr = $this->request->getFile('qr_image');
            if ($qr && $qr->isValid() && !$qr->hasMoved()) {
                $ext = strtolower($qr->getExtension());
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
                    $name = 'qr_' . time() . '.' . $ext;
                    $qr->move(FCPATH . 'uploads/shop/', $name, true);
                    $pairs['qr_image'] = 'uploads/shop/' . $name;
                }
            }
            $cfgModel->putMany($pairs);
            writeAudit('shop_page', 'updated public page', $user->username);
            return redirect()->to('public-control')->with('msgSuccess', 'Public page saved.');
        }

        if ($this->request->getPost('save_plan')) {
            $id = (int) $this->request->getPost('plan_id');
            $row = [
                'title' => esc($this->request->getPost('title')),
                'hours' => (int) $this->request->getPost('hours'),
                'price' => (int) $this->request->getPost('price'),
                'devices' => max(1, (int) $this->request->getPost('devices')),
                'badge' => esc((string) $this->request->getPost('badge')),
                'visible' => $this->request->getPost('visible') ? 1 : 0,
                'sort_order' => (int) $this->request->getPost('sort_order'),
            ];
            if ($id) {
                $planModel->update($id, $row);
            } else {
                $planModel->insert($row);
            }
            writeAudit('shop_plan', $row['title'], $user->username);
            return redirect()->to('public-control')->with('msgSuccess', 'Plan saved.');
        }

        if ($this->request->getPost('upload_media')) {
            $file = $this->request->getFile('media_file');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $ext = strtolower($file->getExtension());
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'mp4', 'webm'], true)) {
                    $name = 'g_' . time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $file->getName());
                    $file->move(FCPATH . 'uploads/shop/', $name, true);
                    $kind = in_array($ext, ['mp4', 'webm'], true) ? 'video' : 'photo';
                    $mediaModel->insert([
                        'kind' => $kind,
                        'file' => 'uploads/shop/' . $name,
                        'caption' => esc((string) $this->request->getPost('caption')),
                        'sort_order' => (int) $this->request->getPost('sort_order'),
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    writeAudit('shop_media', $name, $user->username);
                    return redirect()->to('public-control')->with('msgSuccess', 'Media uploaded.');
                }
            }
            return redirect()->to('public-control')->with('msgDanger', 'Upload a photo or video.');
        }

        if ($this->request->getPost('verify_order') && (int) $user->level <= 2) {
            $out = shopVerifyOrder((int) $this->request->getPost('order_id'), $user);
            if (!empty($out['wa'])) {
                session()->setFlashdata('shop_wa_ping', $out['wa']);
            }
            $key = !empty($out['ok']) ? 'msgSuccess' : 'msgDanger';
            $extra = (!empty($out['ok']) && !empty($out['wa'])) ? ' · open WhatsApp ping' : '';
            return redirect()->to('public-control')->with($key, ($out['msg'] ?? 'Fail') . $extra);
        }

        if ($this->request->getPost('delete_plan')) {
            $id = (int) $this->request->getPost('plan_id');
            if ($id) {
                $planModel->delete($id);
                writeAudit('shop_plan_del', 'plan#' . $id, $user->username);
            }
            return redirect()->to('public-control')->with('msgSuccess', 'Plan removed.');
        }

        if ($this->request->getPost('delete_media')) {
            $id = (int) $this->request->getPost('media_id');
            $row = $id ? $mediaModel->find($id) : null;
            if ($row) {
                $mediaModel->delete($id);
                writeAudit('shop_media_del', (string) ($row['file'] ?? $id), $user->username);
            }
            return redirect()->to('public-control')->with('msgSuccess', 'Media removed.');
        }

        if ($this->request->getPost('reject_order')) {
            $out = shopRejectOrder((int) $this->request->getPost('order_id'), $user);
            $key = !empty($out['ok']) ? 'msgSuccess' : 'msgDanger';
            return redirect()->to('public-control')->with($key, $out['msg'] ?? 'Fail');
        }

        return view('Shop/control', [
            'title' => 'Public Control',
            'user' => $user,
            'time' => new \CodeIgniter\I18n\Time,
            'cfg' => $cfgModel->bag(),
            'plans' => $planModel->allList(),
            'media' => $mediaModel->gallery(),
            'orders' => $orderModel->latest(40),
            'validation' => Services::validation(),
        ]);
    }
}
