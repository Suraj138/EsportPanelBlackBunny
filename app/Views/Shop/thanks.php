<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Order #<?= (int) $order['id'] ?> · BLACK BUNNY</title>
<link rel="stylesheet" href="<?= base_url('assets/css/blackbunny.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/blackbunny.css') ?: time() ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/shop.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/shop.css') ?: time() ?>">
</head>
<body class="shop-body">
<?= view('Layout/WelcomeSplash') ?>
<div class="bb-stage"><div class="bb-aurora"></div><div class="bb-grid"></div><div class="bb-vignette"></div></div>
<header class="shop-nav">
    <a class="brand-link" href="<?= site_url('shop') ?>">
        <?= view('Layout/BrandMark') ?>
        <span class="brand-copy"><strong>BLACK BUNNY</strong><small>ORDER</small></span>
    </a>
</header>
<div class="buy-wrap">
    <section class="login-card">
        <div class="card-kicker" id="orderStamp"><?= $order['status'] === 'verified' ? 'ISSUED' : 'QUEUED' ?></div>
        <h1>Order #<?= (int) $order['id'] ?></h1>
        <p id="orderMeta"><?= esc($plan['title'] ?? 'Plan') ?> · Rs <?= (int) $order['amount'] ?> · <?= esc($order['status']) ?></p>
        <div id="keyBox">
        <?php if ($order['status'] === 'verified' && $order['issued_key']) : ?>
            <div class="pay-box key-drop" data-bb-success="1">
                <strong>YOUR KEY</strong>
                <p class="upi-id" id="issuedKey"><?= esc($order['issued_key']) ?></p>
                <button type="button" class="ghost-btn" id="copyKey">COPY KEY</button>
            </div>
        <?php elseif ($order['status'] === 'rejected') : ?>
            <p id="waitCopy">Order rejected. Message Owner/Admin if this is a mistake.</p>
        <?php else : ?>
            <div class="pay-box wait-pulse" id="waitCopy">
                <strong>WAITING VERIFY</strong>
                <p>Owner/Admin queue. Key drops here live.</p>
                <i class="poll-bar"></i>
            </div>
        <?php endif; ?>
        </div>
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
        <div class="secure"><a href="<?= site_url('shop/lookup') ?>">Find another order</a> · <a href="<?= site_url('shop') ?>">Back to store</a></div>
    </section>
</div>
<script src="<?= base_url('assets/js/blackbunny.js') ?>?v=<?= @filemtime(FCPATH . 'assets/js/blackbunny.js') ?: time() ?>"></script>
<script>
(function(){
  function bindCopy(sel){
    var b=document.getElementById('copyKey');
    var t=document.getElementById('issuedKey');
    if(!b||!t) return;
    b.onclick=function(){
      var v=(t.textContent||'').trim();
      if(!v) return;
      if(navigator.clipboard&&navigator.clipboard.writeText) navigator.clipboard.writeText(v);
      else { var a=document.createElement('textarea'); a.value=v; document.body.appendChild(a); a.select(); try{document.execCommand('copy');}catch(e){} document.body.removeChild(a); }
      b.textContent='COPIED';
      if(window.bbToast) window.bbToast('KEY COPIED','ok');
      setTimeout(function(){ b.textContent='COPY KEY'; }, 1400);
    };
  }
  bindCopy();
  <?php if ($order['status'] !== 'verified' && $order['status'] !== 'rejected') : ?>
  var id=<?= (int) $order['id'] ?>;
  function tick(){
    fetch('<?= site_url('shop/status/') ?>'+id, {headers:{'Accept':'application/json'}})
      .then(function(r){ return r.ok ? r.json() : null; })
      .then(function(d){
        if(!d) return;
        var stamp=document.getElementById('orderStamp');
        var box=document.getElementById('keyBox');
        var meta=document.getElementById('orderMeta');
        if(d.status==='rejected'){
          if(stamp) stamp.textContent='REJECTED';
          if(meta) meta.textContent=meta.textContent.replace(/pending|queued/ig,'rejected');
          if(box) box.innerHTML='<p>Order rejected. Message Owner/Admin if this is a mistake.</p>';
          clearInterval(tm);
          return;
        }
        if(d.status!=='verified' || !d.issued_key) return;
        var key=String(d.issued_key);
        if(stamp) stamp.textContent='ISSUED';
        if(meta) meta.textContent=meta.textContent.replace(/pending|queued/ig,'verified');
        if(box){
          box.innerHTML='';
          var wrap=document.createElement('div');
          wrap.className='pay-box key-drop';
          wrap.setAttribute('data-bb-success','1');
          var lab=document.createElement('strong'); lab.textContent='YOUR KEY';
          var p=document.createElement('p'); p.className='upi-id'; p.id='issuedKey'; p.textContent=key;
          var btn=document.createElement('button'); btn.type='button'; btn.className='ghost-btn'; btn.id='copyKey'; btn.textContent='COPY KEY';
          wrap.appendChild(lab); wrap.appendChild(p); wrap.appendChild(btn);
          box.appendChild(wrap);
        }
        if(window.bbBurst) window.bbBurst('KEY DROP');
        if(window.bbToast) window.bbToast('KEY ISSUED','ok');
        bindCopy();
        clearInterval(tm);
      }).catch(function(){});
  }
  var tm=setInterval(tick, 3000);
  tick();
  <?php endif; ?>
})();
</script>
</body>
</html>
