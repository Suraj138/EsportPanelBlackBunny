<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Order #<?= (int) $order['id'] ?> · BLACK BUNNY</title>
<?= link_tag('assets/css/blackbunny.css') ?>
<?= link_tag('assets/css/shop.css') ?>
</head>
<body class="shop-body">
<div class="bb-stage"><div class="bb-aurora"></div><div class="bb-grid"></div><div class="bb-vignette"></div></div>
<header class="shop-nav">
    <a class="brand-link" href="<?= site_url('shop') ?>">
        <?= view('Layout/BrandMark') ?>
        <span class="brand-copy"><strong>BLACK BUNNY</strong><small>ORDER</small></span>
    </a>
</header>
<div class="buy-wrap">
    <section class="login-card">
        <div class="card-kicker">QUEUED</div>
        <h1>Order #<?= (int) $order['id'] ?></h1>
        <p><?= esc($plan['title'] ?? 'Plan') ?> · Rs <?= (int) $order['amount'] ?> · <?= esc($order['status']) ?></p>
        <?php if ($order['status'] === 'verified' && $order['issued_key']) : ?>
            <div class="pay-box"><strong>YOUR KEY</strong><p class="upi-id"><?= esc($order['issued_key']) ?></p></div>
        <?php else : ?>
            <p>Payment is in Owner/Admin queue. After verify, your key appears here.</p>
        <?php endif; ?>
        <div class="msg-row">
            <?php if (!empty($cfg['owner_whatsapp'])) : ?>
                <a class="ghost-btn" href="https://wa.me/<?= preg_replace('/\D+/', '', $cfg['owner_whatsapp']) ?>?text=<?= rawurlencode('Order #'.$order['id'].' txn '.$order['txn_id']) ?>" target="_blank" rel="noopener">MESSAGE OWNER</a>
            <?php endif; ?>
            <?php if (!empty($cfg['admin_whatsapp'])) : ?>
                <a class="ghost-btn" href="https://wa.me/<?= preg_replace('/\D+/', '', $cfg['admin_whatsapp']) ?>?text=<?= rawurlencode('Order #'.$order['id'].' txn '.$order['txn_id']) ?>" target="_blank" rel="noopener">MESSAGE ADMIN</a>
            <?php endif; ?>
            <?php if (!empty($cfg['telegram_support'])) : ?>
                <a class="ghost-btn" href="<?= esc($cfg['telegram_support']) ?>" target="_blank" rel="noopener">TELEGRAM</a>
            <?php endif; ?>
        </div>
        <div class="secure"><a href="<?= site_url('shop') ?>">Back to store</a></div>
    </section>
</div>
</body>
</html>
