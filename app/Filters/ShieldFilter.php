<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ShieldFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = $request->getUri();
        $path = strtolower(trim((string) $uri->getPath(), '/'));
        $path = preg_replace('#^index\.php/#', '', $path);
        if ($this->isProbe($path)) {
            return service('response')->setStatusCode(404)->setBody('');
        }
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $response->setHeader('X-Content-Type-Options', 'nosniff');
        $response->setHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->setHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->setHeader('Cache-Control', 'no-store');
        $response->removeHeader('X-Powered-By');
        $response->removeHeader('Server');
        return $response;
    }

    private function isProbe($path)
    {
        if ($path === '') {
            return false;
        }
        $exact = [
            'env', '.env', 'env.php', '.env.example', 'environment',
            'conn', 'conn.php', 'lib.php', 'phpinfo', 'phpinfo.php',
            'info.php', 'test.php', 'composer.json', 'composer.lock',
            'spark', 'dbg', 'debug', 'phpinfo.php',
        ];
        if (in_array($path, $exact, true)) {
            return true;
        }
        if (preg_match('/(^|\/)\.env(\.|$|\/)/', $path)) {
            return true;
        }
        if (preg_match('/\.(env|pem|key|sql|sqlite|log|bak|old|orig|ini|yml|yaml)$/', $path)) {
            return true;
        }
        if (preg_match('#^(app|writable|vendor|tests|system)/#', $path)) {
            return true;
        }
        return false;
    }
}
