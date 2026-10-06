<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Buy <?= esc($plan['title']) ?> · BLACK BUNNY</title>
<link rel="stylesheet" href="<?= base_url('assets/css/blackbunny.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/blackbunny.css') ?: time() ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/shop.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/shop.css') ?: time() ?>">
</head>
<body class="shop-body">
<?= view('Layout/WelcomeSplash') ?>
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
            <p class="upi-id" id="upiId"><?= esc($cfg['upi_id'] ?? '') ?></p>
            <?php
                $upi = trim((string) ($cfg['upi_id'] ?? ''));
                $amt = (int) $plan['price'];
                $pn = rawurlencode((string) ($cfg['upi_name'] ?? 'BLACK BUNNY'));
                $upiLink = $upi ? ('upi://pay?pa=' . rawurlencode($upi) . '&pn=' . $pn . '&am=' . $amt . '&cu=INR&tn=' . rawurlencode('BLACK BUNNY KEY')) : '';
            ?>
            <div class="shop-cta">
                <?php if ($upi) : ?>
                    <button type="button" class="ghost-btn" id="copyUpi">COPY UPI</button>
                <?php endif; ?>
                <?php if ($upiLink) : ?>
                    <a class="submit shop-btn" href="<?= esc($upiLink) ?>">PAY Rs <?= $amt ?></a>
                <?php endif; ?>
            </div>
            <?php if (!empty($cfg['qr_image'])) : ?>
                <img class="qr" src="<?= base_url($cfg['qr_image']) ?>" alt="UPI QR">
            <?php endif; ?>
            <small>Pay Rs <?= (int) $plan['price'] ?> then submit txn id. Owner/Admin verifies and issues the key.</small>
            <div class="shop-steps">
                <span>1 PAY UPI</span>
                <span>2 PASTE TXN</span>
                <span>3 WAIT VERIFY</span>
            </div>
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
<script src="<?= base_url('assets/js/blackbunny.js') ?>?v=<?= @filemtime(FCPATH . 'assets/js/blackbunny.js') ?: time() ?>"></script>
<script>
(function(){
  var b=document.getElementById('copyUpi');
  var t=document.getElementById('upiId');
  if(!b||!t) return;
  function copyText(v){
    if(navigator.clipboard&&navigator.clipboard.writeText) return navigator.clipboard.writeText(v);
    var a=document.createElement('textarea'); a.value=v; document.body.appendChild(a); a.select();
    try{document.execCommand('copy');}catch(e){}
    document.body.removeChild(a);
  }
  b.addEventListener('click', function(){
    var v=(t.textContent||'').trim();
    if(!v) return;
    copyText(v);
    b.textContent='COPIED';
    if(window.bbToast) window.bbToast('UPI COPIED','ok');
    setTimeout(function(){ b.textContent='COPY UPI'; }, 1400);
  });
})();
</script>
</body>
</html>
