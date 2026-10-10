<?php

/**
 * create_password
 *
 * @param  mixed $password
 * @param  mixed $enc
 * @return string
 */
function create_password($password, $enc = true)
{
    $optn = ['cost' => 8];
    $patt = "XquxmymXDtWRA66D";
    $hash = md5($patt . $password);
    $pass = password_hash($hash, PASSWORD_DEFAULT, $optn);
    return ($enc ? $pass : $hash);
}

function getName($user)
{
    if ($user->fullname) {
        return word_limiter($user->fullname, 1, '');
    } else {
        return $user->username;
    }
}

function getLevel($level = 0)
{
    switch ($level) {
        case '1':
            $a = 'Owner';
            break;
        case '2':
            $a = 'Admin';
            break;
        case '3':
            $a = 'User';
            break;
        default:
            $a = 'Unknown';
            break;
    }
    return $a;
}

function setMessage($msg, $color = 'secondary')
{
    return [$msg, $color];
}

function getDevice($devices)
{
    $total = 0;
    $listDevice = "";
    if ($devices) {
        $clean_comma = reduce_multiples($devices, ",", true);
        $ex = explode(',', $clean_comma);
        $listDevice = "";
        foreach ($ex as $ld) {
            $listDevice .= "$ld\n";
        }
        $total = count($ex);
    }
    return (object) ['total' => $total, 'devices' => trim($listDevice)];
}

function setDevice($devicesPost, $max)
{
    // dont touch this forever please -_-
    if ($devicesPost) {
        $clean_enter = reduce_multiples($devicesPost, "\n", true);
        $ez = [''];
        $ef = array_unique(array_filter(preg_replace("/[^A-Za-z0-9]/", "", explode("\n", $clean_enter))));
        $ex = array_filter(array_merge($ez, $ef));
        foreach ($ex as $k => $item) {
            if ($k <= $max) {
                $result[] = trim($item);
            }
        }
        return implode(",", array_unique($result));
    }
}

function getPrice($price, $duration, $device_max)
{
    $priceReal = isset($price[$duration]) ? $price[$duration] : 0;
    $result = ($priceReal * $device_max);
    return ($result <= 0) ? false : $result;
}

function clientIp()
{
    $clientIp  = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
    $forwardIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '';
    $remoteIp  = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    if (filter_var($clientIp, FILTER_VALIDATE_IP)) {
        return $clientIp;
    }
    if (filter_var($forwardIp, FILTER_VALIDATE_IP)) {
        return $forwardIp;
    }
    return $remoteIp;
}

function writeAudit($action, $detail = '', $username = null)
{
    $db = \Config\Database::connect();
    $db->table('audit_log')->insert([
        'username' => $username ?: session('unames'),
        'action' => $action,
        'detail' => $detail,
        'ip' => clientIp(),
        'created_at' => date('Y-m-d H:i:s'),
    ]);
}

function hoursToDays($value)
{
    $value = (int) $value;
    if ($value <= 1) {
        return $value . ' Hour';
    }
    if ($value < 24) {
        return $value . ' Hours';
    }
    $days = $value / 24;
    return $days . ($days == 1 ? ' Day' : ' Days');
}

function hudRateLimit($bucket, $max = 8, $window = 300)
{
    $ip = preg_replace('/[^0-9a-fA-F.:]/', '', (string) clientIp());
    $dir = WRITEPATH . 'cache/ratelimit';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    $file = $dir . '/' . preg_replace('/[^A-Za-z0-9._-]/', '_', $bucket . '_' . $ip) . '.json';
    $now = time();
    $hits = [];
    if (is_file($file)) {
        $raw = @file_get_contents($file);
        $hits = json_decode((string) $raw, true);
        if (!is_array($hits)) {
            $hits = [];
        }
    }
    $hits = array_values(array_filter($hits, function ($t) use ($now, $window) {
        return (int) $t > ($now - $window);
    }));
    if (count($hits) >= $max) {
        return false;
    }
    $hits[] = $now;
    @file_put_contents($file, json_encode($hits), LOCK_EX);
    return true;
}

function hudNotify($url)
{
    $url = trim((string) $url);
    if ($url === '' || !preg_match('#^https?://#i', $url)) {
        return false;
    }
    $ctx = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 4,
            'ignore_errors' => true,
            'header' => "User-Agent: BLACK-BUNNY-HUD\r\n",
        ],
    ]);
    @file_get_contents($url, false, $ctx);
    return true;
}

function waDigits($raw)
{
    return preg_replace('/\D+/', '', (string) $raw);
}

function totpSecretMake()
{
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $out = '';
    for ($i = 0; $i < 16; $i++) {
        $out .= $chars[random_int(0, 31)];
    }
    return $out;
}

function totpBase32Decode($secret)
{
    $map = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $secret = strtoupper(preg_replace('/[^A-Z2-7]/', '', (string) $secret));
    $bits = '';
    $len = strlen($secret);
    for ($i = 0; $i < $len; $i++) {
        $val = strpos($map, $secret[$i]);
        if ($val === false) {
            continue;
        }
        $bits .= str_pad(decbin($val), 5, '0', STR_PAD_LEFT);
    }
    $bytes = '';
    foreach (str_split($bits, 8) as $chunk) {
        if (strlen($chunk) === 8) {
            $bytes .= chr(bindec($chunk));
        }
    }
    return $bytes;
}

function totpCode($secret, $slice = null)
{
    $slice = $slice === null ? (int) floor(time() / 30) : (int) $slice;
    $key = totpBase32Decode($secret);
    if ($key === '') {
        return '';
    }
    $bin = pack('N*', 0) . pack('N*', $slice);
    $hash = hash_hmac('sha1', $bin, $key, true);
    $off = ord(substr($hash, -1)) & 0x0F;
    $trunc = unpack('N', substr($hash, $off, 4));
    $code = ($trunc[1] & 0x7FFFFFFF) % 1000000;
    return str_pad((string) $code, 6, '0', STR_PAD_LEFT);
}

function totpVerify($secret, $code)
{
    $code = preg_replace('/\D+/', '', (string) $code);
    if (strlen($code) !== 6 || !$secret) {
        return false;
    }
    $now = (int) floor(time() / 30);
    for ($i = -1; $i <= 1; $i++) {
        if (hash_equals(totpCode($secret, $now + $i), $code)) {
            return true;
        }
    }
    return false;
}

function totpUri($secret, $account = 'owner')
{
    $label = rawurlencode('BLACK BUNNY:' . $account);
    return 'otpauth://totp/' . $label . '?secret=' . $secret . '&issuer=' . rawurlencode('BLACK BUNNY');
}

function keyExpirySoon($date, $days = 3)
{
    if (!$date) {
        return false;
    }
    $ts = strtotime((string) $date);
    if ($ts === false) {
        return false;
    }
    $left = $ts - time();
    return $left > 0 && $left <= ($days * 86400);
}

function hudDevicePrint()
{
    $ua = (string) ($_SERVER['HTTP_USER_AGENT'] ?? 'na');
    $cookie = (string) ($_COOKIE['bb_device'] ?? '');
    $base = $cookie !== '' ? $cookie : substr(hash('sha256', $ua . '|' . clientIp()), 0, 24);
    return preg_replace('/[^A-Za-z0-9]/', '', $base);
}

function hudBindCookie($print)
{
    $print = preg_replace('/[^A-Za-z0-9]/', '', (string) $print);
    if ($print === '') {
        return;
    }
    setcookie('bb_device', $print, [
        'expires' => time() + 86400 * 400,
        'path' => '/',
        'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https'),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

function shopLang($en, $hi)
{
    $lang = strtolower((string) ($_COOKIE['bb_lang'] ?? 'en'));
    return $lang === 'hi' ? $hi : $en;
}

function mintLicenseKey($hours = 24, $prefix = 'BB')
{
    $hours = max(1, (int) $hours);
    $prefix = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', (string) $prefix) ?: 'BB');
    $chunk = strtoupper(substr(bin2hex(random_bytes(5)), 0, 10));
    return $prefix . '-' . $hours . 'H-' . $chunk;
}

function uniqueLicenseKey($model, $hours = 24, $prefix = 'BB', $tries = 8)
{
    for ($i = 0; $i < $tries; $i++) {
        $key = mintLicenseKey($hours, $prefix);
        $hit = $model->where('user_key', $key)->first();
        if (!$hit) {
            return $key;
        }
    }
    return mintLicenseKey($hours, $prefix);
}

function licensePriceTable()
{
    return [
        2 => 10,
        5 => 20,
        24 => 80,
        72 => 150,
        168 => 250,
        336 => 350,
        720 => 500,
        1440 => 900,
        4320 => 2400,
        8760 => 4500,
    ];
}

function parseLicenseHours($raw)
{
    $raw = strtolower(trim((string) $raw));
    $alias = [
        '2h' => 2, '5h' => 5, '1d' => 24, '3d' => 72, '7d' => 168,
        '14d' => 336, '30d' => 720, '60d' => 1440, '6m' => 4320, '1y' => 8760,
    ];
    if (isset($alias[$raw])) {
        return $alias[$raw];
    }
    if (preg_match('/^(\d+)h$/', $raw, $m)) {
        return (int) $m[1];
    }
    if (preg_match('/^(\d+)d$/', $raw, $m)) {
        return (int) $m[1] * 24;
    }
    if (ctype_digit($raw)) {
        return (int) $raw;
    }
    return 0;
}

function panelUserAlive($user)
{
    if (!$user || (int) ($user->status ?? 0) !== 1) {
        return false;
    }
    if (!empty($user->expiration_date) && strtotime((string) $user->expiration_date) < time()) {
        return false;
    }
    return true;
}

function canTouchLicense($user, $row)
{
    if (!$user || !$row) {
        return false;
    }
    if ((int) $user->level === 1) {
        return true;
    }
    return (string) ($row->registrator ?? '') === (string) $user->username;
}

function ensureTgUserColumns()
{
    try {
        $db = \Config\Database::connect();
        if (!$db->fieldExists('tg_chat_id', 'users')) {
            $db->query('ALTER TABLE users ADD COLUMN tg_chat_id VARCHAR(32) NULL');
        }
        if (!$db->fieldExists('tg_link_code', 'users')) {
            $db->query('ALTER TABLE users ADD COLUMN tg_link_code VARCHAR(16) NULL');
        }
        if (!$db->fieldExists('tg_link_exp', 'users')) {
            $db->query('ALTER TABLE users ADD COLUMN tg_link_exp DATETIME NULL');
        }
    } catch (\Throwable $e) {
    }
}

function ensureAvatarColumn()
{
    try {
        $db = \Config\Database::connect();
        if (!$db->fieldExists('avatar', 'users')) {
            $db->query('ALTER TABLE users ADD COLUMN avatar VARCHAR(255) NULL');
        }
    } catch (\Throwable $e) {
    }
}

function ensureKeysKeyColumn()
{
    try {
        $db = \Config\Database::connect();
        $fields = $db->getFieldData('keys_code');
        foreach ($fields as $f) {
            if (($f->name ?? '') !== 'user_key') {
                continue;
            }
            $max = (int) ($f->max_length ?? 0);
            if ($max > 0 && $max < 64) {
                $db->query('ALTER TABLE keys_code MODIFY user_key VARCHAR(64) NULL');
            }
            return;
        }
    } catch (\Throwable $e) {
    }
}

function sanitizeLicenseKey($raw)
{
    $key = trim((string) $raw);
    $key = strtr($key, [
        "\xE2\x80\x90" => '-',
        "\xE2\x80\x91" => '-',
        "\xE2\x80\x92" => '-',
        "\xE2\x80\x93" => '-',
        "\xE2\x80\x94" => '-',
        "\xE2\x80\x95" => '-',
        "\xEF\xBC\x8D" => '-',
    ]);
    $key = preg_replace('/\s+/', '', $key);
    return $key;
}

function licenseKeyOk($raw)
{
    $key = (string) $raw;
    $len = strlen($key);
    if ($len < 4 || $len > 64) {
        return false;
    }
    if (!preg_match('/^[\x21-\x7E]+$/', $key)) {
        return false;
    }
    return !preg_match('/[\'"\\\\<>`]/', $key);
}

function userAvatarUrl($user)
{
    if (!$user) {
        return '';
    }
    $path = isset($user->avatar) ? trim((string) $user->avatar) : '';
    if ($path === '' || strpos($path, '..') !== false) {
        return '';
    }
    if (!preg_match('#^uploads/avatars/[A-Za-z0-9._-]+$#', $path)) {
        return '';
    }
    $abs = FCPATH . $path;
    if (!is_file($abs)) {
        return '';
    }
    return base_url($path) . '?v=' . filemtime($abs);
}

function tgShop($key = null)
{
    try {
        $bag = (new \App\Models\ShopConfig())->bag();
    } catch (\Throwable $e) {
        $bag = [];
    }
    if ($key === null) {
        return $bag;
    }
    return isset($bag[$key]) ? (string) $bag[$key] : '';
}

function tgApi($method, $payload = [])
{
    $token = trim(tgShop('tg_bot_token'));
    if ($token === '' || !preg_match('/^\d+:[A-Za-z0-9_-]{20,}$/', $token)) {
        return false;
    }
    $url = 'https://api.telegram.org/bot' . $token . '/' . $method;
    $ctx = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => json_encode($payload),
            'timeout' => 8,
            'ignore_errors' => true,
        ],
    ]);
    $raw = @file_get_contents($url, false, $ctx);
    $json = json_decode((string) $raw, true);
    return is_array($json) ? $json : false;
}

function tgSend($chatId, $text, $markup = null)
{
    $chatId = (string) $chatId;
    $text = substr((string) $text, 0, 3900);
    if ($chatId === '' || $text === '') {
        return false;
    }
    $payload = [
        'chat_id' => $chatId,
        'text' => $text,
        'disable_web_page_preview' => true,
    ];
    if (is_array($markup)) {
        $payload['reply_markup'] = $markup;
    }
    return tgApi('sendMessage', $payload);
}

function tgAnswer($callbackId, $text = '')
{
    $payload = ['callback_query_id' => (string) $callbackId];
    if ($text !== '') {
        $payload['text'] = substr($text, 0, 180);
        $payload['show_alert'] = false;
    }
    return tgApi('answerCallbackQuery', $payload);
}

function tgPadMarkup()
{
    return [
        'keyboard' => [
            [['text' => '[+] GENERATE'], ['text' => '[#] MY KEYS']],
            [['text' => '[*] RADAR'], ['text' => '[$] PRICES']],
            [['text' => '[>] QUICK 5H'], ['text' => '[>] QUICK 1D'], ['text' => '[>] QUICK 7D']],
            [['text' => '[@] ACCOUNT'], ['text' => '[x] UNLINK']],
        ],
        'resize_keyboard' => true,
        'is_persistent' => true,
    ];
}

function tgMenuMarkup()
{
    return [
        'inline_keyboard' => [
            [
                ['text' => '[+] GENERATE', 'callback_data' => 'm:gen'],
                ['text' => '[#] MY KEYS', 'callback_data' => 'l:1'],
            ],
            [
                ['text' => '[~] UNUSED', 'callback_data' => 'l:u1'],
                ['text' => '[!] LIVE', 'callback_data' => 'm:live'],
            ],
            [
                ['text' => '[*] RADAR', 'callback_data' => 'm:rad'],
                ['text' => '[$] PRICES', 'callback_data' => 'm:pay'],
            ],
            [
                ['text' => '[@] ACCOUNT', 'callback_data' => 'm:me'],
                ['text' => '[x] UNLINK', 'callback_data' => 'm:un'],
            ],
        ],
    ];
}

function tgTapLabel($text)
{
    return strtoupper(trim(preg_replace('/[^A-Z0-9 ]+/i', ' ', (string) $text)));
}

function tgStatePath($chatId)
{
    $dir = WRITEPATH . 'cache/tgstate';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    return $dir . '/' . preg_replace('/[^0-9-]/', '', (string) $chatId) . '.json';
}

function tgStateGet($chatId)
{
    $file = tgStatePath($chatId);
    if (!is_file($file)) {
        return [];
    }
    $raw = json_decode((string) @file_get_contents($file), true);
    return is_array($raw) ? $raw : [];
}

function tgStatePut($chatId, $data)
{
    @file_put_contents(tgStatePath($chatId), json_encode($data), LOCK_EX);
}

function tgStateClear($chatId)
{
    $file = tgStatePath($chatId);
    if (is_file($file)) {
        @file_put_contents($file, '{}', LOCK_EX);
    }
}

function forgePanelKeys($user, $hours, $devices = 1, $count = 1)
{
    $hours = (int) $hours;
    $devices = max(1, min(20, (int) $devices));
    $count = max(1, min(10, (int) $count));
    $prices = licensePriceTable();
    if (!isset($prices[$hours])) {
        return ['ok' => false, 'msg' => 'Duration not in table. Use 2 5 24 72 168 336 720 1440 4320 8760 (or 1d 3d 7d 14d 30d 60d 6m 1y).'];
    }
    $unit = getPrice($prices, $hours, $devices);
    $fees = $unit * $count;
    if ((int) $user->saldo < $fees) {
        return ['ok' => false, 'msg' => 'Low saldo. Need Rs ' . $fees . ' / have Rs ' . (int) $user->saldo];
    }
    $model = new \App\Models\KeysModel();
    $userModel = new \App\Models\UserModel();
    $tag = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', (string) $user->username), 0, 6) ?: 'BB');
    $keys = [];
    $idKeys = 0;
    for ($i = 0; $i < $count; $i++) {
        $license = uniqueLicenseKey($model, $hours, $tag);
        $idKeys = $model->insert([
            'game' => 'PUBG',
            'user_key' => $license,
            'duration' => $hours,
            'max_devices' => $devices,
            'registrator' => $user->username,
            'created_by' => (int) $user->id_users,
            'status' => 1,
        ]);
        $keys[] = $license;
    }
    $left = (int) $user->saldo - $fees;
    $userModel->update($user->id_users, ['saldo' => $left]);
    $history = new \App\Models\HistoryModel();
    $history->insert([
        'keys_id' => $idKeys,
        'user_do' => $user->username,
        'info' => 'PUBG|' . substr((string) ($keys[0] ?? ''), 0, 5) . "|$hours|$devices",
    ]);
    writeAudit('generate_keys', count($keys) . " tg / PUBG / {$hours}h", $user->username);
    return ['ok' => true, 'keys' => $keys, 'fees' => $fees, 'saldo' => $left, 'hours' => $hours, 'devices' => $devices];
}

function tgStaffChats($levels = [1, 2])
{
    ensureTgUserColumns();
    $out = [];
    try {
        $db = \Config\Database::connect();
        $rows = $db->table('users')
            ->whereIn('level', $levels)
            ->where('status', 1)
            ->where('tg_chat_id IS NOT NULL', null, false)
            ->where('tg_chat_id !=', '')
            ->get()
            ->getResult();
        foreach ($rows as $row) {
            $chat = trim((string) ($row->tg_chat_id ?? ''));
            if ($chat !== '') {
                $out[] = $chat;
            }
        }
    } catch (\Throwable $e) {
        return [];
    }
    return array_values(array_unique($out));
}

function tgNotifyStaff($text, $markup = null, $levels = [1, 2])
{
    $n = 0;
    foreach (tgStaffChats($levels) as $chat) {
        if (tgSend($chat, $text, $markup)) {
            $n++;
        }
    }
    return $n;
}

function tgBotHealth()
{
    $token = trim(tgShop('tg_bot_token'));
    $out = [
        'token' => $token !== '',
        'live' => false,
        'username' => '',
        'hook_url' => '',
        'hook_ok' => false,
        'hook_error' => '',
        'pending' => 0,
        'masked' => '',
    ];
    if ($token === '') {
        return $out;
    }
    $out['masked'] = substr($token, 0, 8) . '...' . substr($token, -5);
    $me = tgApi('getMe', []);
    if (empty($me['ok']) || empty($me['result'])) {
        $out['hook_error'] = (string) ($me['description'] ?? 'getMe fail');
        return $out;
    }
    $out['live'] = true;
    $out['username'] = '@' . (string) ($me['result']['username'] ?? 'bot');
    $info = tgApi('getWebhookInfo', []);
    if (!empty($info['ok']) && !empty($info['result']) && is_array($info['result'])) {
        $r = $info['result'];
        $out['hook_url'] = (string) ($r['url'] ?? '');
        $out['hook_error'] = (string) ($r['last_error_message'] ?? '');
        $out['pending'] = (int) ($r['pending_update_count'] ?? 0);
        $out['hook_ok'] = $out['hook_url'] !== '' && $out['hook_error'] === '';
    }
    return $out;
}

function shopOrderMarkup($oid)
{
    $oid = (int) $oid;
    return [
        'inline_keyboard' => [[
            ['text' => '[+] APPROVE + KEY', 'callback_data' => 'o:a:' . $oid],
            ['text' => '[x] REJECT', 'callback_data' => 'o:r:' . $oid],
        ]],
    ];
}

function pingShopOrder($id, $plan = null)
{
    $order = (new \App\Models\ShopOrder())->find((int) $id);
    if (!$order) {
        return 0;
    }
    $title = is_array($plan) ? (string) ($plan['title'] ?? 'PLAN') : 'PLAN';
    $hours = is_array($plan) ? hoursToDays((int) ($plan['hours'] ?? 0)) : '';
    $text = "[ SHOP ORDER #{$id} ]\n{$title}" . ($hours !== '' ? " · {$hours}" : '')
        . "\nRs " . (int) $order['amount']
        . "\nNAME " . $order['customer_name']
        . "\nPHONE " . $order['customer_phone']
        . "\nTXN " . $order['txn_id'];
    if (trim((string) ($order['customer_note'] ?? '')) !== '') {
        $text .= "\nNOTE " . $order['customer_note'];
    }
    $text .= "\nTap Approve / Reject.";
    return tgNotifyStaff($text, shopOrderMarkup($id));
}

function shopVerifyOrder($oid, $actor)
{
    $oid = (int) $oid;
    if (!$actor || (int) ($actor->level ?? 9) > 2) {
        return ['ok' => false, 'msg' => 'Owner/Admin only.'];
    }
    $orderModel = new \App\Models\ShopOrder();
    $order = $orderModel->find($oid);
    if (!$order || ($order['status'] ?? '') !== 'pending') {
        return ['ok' => false, 'msg' => 'Order nahi / already done.'];
    }
    $plan = (new \App\Models\ShopPlan())->find((int) $order['plan_id']);
    $hours = $plan ? (int) $plan['hours'] : 24;
    $devices = $plan ? (int) $plan['devices'] : 1;
    $license = uniqueLicenseKey(new \App\Models\KeysModel(), $hours, 'SHOP');
    (new \App\Models\KeysModel())->insert([
        'game' => 'PUBG',
        'user_key' => $license,
        'duration' => $hours,
        'max_devices' => $devices,
        'registrator' => $actor->username,
        'created_by' => (int) $actor->id_users,
        'status' => 1,
    ]);
    $orderModel->update($oid, [
        'status' => 'verified',
        'issued_key' => $license,
        'verified_by' => $actor->username,
    ]);
    writeAudit('shop_verify', 'order#' . $oid . ' key=' . $license, $actor->username);
    $cfgNow = (new \App\Models\ShopConfig())->bag();
    $msg = 'BLACK BUNNY KEY READY' . "\n" . 'Order #' . $oid . "\n" . 'Key: ' . $license . "\n" . 'Txn: ' . (string) $order['txn_id'];
    $phone = waDigits($order['customer_phone'] ?: ($cfgNow['owner_whatsapp'] ?? ''));
    $waLink = $phone ? ('https://wa.me/' . $phone . '?text=' . rawurlencode($msg)) : '';
    tgNotifyStaff("[ ORDER #{$oid} VERIFIED ]\nKEY {$license}\nby " . $actor->username);
    return ['ok' => true, 'msg' => 'Order verified. Key: ' . $license, 'key' => $license, 'wa' => $waLink, 'order' => $order];
}

function shopRejectOrder($oid, $actor)
{
    $oid = (int) $oid;
    if (!$actor || (int) ($actor->level ?? 9) > 2) {
        return ['ok' => false, 'msg' => 'Owner/Admin only.'];
    }
    $orderModel = new \App\Models\ShopOrder();
    $order = $orderModel->find($oid);
    if (!$order || ($order['status'] ?? '') !== 'pending') {
        return ['ok' => false, 'msg' => 'Order nahi / already done.'];
    }
    $orderModel->update($oid, ['status' => 'rejected', 'verified_by' => $actor->username]);
    writeAudit('shop_reject', 'order#' . $oid, $actor->username);
    tgNotifyStaff("[ ORDER #{$oid} REJECTED ]\nTXN " . $order['txn_id'] . "\nby " . $actor->username);
    return ['ok' => true, 'msg' => 'Order rejected.', 'order' => $order];
}

function ensureWalletTable()
{
    try {
        $db = \Config\Database::connect();
        $db->query("CREATE TABLE IF NOT EXISTS wallet_topups (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id INT NOT NULL,
            username VARCHAR(64) NOT NULL DEFAULT '',
            amount INT NOT NULL DEFAULT 0,
            txn_id VARCHAR(80) NOT NULL DEFAULT '',
            note VARCHAR(255) NULL,
            status VARCHAR(16) NOT NULL DEFAULT 'pending',
            verified_by VARCHAR(64) NULL,
            created_at DATETIME NULL,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY status (status)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    } catch (\Throwable $e) {
    }
}

function walletTopupMarkup($id)
{
    $id = (int) $id;
    return [
        'inline_keyboard' => [[
            ['text' => '[+] CREDIT SALDO', 'callback_data' => 'w:a:' . $id],
            ['text' => '[x] REJECT', 'callback_data' => 'w:r:' . $id],
        ]],
    ];
}

function pingWalletTopup($id)
{
    $row = (new \App\Models\WalletTopup())->find((int) $id);
    if (!$row) {
        return 0;
    }
    $text = "[ WALLET TOPUP #{$id} ]\nUSER " . $row['username']
        . "\nRs " . (int) $row['amount']
        . "\nTXN " . $row['txn_id'];
    if (trim((string) ($row['note'] ?? '')) !== '') {
        $text .= "\nNOTE " . $row['note'];
    }
    $text .= "\nOwner tap Credit / Reject.";
    return tgNotifyStaff($text, walletTopupMarkup($id), [1]);
}

function walletApprove($id, $actor)
{
    $id = (int) $id;
    if (!$actor || (int) ($actor->level ?? 9) !== 1) {
        return ['ok' => false, 'msg' => 'Owner only.'];
    }
    ensureWalletTable();
    $model = new \App\Models\WalletTopup();
    $row = $model->find($id);
    if (!$row || ($row['status'] ?? '') !== 'pending') {
        return ['ok' => false, 'msg' => 'Top-up nahi / already done.'];
    }
    $userModel = new \App\Models\UserModel();
    $target = $userModel->getUser((int) $row['user_id'], 'id_users');
    if (!$target) {
        return ['ok' => false, 'msg' => 'User nahi mila.'];
    }
    $add = (int) $row['amount'];
    $left = (int) $target->saldo + $add;
    $userModel->update($target->id_users, ['saldo' => $left]);
    $model->update($id, ['status' => 'verified', 'verified_by' => $actor->username]);
    writeAudit('wallet_ok', 'topup#' . $id . ' +' . $add . ' -> ' . $target->username, $actor->username);
    $chat = trim((string) ($target->tg_chat_id ?? ''));
    if ($chat !== '') {
        tgSend($chat, "[ WALLET +Rs {$add} ]\nSALDO Rs {$left}\nTXN " . $row['txn_id']);
    }
    tgNotifyStaff("[ WALLET #{$id} CREDITED ]\n{$target->username} +Rs {$add}\nSALDO Rs {$left}\nby " . $actor->username, null, [1]);
    return ['ok' => true, 'msg' => 'Credited Rs ' . $add . ' to ' . $target->username, 'saldo' => $left];
}

function walletReject($id, $actor)
{
    $id = (int) $id;
    if (!$actor || (int) ($actor->level ?? 9) !== 1) {
        return ['ok' => false, 'msg' => 'Owner only.'];
    }
    ensureWalletTable();
    $model = new \App\Models\WalletTopup();
    $row = $model->find($id);
    if (!$row || ($row['status'] ?? '') !== 'pending') {
        return ['ok' => false, 'msg' => 'Top-up nahi / already done.'];
    }
    $model->update($id, ['status' => 'rejected', 'verified_by' => $actor->username]);
    writeAudit('wallet_no', 'topup#' . $id, $actor->username);
    $userModel = new \App\Models\UserModel();
    $target = $userModel->getUser((int) $row['user_id'], 'id_users');
    if ($target) {
        $chat = trim((string) ($target->tg_chat_id ?? ''));
        if ($chat !== '') {
            tgSend($chat, "[ WALLET REJECTED ]\nRs " . (int) $row['amount'] . "\nTXN " . $row['txn_id']);
        }
    }
    tgNotifyStaff("[ WALLET #{$id} REJECTED ]\n" . $row['username'] . " Rs " . (int) $row['amount'] . "\nby " . $actor->username, null, [1]);
    return ['ok' => true, 'msg' => 'Top-up rejected.'];
}
