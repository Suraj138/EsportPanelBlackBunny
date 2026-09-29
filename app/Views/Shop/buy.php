<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Buy <?= esc($plan['title']) ?> · BLACK BUNNY</title>
<?= link_tag('assets/css/blackbunny.css') ?>
<?= link_tag('assets/css/shop.css') ?>
</head>
<body class="shop-body">
<div class="bb-stage">
    <div class="bb-aurora"></div>
    <div class="bb-grid"></div>
    <div class="bb-vignette"></div>
</div>
<header class="shop-nav">
    <a class="brand-link" href="<?= site_url('shop') ?>">
        <?= view('Layout/BrandMark') ?>
        <span class="brand-copy"><strong>BLACK BUNNY</strong><small>CHECKOUT</small></span>
    </a>
</header>
<div class="buy-wrap">
    <?= view('Layout/msgStatus') ?>
    <section class="login-card">
        <div class="card-kicker">PLAN</div>
        <h1><?= esc($plan['title']) ?></h1>
        <p><?= hoursToDays((int) $plan['hours']) ?> · <?= (int) $plan['devices'] ?> device · Rs <?= (int) $plan['price'] ?></p>
        <div class="pay-box">
            <strong>UPI / QR</strong>
            <p><?= esc($cfg['upi_name'] ?? 'BLACK BUNNY') ?></p>
            <p class="upi-id"><?= esc($cfg['upi_id'] ?? '') ?></p>
            <?php if (!empty($cfg['qr_image'])) : ?>
                <img class="qr" src="<?= base_url($cfg['qr_image']) ?>" alt="UPI QR">
            <?php endif; ?>
            <small>Pay Rs <?= (int) $plan['price'] ?> then submit txn id. Owner/Admin verifies and issues the key.</small>
        </div>
        <?= form_open('shop/order', ['class' => 'login-form']) ?>
            <input type="hidden" name="plan_id" value="<?= (int) $plan['id'] ?>">
            <div class="field">
                <label>YOUR NAME</label>
                <input type="text" name="customer_name" required value="<?= old('customer_name') ?>" placeholder="Name">
            </div>
            <div class="field">
                <label>PHONE / WHATSAPP</label>
                <input type="text" name="customer_phone" required value="<?= old('customer_phone') ?>" placeholder="Phone">
            </div>
            <div class="field">
                <label>UPI TXN ID</label>
                <input type="text" name="txn_id" required value="<?= old('txn_id') ?>" placeholder="UPI reference">
            </div>
            <div class="field">
                <label>NOTE</label>
                <input type="text" name="customer_note" value="<?= old('customer_note') ?>" placeholder="Optional">
            </div>
            <button class="submit" type="submit">SUBMIT ORDER</button>
        <?= form_close() ?>
        <div class="secure"><a href="<?= site_url('shop') ?>">Back to store</a></div>
    </section>
</div>
</body>
</html>
