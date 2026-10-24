<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Store Offline · BLACK BUNNY</title>
<link rel="stylesheet" href="<?= base_url('assets/css/blackbunny.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/blackbunny.css') ?: time() ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/shop.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/shop.css') ?: time() ?>">
</head>
<body class="shop-body">
<?= view('Layout/WelcomeSplash') ?>
<div class="bb-stage"><div class="bb-aurora"></div><div class="bb-vignette"></div></div>
<div class="buy-wrap">
    <section class="login-card">
        <div class="card-kicker">OFFLINE</div>
        <h1>PUBLIC STORE DISABLED</h1>
        <p>Owner turned the public page off. Try again later.</p>
        <div class="secure"><a href="<?= site_url('login') ?>">Operator login</a></div>
    </section>
</div>
<script src="<?= base_url('assets/js/blackbunny.js') ?>?v=<?= @filemtime(FCPATH . 'assets/js/blackbunny.js') ?: time() ?>"></script>
</body>
</html>
