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
