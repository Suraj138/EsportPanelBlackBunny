<?php

namespace App\Controllers;

use App\Models\KeysModel;
use App\Models\ShopConfig;
use App\Models\UserModel;

class Telegram extends BaseController
{
    public function hook()
    {
        $this->ensureTgColumns();
        $cfg = new ShopConfig();
        $bag = $cfg->bag();
        $secret = trim((string) ($bag['tg_webhook_secret'] ?? ''));
        $got = (string) $this->request->getGet('k');
        if ($secret === '' || !hash_equals($secret, $got)) {
            return $this->response->setStatusCode(403)->setJSON(['ok' => false]);
        }
        if (!hudRateLimit('tg_hook', 80, 60)) {
            return $this->response->setStatusCode(429)->setJSON(['ok' => false]);
        }
        $update = json_decode((string) $this->request->getBody(), true);
        if (!is_array($update)) {
            $update = $this->request->getJSON(true);
        }
        if (!is_array($update)) {
            return $this->response->setJSON(['ok' => true]);
        }
        if (!empty($update['callback_query']) && is_array($update['callback_query'])) {
            $this->onTap($update['callback_query']);
            return $this->response->setJSON(['ok' => true]);
        }
        $msg = $update['message'] ?? $update['edited_message'] ?? null;
        if (!is_array($msg)) {
            return $this->response->setJSON(['ok' => true]);
        }
        $chat = $msg['chat'] ?? [];
        $from = $msg['from'] ?? [];
        $chatId = (string) ($chat['id'] ?? '');
        $fromId = (string) ($from['id'] ?? $chatId);
        $text = trim((string) ($msg['text'] ?? ''));
        if ($chatId === '' || $text === '') {
            return $this->response->setJSON(['ok' => true]);
        }
        $this->onText($chatId, $fromId, $text);
        return $this->response->setJSON(['ok' => true]);
    }

    private function findLinked($chatId, $fromId = '')
    {
        $userModel = new UserModel();
        $user = $userModel->where('tg_chat_id', $chatId)->first();
        if (!$user && $fromId !== '') {
            $user = $userModel->where('tg_chat_id', $fromId)->first();
        }
        if (is_array($user)) {
            $user = (object) $user;
        }
        return $user ?: null;
    }

    private function onText($chatId, $fromId, $text)
    {
        $parts = preg_split('/\s+/', $text, 8);
        $cmd = strtolower(explode('@', (string) ($parts[0] ?? ''))[0]);
        $user = $this->findLinked($chatId, $fromId);

        if ($cmd === '/start' || $cmd === 'start') {
            $code = strtoupper((string) ($parts[1] ?? ''));
            if ($code !== '' && preg_match('/^[A-Z0-9]{6,12}$/', $code)) {
                $this->linkAccount($chatId, $fromId, $code);
                return;
            }
            if ($user && panelUserAlive($user)) {
                $this->sendMenu($chatId, $user);
                return;
            }
            tgSend($chatId, "BLACK BUNNY BOT\nPanel -> Telegram Bot -> MAKE LINK CODE\nPhir yahan bhejo:\n/start CODE");
            return;
        }

        if (!$user || !panelUserAlive($user)) {
            tgSend($chatId, "Linked nahi. Panel Telegram Bot page se LINK CODE lo.");
            return;
        }
        $tap = tgTapLabel($text);
        if ($tap === 'GENERATE' || strpos($tap, 'GENERATE') !== false) {
            $this->askHours($chatId);
            return;
        }
        if (strpos($tap, 'MY KEYS') !== false || $tap === 'KEYS') {
            $this->sendList($user, $chatId, 1);
            return;
        }
        if (strpos($tap, 'RADAR') !== false) {
            $this->sendRadar($user, $chatId);
            return;
        }
        if (strpos($tap, 'PRICES') !== false) {
            $this->sendPrices($chatId);
            return;
        }
        if (strpos($tap, 'QUICK 5H') !== false) {
            $this->dropKeys($user, $chatId, 5, 1, 1);
            return;
        }
        if (strpos($tap, 'QUICK 1D') !== false) {
            $this->dropKeys($user, $chatId, 24, 1, 1);
            return;
        }
        if (strpos($tap, 'QUICK 7D') !== false) {
            $this->dropKeys($user, $chatId, 168, 1, 1);
            return;
        }
        if (strpos($tap, 'ACCOUNT') !== false) {
            $this->sendMenu($chatId, $user, true);
            return;
        }
        if (strpos($tap, 'UNLINK') !== false) {
            tgSend($chatId, "Unlink this Telegram?", [
                'inline_keyboard' => [[
                    ['text' => '[!] YES UNLINK', 'callback_data' => 'm:ux'],
                    ['text' => '[<] CANCEL', 'callback_data' => 'm:home'],
                ]],
            ]);
            return;
        }
        $this->sendMenu($chatId, $user);
    }

    private function onTap($cq)
    {
        $data = (string) ($cq['data'] ?? '');
        $fromId = (string) ($cq['from']['id'] ?? '');
        $chatId = (string) ($cq['message']['chat']['id'] ?? $fromId);
        $cqId = (string) ($cq['id'] ?? '');
        $user = $this->findLinked($chatId, $fromId);
        if (!$user || !panelUserAlive($user)) {
            tgAnswer($cqId, 'Link first');
            tgSend($chatId, "Linked nahi. Panel se LINK CODE lo.");
            return;
        }
        tgAnswer($cqId);
        $bits = explode(':', $data);
        $a = $bits[0] ?? '';
        $b = $bits[1] ?? '';
        $c = $bits[2] ?? '';
        if ($a === 'm' && $b === 'gen') {
            $this->askHours($chatId);
            return;
        }
        if ($a === 'm' && $b === 'me') {
            $this->sendMenu($chatId, $user, true);
            return;
        }
        if ($a === 'm' && $b === 'rad') {
            $this->sendRadar($user, $chatId);
            return;
        }
        if ($a === 'm' && $b === 'pay') {
            $this->sendPrices($chatId);
            return;
        }
        if ($a === 'm' && $b === 'live') {
            $this->sendList($user, $chatId, 1, 'live');
            return;
        }
        if ($a === 'm' && $b === 'un') {
            tgSend($chatId, "Unlink this Telegram?", [
                'inline_keyboard' => [[
                    ['text' => '[!] YES UNLINK', 'callback_data' => 'm:ux'],
                    ['text' => '[<] CANCEL', 'callback_data' => 'm:home'],
                ]],
            ]);
            return;
        }
        if ($a === 'm' && $b === 'ux') {
            (new UserModel())->update($user->id_users, ['tg_chat_id' => '', 'tg_link_code' => '', 'tg_link_exp' => null]);
            tgStateClear($chatId);
            writeAudit('tg_unlink', $chatId, $user->username);
            tgSend($chatId, "Unlinked.");
            return;
        }
        if ($a === 'm' && $b === 'home') {
            $this->sendMenu($chatId, $user);
            return;
        }
        if ($a === 'g' && $b === 'h') {
            tgStatePut($chatId, ['h' => (int) $c]);
            $this->askDevices($chatId, (int) $c);
            return;
        }
        if ($a === 'g' && $b === 'd') {
            $st = tgStateGet($chatId);
            $st['d'] = max(1, (int) $c);
            tgStatePut($chatId, $st);
            $this->askCount($chatId, (int) ($st['h'] ?? 0), (int) $st['d']);
            return;
        }
        if ($a === 'g' && $b === 'n') {
            $st = tgStateGet($chatId);
            $st['n'] = max(1, (int) $c);
            tgStatePut($chatId, $st);
            $this->askConfirm($chatId, $user, (int) ($st['h'] ?? 0), (int) ($st['d'] ?? 1), (int) $st['n']);
            return;
        }
        if ($a === 'g' && $b === 'ok') {
            $st = tgStateGet($chatId);
            $this->dropKeys($user, $chatId, (int) ($st['h'] ?? 0), (int) ($st['d'] ?? 1), (int) ($st['n'] ?? 1));
            return;
        }
        if ($a === 'q') {
            $hours = (int) $b;
            $this->dropKeys($user, $chatId, $hours, 1, 1);
            return;
        }
        if ($a === 'l') {
            $mode = 'all';
            $page = $b;
            if ($b === 'u' || strpos((string) $b, 'u') === 0) {
                $mode = 'unused';
                $page = substr((string) $b, 1);
            }
            $this->sendList($user, $chatId, max(1, (int) $page), $mode);
            return;
        }
        if ($a === 'k') {
            $this->keyAction($user, $chatId, $b, (int) $c);
            return;
        }
        if ($a === 'o') {
            $this->orderTap($user, $chatId, $b, (int) $c);
            return;
        }
        if ($a === 'w') {
            $this->walletTap($user, $chatId, $b, (int) $c);
            return;
        }
        $this->sendMenu($chatId, $user);
    }

    private function sendMenu($chatId, $user, $detail = false)
    {
        $stats = $this->userStats($user);
        $text = "[ BLACK BUNNY HUD ]\n"
            . getLevel((int) $user->level) . " @" . $user->username
            . "\nSaldo Rs " . (int) $user->saldo
            . "\nKeys {$stats['total']} · Used {$stats['used']} · Live {$stats['online']}"
            . "\nBottom pad se tap. Type nahi.";
        if ($detail) {
            $text = $this->meText($user, $stats);
        }
        tgSend($chatId, $text, tgPadMarkup());
        tgSend($chatId, "Quick deck:", tgMenuMarkup());
    }

    private function meText($user, $stats = null)
    {
        $stats = $stats ?: $this->userStats($user);
        return "[ ACCOUNT ]\nUSER " . $user->username
            . "\nROLE " . getLevel((int) $user->level)
            . "\nSALDO Rs " . (int) $user->saldo
            . "\nKEYS {$stats['total']}  USED {$stats['used']}  IDLE {$stats['unused']}"
            . "\nLIVE {$stats['online']}"
            . "\nEXP " . ((string) ($user->expiration_date ?? '-') ?: '-')
            . "\nCHAT " . (string) ($user->tg_chat_id ?? '');
    }

    private function userStats($user)
    {
        $db = \Config\Database::connect();
        $base = $db->table('keys_code');
        if ((int) $user->level !== 1) {
            $base->where('registrator', $user->username);
        }
        $total = $base->countAllResults(false);
        $usedQ = $db->table('keys_code');
        if ((int) $user->level !== 1) {
            $usedQ->where('registrator', $user->username);
        }
        $usedQ->groupStart()->where('devices IS NOT NULL', null, false)->where('devices !=', '')->groupEnd();
        $used = $usedQ->countAllResults();
        $liveQ = $db->table('keys_code')->where('last_ping >=', date('Y-m-d H:i:s', time() - 180));
        if ((int) $user->level !== 1) {
            $liveQ->where('registrator', $user->username);
        }
        $online = $liveQ->countAllResults();
        return [
            'total' => (int) $total,
            'used' => (int) $used,
            'unused' => max(0, (int) $total - (int) $used),
            'online' => (int) $online,
        ];
    }

    private function sendRadar($user, $chatId)
    {
        $s = $this->userStats($user);
        $fill = $s['total'] > 0 ? (int) round(($s['used'] / $s['total']) * 100) : 0;
        tgSend($chatId, "[ RADAR ]\nTOTAL {$s['total']}\nUSED {$s['used']}\nIDLE {$s['unused']}\nLIVE {$s['online']}\nFILL {$fill}%\nSALDO Rs " . (int) $user->saldo, tgMenuMarkup());
    }

    private function sendPrices($chatId)
    {
        $p = licensePriceTable();
        $lines = "[ PRICE TABLE / 1 DEVICE ]\n";
        foreach ($p as $h => $rs) {
            $lines .= hoursToDays($h) . "  Rs {$rs}\n";
        }
        $lines .= "\nDevices x price. Quick 5H / 1D / 7D bottom pad pe.";
        tgSend($chatId, $lines, [
            'inline_keyboard' => [
                [
                    ['text' => '[>] 5H NOW', 'callback_data' => 'q:5'],
                    ['text' => '[>] 1D NOW', 'callback_data' => 'q:24'],
                    ['text' => '[>] 7D NOW', 'callback_data' => 'q:168'],
                ],
                [['text' => '[+] CUSTOM', 'callback_data' => 'm:gen'], ['text' => '[#] MENU', 'callback_data' => 'm:home']],
            ],
        ]);
    }

    private function askHours($chatId)
    {
        $rows = [
            [['text' => '[2H]', 'callback_data' => 'g:h:2'], ['text' => '[5H]', 'callback_data' => 'g:h:5'], ['text' => '[1D]', 'callback_data' => 'g:h:24']],
            [['text' => '[3D]', 'callback_data' => 'g:h:72'], ['text' => '[7D]', 'callback_data' => 'g:h:168'], ['text' => '[14D]', 'callback_data' => 'g:h:336']],
            [['text' => '[30D]', 'callback_data' => 'g:h:720'], ['text' => '[60D]', 'callback_data' => 'g:h:1440'], ['text' => '[6M]', 'callback_data' => 'g:h:4320']],
            [['text' => '[1Y]', 'callback_data' => 'g:h:8760'], ['text' => '[<] MENU', 'callback_data' => 'm:home']],
        ];
        tgSend($chatId, "[ GENERATE ]\nDuration choose:", ['inline_keyboard' => $rows]);
    }

    private function askDevices($chatId, $hours)
    {
        $rows = [[
            ['text' => '[1 DEV]', 'callback_data' => 'g:d:1'],
            ['text' => '[2 DEV]', 'callback_data' => 'g:d:2'],
            ['text' => '[3 DEV]', 'callback_data' => 'g:d:3'],
            ['text' => '[5 DEV]', 'callback_data' => 'g:d:5'],
        ], [['text' => '[<] MENU', 'callback_data' => 'm:home']]];
        tgSend($chatId, "[ GENERATE ] " . hoursToDays($hours) . "\nDevices:", ['inline_keyboard' => $rows]);
    }

    private function askCount($chatId, $hours, $devices)
    {
        $rows = [[
            ['text' => '[1 KEY]', 'callback_data' => 'g:n:1'],
            ['text' => '[3 KEYS]', 'callback_data' => 'g:n:3'],
            ['text' => '[5 KEYS]', 'callback_data' => 'g:n:5'],
            ['text' => '[10 KEYS]', 'callback_data' => 'g:n:10'],
        ], [['text' => '[<] MENU', 'callback_data' => 'm:home']]];
        tgSend($chatId, "[ GENERATE ] " . hoursToDays($hours) . " · {$devices} dev\nKitni keys?", ['inline_keyboard' => $rows]);
    }

    private function askConfirm($chatId, $user, $hours, $devices, $count)
    {
        $prices = licensePriceTable();
        $fees = (int) getPrice($prices, $hours, $devices) * max(1, $count);
        $rows = [[
            ['text' => '[!] FIRE GENERATE', 'callback_data' => 'g:ok'],
            ['text' => '[x] CANCEL', 'callback_data' => 'm:home'],
        ]];
        tgSend($chatId, "[ CONFIRM ]\nDROP {$count} · " . hoursToDays($hours) . " · {$devices} dev\nCost Rs {$fees}\nSaldo Rs " . (int) $user->saldo, ['inline_keyboard' => $rows]);
    }

    private function dropKeys($user, $chatId, $hours, $devices, $count)
    {
        $fresh = (new UserModel())->getUser($user->id_users, 'id_users');
        if ($fresh) {
            $user = $fresh;
        }
        $out = forgePanelKeys($user, $hours, $devices, $count);
        tgStateClear($chatId);
        if (empty($out['ok'])) {
            tgSend($chatId, $out['msg'] ?? 'Generate fail', tgMenuMarkup());
            return;
        }
        $lines = "[ DROP OK ] " . count($out['keys']) . " · {$out['hours']}h · {$out['devices']} dev · -Rs {$out['fees']}\nSALDO Rs {$out['saldo']}\n";
        foreach ($out['keys'] as $k) {
            $lines .= "\n" . $k;
        }
        tgSend($chatId, $lines, tgMenuMarkup());
    }

    private function sendList($user, $chatId, $page, $mode = 'all')
    {
        $limit = 5;
        $offset = ($page - 1) * $limit;
        $model = new KeysModel();
        if ((int) $user->level !== 1) {
            $model->where('registrator', $user->username);
        }
        if ($mode === 'unused') {
            $model->groupStart()->where('devices', null)->orWhere('devices', '')->groupEnd();
        } elseif ($mode === 'live') {
            $model->where('last_ping >=', date('Y-m-d H:i:s', time() - 180));
        }
        $rows = $model->orderBy('id_keys', 'DESC')->findAll($limit, $offset);
        if (!$rows) {
            tgSend($chatId, "No keys page {$page}.", tgMenuMarkup());
            return;
        }
        $tag = $mode === 'unused' ? 'UNUSED' : ($mode === 'live' ? 'LIVE' : 'KEYS');
        $out = "[ {$tag} p{$page} ]\nTap key to manage.";
        $kb = [];
        foreach ($rows as $row) {
            $row = (object) $row;
            $st = ((int) ($row->status ?? 1) === 1) ? '+' : 'x';
            $short = substr((string) $row->user_key, 0, 22);
            $kb[] = [['text' => "[{$st}] {$short}", 'callback_data' => 'k:i:' . (int) $row->id_keys]];
        }
        $prefix = $mode === 'unused' ? 'u' : '';
        $nav = [];
        if ($page > 1) {
            $nav[] = ['text' => '[<] PREV', 'callback_data' => 'l:' . $prefix . ($page - 1)];
        }
        $nav[] = ['text' => '[>] NEXT', 'callback_data' => 'l:' . $prefix . ($page + 1)];
        $nav[] = ['text' => '[#] MENU', 'callback_data' => 'm:home'];
        $kb[] = $nav;
        tgSend($chatId, $out, ['inline_keyboard' => $kb]);
    }

    private function keyAction($user, $chatId, $act, $id)
    {
        $row = $this->ownKeyById($user, $id);
        if (!$row) {
            tgSend($chatId, "Key nahi mili / allowed nahi.", tgMenuMarkup());
            return;
        }
        $model = new KeysModel();
        if ($act === 'b') {
            $model->update($row->id_keys, ['status' => 0]);
            writeAudit('tg_block', $row->user_key, $user->username);
            tgSend($chatId, "BLOCK " . $row->user_key, $this->keyMarkup($row, 0));
            return;
        }
        if ($act === 'u') {
            $model->update($row->id_keys, ['status' => 1]);
            writeAudit('tg_unblock', $row->user_key, $user->username);
            tgSend($chatId, "UNBLOCK " . $row->user_key, $this->keyMarkup($row, 1));
            return;
        }
        if ($act === 'r') {
            $model->update($row->id_keys, ['devices' => null]);
            writeAudit('hwid_reset', $row->user_key, $user->username);
            tgSend($chatId, "HWID RESET " . $row->user_key, $this->keyMarkup($row, (int) $row->status));
            return;
        }
        if ($act === 'x') {
            tgSend($chatId, "Delete {$row->user_key} ?", [
                'inline_keyboard' => [[
                    ['text' => '[!] YES DELETE', 'callback_data' => 'k:z:' . (int) $row->id_keys],
                    ['text' => '[<] NO', 'callback_data' => 'k:i:' . (int) $row->id_keys],
                ]],
            ]);
            return;
        }
        if ($act === 'z') {
            $model->where('id_keys', $row->id_keys)->delete();
            writeAudit('key_delete', $row->user_key, $user->username);
            tgSend($chatId, "[ DELETED ] " . $row->user_key, tgMenuMarkup());
            return;
        }
        if ($act === 'c') {
            tgSend($chatId, $row->user_key, $this->keyMarkup($row, (int) $row->status));
            return;
        }
        $dev = $row->devices ? str_replace(',', "\n ", (string) $row->devices) : '-';
        $st = ((int) $row->status === 1) ? 'ACTIVE' : 'BLOCKED';
        tgSend($chatId, "[ KEY ] {$row->user_key}\n{$st} {$row->duration}h\nDEV {$row->max_devices}\nREG {$row->registrator}\nEXP " . ($row->expired_date ?: 'unused') . "\nHWID\n {$dev}", $this->keyMarkup($row, (int) $row->status));
    }

    private function keyMarkup($row, $status)
    {
        $id = (int) $row->id_keys;
        $toggle = ((int) $status === 1)
            ? ['text' => '[!] BLOCK', 'callback_data' => 'k:b:' . $id]
            : ['text' => '[+] UNBLOCK', 'callback_data' => 'k:u:' . $id];
        return [
            'inline_keyboard' => [
                [$toggle, ['text' => '[~] RESET HWID', 'callback_data' => 'k:r:' . $id]],
                [['text' => '[=] COPY', 'callback_data' => 'k:c:' . $id], ['text' => '[x] DELETE', 'callback_data' => 'k:x:' . $id]],
                [['text' => '[#] MY KEYS', 'callback_data' => 'l:1'], ['text' => '[<] MENU', 'callback_data' => 'm:home']],
            ],
        ];
    }

    private function ownKeyById($user, $id)
    {
        $id = (int) $id;
        if ($id < 1) {
            return null;
        }
        $row = (new KeysModel())->getKeys($id, 'id_keys');
        if (!$row || !canTouchLicense($user, $row)) {
            return null;
        }
        return $row;
    }

    private function orderTap($user, $chatId, $act, $oid)
    {
        if ((int) $user->level > 2) {
            tgSend($chatId, "Owner/Admin only.", tgMenuMarkup());
            return;
        }
        if ($act === 'a') {
            $out = shopVerifyOrder($oid, $user);
            tgSend($chatId, $out['msg'] ?? 'Fail', tgMenuMarkup());
            return;
        }
        if ($act === 'r') {
            $out = shopRejectOrder($oid, $user);
            tgSend($chatId, $out['msg'] ?? 'Fail', tgMenuMarkup());
            return;
        }
        tgSend($chatId, "Unknown order tap.", tgMenuMarkup());
    }

    private function walletTap($user, $chatId, $act, $id)
    {
        if ((int) $user->level !== 1) {
            tgSend($chatId, "Owner only.", tgMenuMarkup());
            return;
        }
        if ($act === 'a') {
            $out = walletApprove($id, $user);
            tgSend($chatId, $out['msg'] ?? 'Fail', tgMenuMarkup());
            return;
        }
        if ($act === 'r') {
            $out = walletReject($id, $user);
            tgSend($chatId, $out['msg'] ?? 'Fail', tgMenuMarkup());
            return;
        }
        tgSend($chatId, "Unknown wallet tap.", tgMenuMarkup());
    }

    private function linkAccount($chatId, $fromId, $code)
    {
        $userModel = new UserModel();
        $row = $userModel->where('tg_link_code', $code)->first();
        if (is_array($row)) {
            $row = (object) $row;
        }
        if (!$row || empty($row->tg_link_exp) || strtotime((string) $row->tg_link_exp) < time()) {
            tgSend($chatId, "Code invalid / expired. Settings se naya lo.");
            return;
        }
        if (!panelUserAlive($row)) {
            tgSend($chatId, "Account band hai.");
            return;
        }
        $taken = $userModel->where('tg_chat_id', $chatId)->first();
        if (is_array($taken)) {
            $taken = (object) $taken;
        }
        if ($taken && (int) $taken->id_users !== (int) $row->id_users) {
            tgSend($chatId, "Ye Telegram pehle se dusre account pe hai. /unlink wahan pehle.");
            return;
        }
        $userModel->update($row->id_users, [
            'tg_chat_id' => $chatId,
            'tg_link_code' => '',
            'tg_link_exp' => null,
        ]);
        writeAudit('tg_link', $chatId, $row->username);
        $this->sendMenu($chatId, $row);
    }

    public function index()
    {
        $userModel = new UserModel();
        $user = $userModel->getUser();
        if (!$user) {
            return redirect()->to('login')->with('msgWarning', 'Please login first');
        }
        $this->ensureTgColumns();
        $cfg = new ShopConfig();
        $bag = $cfg->bag();
        $tgToken = trim((string) ($bag['tg_bot_token'] ?? ''));
        $secret = trim((string) ($bag['tg_webhook_secret'] ?? ''));
        $health = tgBotHealth();
        return view('User/telegram', [
            'title' => 'Telegram Bot',
            'user' => $user,
            'time' => new \CodeIgniter\I18n\Time,
            'tg_chat_id' => isset($user->tg_chat_id) ? trim((string) $user->tg_chat_id) : '',
            'tg_link_code' => isset($user->tg_link_code) ? trim((string) $user->tg_link_code) : '',
            'tg_link_exp' => isset($user->tg_link_exp) ? (string) $user->tg_link_exp : '',
            'tg_bot_set' => $tgToken !== '',
            'tg_bot_masked' => $health['masked'] ?: ($tgToken === '' ? '' : substr($tgToken, 0, 8) . '...' . substr($tgToken, -5)),
            'tg_webhook' => $secret !== '' ? site_url('telegram/hook?k=' . $secret) : '',
            'tg_health' => $health,
        ]);
    }

    public function setup()
    {
        $user = (new UserModel())->getUser();
        if (!$user || (int) $user->level !== 1) {
            return redirect()->to('telegram')->with('msgDanger', 'Owner only.');
        }
        $this->ensureTgColumns();
        $cfg = new ShopConfig();
        if ($this->request->getPost('tg_save')) {
            $token = trim((string) $this->request->getPost('tg_bot_token'));
            if ($token !== '' && !preg_match('/^\d+:[A-Za-z0-9_-]{20,}$/', $token)) {
                return redirect()->to('telegram')->with('msgDanger', 'Bot token format galat.');
            }
            $secret = trim((string) ($cfg->bag()['tg_webhook_secret'] ?? ''));
            if ($secret === '') {
                $secret = bin2hex(random_bytes(12));
            }
            $cfg->putMany([
                'tg_bot_token' => $token,
                'tg_webhook_secret' => $secret,
            ]);
            writeAudit('tg_bot_save', $token ? 'token set' : 'token cleared', $user->username);
            if ($token !== '') {
                $hook = site_url('telegram/hook?k=' . $secret);
                $res = tgApi('setWebhook', [
                    'url' => $hook,
                    'drop_pending_updates' => true,
                    'allowed_updates' => ['message', 'callback_query'],
                    'secret_token' => $secret,
                ]);
                if (empty($res['ok'])) {
                    return redirect()->to('telegram')->with('msgWarning', 'Token save. Webhook fail: ' . ($res['description'] ?? 'api'));
                }
                return redirect()->to('telegram')->with('msgSuccess', 'Bot live. Webhook set.');
            }
            return redirect()->to('telegram')->with('msgSuccess', 'Bot token cleared.');
        }
        if ($this->request->getPost('tg_unlink_user')) {
            $uid = (int) $this->request->getPost('tg_unlink_user');
            $target = (new UserModel())->getUser($uid, 'id_users');
            if ($target) {
                (new UserModel())->update($uid, ['tg_chat_id' => '', 'tg_link_code' => '', 'tg_link_exp' => null]);
                writeAudit('tg_unlink_admin', $target->username, $user->username);
            }
            return redirect()->to('telegram')->with('msgSuccess', 'Telegram unlinked.');
        }
        return redirect()->to('telegram');
    }

    public function link()
    {
        $userModel = new UserModel();
        $user = $userModel->getUser();
        if (!$user) {
            return redirect()->to('login');
        }
        $this->ensureTgColumns();
        if ($this->request->getPost('tg_make_code')) {
            $code = strtoupper(substr(bin2hex(random_bytes(5)), 0, 8));
            $userModel->update($user->id_users, [
                'tg_link_code' => $code,
                'tg_link_exp' => date('Y-m-d H:i:s', time() + 600),
            ]);
            writeAudit('tg_link_code', $code, $user->username);
            return redirect()->to('telegram')->with('msgSuccess', 'Bot me bhejo: /start ' . $code);
        }
        if ($this->request->getPost('tg_self_unlink')) {
            $userModel->update($user->id_users, ['tg_chat_id' => '', 'tg_link_code' => '', 'tg_link_exp' => null]);
            writeAudit('tg_unlink', 'self', $user->username);
            return redirect()->to('telegram')->with('msgSuccess', 'Telegram unlinked.');
        }
        return redirect()->to('telegram');
    }

    private function ensureTgColumns()
    {
        ensureTgUserColumns();
    }
}
