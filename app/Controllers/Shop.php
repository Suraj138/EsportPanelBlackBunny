<?php

namespace App\Controllers;

use App\Models\KeysModel;
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
        return view('Shop/index', [
            'cfg' => $cfg,
            'plans' => (new ShopPlan())->publicList(),
            'media' => (new ShopMedia())->gallery(),
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

    public function control()
    {
        $user = (new UserModel())->getUser();
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
            ];
            $pairs = [];
            foreach ($fields as $f) {
                $pairs[$f] = (string) $this->request->getPost($f);
            }
            $pairs['page_on'] = $this->request->getPost('page_on') ? '1' : '0';
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
            $oid = (int) $this->request->getPost('order_id');
            $order = $orderModel->find($oid);
            if ($order && $order['status'] === 'pending') {
                $plan = $planModel->find((int) $order['plan_id']);
                $hours = $plan ? (int) $plan['hours'] : 24;
                $devices = $plan ? (int) $plan['devices'] : 1;
                $license = 'SHOP-' . $hours . '-' . random_string('alnum', 6);
                (new KeysModel())->insert([
                    'game' => 'PUBG',
                    'user_key' => $license,
                    'duration' => $hours,
                    'max_devices' => $devices,
                    'registrator' => $user->username,
                    'created_by' => (int) session('userid'),
                ]);
                $orderModel->update($oid, [
                    'status' => 'verified',
                    'issued_key' => $license,
                    'verified_by' => $user->username,
                ]);
                writeAudit('shop_verify', 'order#' . $oid . ' key=' . $license, $user->username);
                $cfgNow = $cfgModel->bag();
                $msg = 'BLACK BUNNY KEY READY%0AOrder #' . $oid . '%0AKey: ' . $license . '%0ATxn: ' . rawurlencode((string) $order['txn_id']);
                $phone = waDigits($order['customer_phone'] ?: ($cfgNow['owner_whatsapp'] ?? ''));
                if ($phone) {
                    hudNotify('https://wa.me/' . $phone . '?text=' . $msg);
                }
                if (!empty($cfgNow['telegram_support'])) {
                    hudNotify($cfgNow['telegram_support']);
                }
                return redirect()->to('public-control')->with('msgSuccess', 'Order verified. Key: ' . $license . ' · ping sent');
            }
        }

        if ($this->request->getPost('reject_order')) {
            $oid = (int) $this->request->getPost('order_id');
            $order = $orderModel->find($oid);
            if ($order && $order['status'] === 'pending') {
                $orderModel->update($oid, ['status' => 'rejected', 'verified_by' => $user->username]);
                writeAudit('shop_reject', 'order#' . $oid, $user->username);
                return redirect()->to('public-control')->with('msgSuccess', 'Order rejected.');
            }
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
