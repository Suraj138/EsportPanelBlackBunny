<?php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
$uri = '/' . ltrim($uri, '/');
$deny = '/(\.env|\.pem|\.key|\.sql|\.sqlite|\.log|\.bak|\.ini|composer\.(json|lock)|spark|conn\.php|phpinfo\.php|test\.php)$/i';
if (preg_match($deny, $uri) || preg_match('#^/(app|writable|vendor|tests)/#i', $uri)) {
    http_response_code(404);
    exit;
}
$file = __DIR__ . $uri;
if ($uri !== '/' && is_file($file)) {
    return false;
}
require __DIR__ . '/index.php';
