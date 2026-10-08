<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<?php
$upi = trim((string) ($cfg['upi_id'] ?? ''));
$pn = rawurlencode((string) ($cfg['upi_name'] ?? 'BLACK BUNNY'));
$amt = (int) old('amount', 100);
$upiLink = $upi ? ('upi://pay?pa=' . rawurlencode($upi) . '&pn=' . $pn . '&am=' . $amt . '&cu=INR&tn=' . rawurlencode('BLACK BUNNY WALLET')) : '';
?>
<div class="container-fluid px-4 py-6">
    <section class="page-hero">
        <div class="hero-kicker">WALLET</div>
        <h1>SALDO TOP-UP</h1>
        <p>UPI pay, paste txn id. Owner credits saldo after verify.</p>
    </section>
    <div class="mb-6"><?= $this->include('Layout/msgStatus') ?></div>

    <div class="glass-card rounded-2xl p-8 mb-6" style="border:2px solid #00ffd0">
        <h2 style="font-family:Orbitron,sans-serif;letter-spacing:.12em;color:#00ffd0;margin:0 0 8px">YOUR SALDO</h2>
        <p class="hud-chip" style="margin:12px 0">Rs <?= (int) $user->saldo ?></p>
        <div class="pay-box">
            <strong>UPI / QR</strong>
            <p><?= esc($cfg['upi_name'] ?? 'BLACK BUNNY') ?></p>
            <p class="upi-id" id="upiId"><?= esc($upi) ?></p>
            <div class="shop-cta" style="display:flex;gap:10px;flex-wrap:wrap;margin:12px 0">
                <?php if ($upi) : ?>
                    <button type="button" class="ghost-btn" id="copyUpi">COPY UPI</button>
                <?php endif; ?>
                <?php if ($upiLink) : ?>
                    <a class="submit shop-btn" href="<?= esc($upiLink) ?>">PAY UPI</a>
                <?php endif; ?>
            </div>
            <?php if (!empty($cfg['qr_image'])) : ?>
                <img class="qr" src="<?= base_url($cfg['qr_image']) ?>" alt="UPI QR" style="max-width:220px">
            <?php endif; ?>
            <small>Pay then paste UPI txn id. Owner approve = saldo credit.</small>
        </div>
        <?= form_open('wallet/topup', ['class' => 'login-form']) ?>
            <div class="field">
                <label>AMOUNT Rs</label>
                <input type="number" name="amount" min="50" max="50000" required value="<?= esc(old('amount', '100')) ?>" placeholder="100">
            </div>
            <div class="field">
                <label>UPI TXN ID</label>
                <input type="text" name="txn_id" required value="<?= esc(old('txn_id')) ?>" placeholder="UPI reference">
            </div>
            <div class="field">
                <label>NOTE</label>
                <input type="text" name="note" value="<?= esc(old('note')) ?>" placeholder="Optional">
            </div>
            <button class="submit" type="submit">SUBMIT TOP-UP</button>
        <?= form_close() ?>
    </div>

    <div class="glass-card rounded-2xl p-8 mb-6">
        <h2 style="font-family:Orbitron,sans-serif;letter-spacing:.12em;color:#00ffd0;margin:0 0 12px">MY REQUESTS</h2>
        <?php if (!$mine) : ?><p class="muted">No top-ups yet.</p><?php endif; ?>
        <?php foreach ($mine as $r) : ?>
            <div class="order-row" style="display:flex;justify-content:space-between;gap:12px;padding:10px 0;border-bottom:1px solid rgba(0,255,208,.12)">
                <div>
                    <strong>#<?= (int) $r['id'] ?> · Rs <?= (int) $r['amount'] ?></strong>
                    <small style="display:block">txn <?= esc($r['txn_id']) ?> · <?= esc($r['created_at']) ?></small>
                </div>
                <span class="hud-chip"><?= esc(strtoupper($r['status'])) ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ((int) $user->level === 1) : ?>
    <div class="glass-card rounded-2xl p-8">
        <h2 style="font-family:Orbitron,sans-serif;letter-spacing:.12em;color:#00ffd0;margin:0 0 12px">OWNER QUEUE</h2>
        <?php if (!$queue) : ?><p class="muted">No wallet requests.</p><?php endif; ?>
        <?php foreach ($queue as $r) : ?>
            <div class="order-row" style="display:flex;justify-content:space-between;gap:12px;align-items:center;padding:12px 0;border-bottom:1px solid rgba(0,255,208,.12)">
                <div>
                    <strong>#<?= (int) $r['id'] ?> · <?= esc($r['username']) ?> · Rs <?= (int) $r['amount'] ?></strong>
                    <small style="display:block">txn <?= esc($r['txn_id']) ?><?= $r['note'] ? ' · ' . esc($r['note']) : '' ?></small>
                    <span class="hud-chip"><?= esc(strtoupper($r['status'])) ?></span>
                </div>
                <?php if ($r['status'] === 'pending') : ?>
                <form method="post" action="<?= site_url('wallet/decide') ?>" style="display:flex;gap:8px">
                    <?= csrf_field() ?>
                    <input type="hidden" name="topup_id" value="<?= (int) $r['id'] ?>">
                    <button class="submit" name="approve_topup" value="1" type="submit">CREDIT</button>
                    <button class="ghost-btn" name="reject_topup" value="1" type="submit">REJECT</button>
                </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
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
<?= $this->endSection() ?>
