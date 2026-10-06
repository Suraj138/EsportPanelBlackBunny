<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= shopLang('Find Order', 'Order Dhundo') ?> · BLACK BUNNY</title>
<link rel="stylesheet" href="<?= base_url('assets/css/blackbunny.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/blackbunny.css') ?: time() ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/shop.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/shop.css') ?: time() ?>">
</head>
<body class="shop-body">
<?= view('Layout/WelcomeSplash') ?>
<div class="bb-stage"><div class="bb-aurora"></div><div class="bb-grid"></div><div class="bb-vignette"></div></div>
<header class="shop-nav">
    <a class="brand-link" href="<?= site_url('shop') ?>">
        <?= view('Layout/BrandMark') ?>
        <span class="brand-copy"><strong>BLACK BUNNY</strong><small>LOOKUP</small></span>
    </a>
</header>
<div class="buy-wrap">
    <?= view('Layout/msgStatus') ?>
    <section class="login-card">
        <div class="card-kicker"><?= shopLang('TRACK ORDER', 'ORDER TRACK') ?></div>
        <h1><?= shopLang('Find your key', 'Apni key dhundo') ?></h1>
        <p><?= shopLang('Enter the WhatsApp number and UPI txn id used at checkout.', 'Checkout pe diya phone aur UPI txn id daalo.') ?></p>
        <?= form_open('shop/lookup', ['class' => 'login-form']) ?>
            <div class="field">
                <label><?= shopLang('PHONE / WHATSAPP', 'PHONE / WHATSAPP') ?></label>
                <input type="text" name="customer_phone" required value="<?= old('customer_phone') ?>" placeholder="91XXXXXXXXXX">
            </div>
            <div class="field">
                <label>UPI TXN ID</label>
                <input type="text" name="txn_id" required value="<?= old('txn_id') ?>" placeholder="UPI reference">
            </div>
            <button class="submit" type="submit"><?= shopLang('FIND ORDER', 'ORDER DHUNDO') ?></button>
        <?= form_close() ?>
        <div class="secure"><a href="<?= site_url('shop') ?>"><?= shopLang('Back to store', 'Store pe wapas') ?></a></div>
    </section>
</div>
<script src="<?= base_url('assets/js/blackbunny.js') ?>?v=<?= @filemtime(FCPATH . 'assets/js/blackbunny.js') ?: time() ?>"></script>
</body>
</html>
