<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= esc($heading) ?> · BLACK BUNNY</title>
<?= link_tag('assets/css/blackbunny.css') ?>
<?= link_tag('assets/css/shop.css') ?>
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
</body>
</html>
