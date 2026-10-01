<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= esc($heading) ?> · BLACK BUNNY</title>
<link rel="stylesheet" href="<?= base_url('assets/css/blackbunny.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/blackbunny.css') ?: time() ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/shop.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/shop.css') ?: time() ?>">
</head>
<body class="shop-body">
<div class="bb-stage"><div class="bb-aurora"></div><div class="bb-grid"></div><div class="bb-vignette"></div></div>
<header class="shop-nav">
    <a class="brand-link" href="<?= site_url('shop') ?>">
        <?= view('Layout/BrandMark') ?>
        <span class="brand-copy"><strong>BLACK BUNNY</strong><small><?= esc(strtoupper($heading)) ?></small></span>
    </a>
</header>
<div class="buy-wrap">
    <section class="login-card">
        <div class="card-kicker">LEGAL</div>
        <h1><?= esc($heading) ?></h1>
        <p><?= nl2br(esc($body)) ?></p>
        <div class="secure"><a href="<?= site_url('shop') ?>">Back to store</a></div>
    </section>
</div>
<script src="<?= base_url('assets/js/blackbunny.js') ?>?v=<?= @filemtime(FCPATH . 'assets/js/blackbunny.js') ?: time() ?>"></script>
</body>
</html>
