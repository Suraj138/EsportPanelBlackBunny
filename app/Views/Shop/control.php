<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/shop.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/shop.css') ?: time() ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php
$pendingCount = 0;
$verifiedCount = 0;
$rejectedCount = 0;
$pendingOrders = [];
$doneOrders = [];
foreach ($orders as $o) {
    $st = $o['status'] ?? '';
    if ($st === 'pending') {
        $pendingCount++;
        $pendingOrders[] = $o;
    } else {
        $doneOrders[] = $o;
        if ($st === 'verified') $verifiedCount++;
        if ($st === 'rejected') $rejectedCount++;
    }
}
$queueOrders = array_merge($pendingOrders, $doneOrders);
$storeOn = !empty($cfg['page_on']) && $cfg['page_on'] === '1';
$planMap = [];
foreach ($plans as $p) {
    $planMap[(int) $p['id']] = $p;
}
?>
<div class="control-deck">
    <div class="mb-4"><?= $this->include('Layout/msgStatus') ?></div>
    <section class="ctrl-hero">
        <div>
            <div class="hero-kicker">OWNER CONTROL</div>
            <h1>PUBLIC WEBSITE DECK</h1>
            <p>Store copy, loader, plans, gallery and UPI queue in one aligned lane.</p>
        </div>
        <a class="ghost-btn" href="<?= site_url('shop') ?>" target="_blank" rel="noopener">OPEN PUBLIC STORE</a>
    </section>

    <?php if ($pendingCount > 0) : ?>
    <a class="hud-alert warn ctrl-pend-banner" href="#ctrl-queue" data-stamp="QUEUE">
        <?= (int) $pendingCount ?> pending UPI order<?= $pendingCount === 1 ? '' : 's' ?> · jump to payment queue
    </a>
    <?php endif; ?>

    <nav class="ctrl-jump" aria-label="Control sections">
        <a href="#ctrl-store"><b>01</b> STORE</a>
        <a href="#ctrl-loader"><b>02</b> LOADER</a>
        <a href="#ctrl-copy"><b>03</b> COPY</a>
        <a href="#ctrl-pay"><b>04</b> PAY</a>
        <a href="#ctrl-plans"><b>05</b> PLANS</a>
        <a href="#ctrl-gallery"><b>06</b> GALLERY</a>
        <a href="#ctrl-queue" class="<?= $pendingCount ? 'hot' : '' ?>"><b>07</b> QUEUE<?php if ($pendingCount) : ?><i><?= (int) $pendingCount ?></i><?php endif; ?></a>
    </nav>

    <div class="ctrl-strip">
        <article><small>STORE</small><b class="<?= $storeOn ? 'hud-stat lime' : 'hud-stat rose' ?>"><?= $storeOn ? 'LIVE' : 'OFF' ?></b></article>
        <article><small>PLANS</small><b class="hud-stat"><?= count($plans) ?></b></article>
        <article><small>GALLERY</small><b class="hud-stat"><?= count($media) ?></b></article>
        <a class="ctrl-strip-link" href="#ctrl-queue"><small>QUEUE</small><b class="hud-stat rose"><?= $pendingCount ?></b></a>
    </div>

    <?= form_open_multipart('public-control', ['class' => 'ctrl-page-form']) ?>
        <input type="hidden" name="save_page" value="1">

        <section class="ctrl-card" id="ctrl-store">
            <header><span>01 · STORE / HERO</span><em>live switch</em></header>
            <label class="toggle-row">
                <input type="checkbox" name="page_on" value="1" <?= $storeOn ? 'checked' : '' ?>>
                Public page ON
            </label>
            <div class="ctrl-fields">
                <div class="field span-2"><label>HERO TITLE</label><input name="hero_title" value="<?= esc($cfg['hero_title'] ?? '') ?>" placeholder="e.g. BLACK BUNNY ARENA"></div>
                <div class="field span-2"><label>HERO SUB</label><input name="hero_sub" value="<?= esc($cfg['hero_sub'] ?? '') ?>" placeholder="e.g. Buy keys · drop loader · own the lobby"></div>
                <div class="field"><label>HERO TYPE</label>
                    <select name="hero_type">
                        <option value="photo" <?= ($cfg['hero_type'] ?? '') === 'photo' ? 'selected' : '' ?>>Photo</option>
                        <option value="video" <?= ($cfg['hero_type'] ?? '') === 'video' ? 'selected' : '' ?>>Video</option>
                    </select>
                </div>
                <div class="field"><label>HERO MEDIA</label><input type="file" name="hero_media"></div>
            </div>
            <?php if (!empty($cfg['hero_media'])) : ?>
            <p class="ctrl-hint">Current hero: <?= esc(basename((string) $cfg['hero_media'])) ?></p>
            <?php endif; ?>
            <div class="ctrl-actions"><button class="submit ctrl-save" type="submit">SAVE STORE / HERO</button></div>
        </section>

        <section class="ctrl-card" id="ctrl-loader">
            <header><span>02 · LOADER / APK</span><em>public deck</em></header>
            <div class="ctrl-fields">
                <div class="field"><label>LOADER NAME</label><input name="loader_name" value="<?= esc($cfg['loader_name'] ?? 'BLACK BUNNY') ?>" placeholder="BLACK BUNNY"></div>
                <div class="field"><label>LOADER SIZE</label><input name="loader_size" value="<?= esc($cfg['loader_size'] ?? '10 MB') ?>" placeholder="10 MB"></div>
                <div class="field span-2"><label>GAME</label><input name="loader_game" value="<?= esc($cfg['loader_game'] ?? 'BGMI / PUBG Mobile') ?>" placeholder="BGMI / PUBG Mobile"></div>
                <div class="field span-2"><label>APK DOWNLOAD URL</label><input name="apk_url" value="<?= esc($cfg['apk_url'] ?? '') ?>" placeholder="https://... or upload below"></div>
                <div class="field span-2"><label>APK FILE (UPLOAD)</label><input type="file" name="apk_file" accept=".apk"></div>
            </div>
            <div class="ctrl-actions"><button class="submit ctrl-save" type="submit">SAVE LOADER / APK</button></div>
        </section>

        <section class="ctrl-card" id="ctrl-copy">
            <header><span>03 · COPY / LEGAL</span><em>store text</em></header>
            <div class="ctrl-fields">
                <div class="field"><label>ABOUT</label><textarea name="about_text" rows="4" placeholder="Who you are · what the store sells"><?= esc($cfg['about_text'] ?? '') ?></textarea></div>
                <div class="field"><label>FEATURES</label><textarea name="features_text" rows="4" placeholder="e.g. Aim assist · ESP · Safe lobby"><?= esc($cfg['features_text'] ?? '') ?></textarea></div>
                <div class="field"><label>UPDATES</label><textarea name="updates_text" rows="4" placeholder="Latest patch / downtime note"><?= esc($cfg['updates_text'] ?? '') ?></textarea></div>
                <div class="field"><label>CONTACT</label><textarea name="contact_text" rows="4" placeholder="How buyers reach you"><?= esc($cfg['contact_text'] ?? '') ?></textarea></div>
                <div class="field"><label>PRIVACY</label><textarea name="privacy_text" rows="3" placeholder="Privacy policy text"><?= esc($cfg['privacy_text'] ?? '') ?></textarea></div>
                <div class="field"><label>TERMS</label><textarea name="terms_text" rows="3" placeholder="Terms of use"><?= esc($cfg['terms_text'] ?? '') ?></textarea></div>
                <div class="field span-2"><label>REFUND</label><textarea name="refund_text" rows="3" placeholder="Refund rules"><?= esc($cfg['refund_text'] ?? '') ?></textarea></div>
            </div>
            <div class="ctrl-actions"><button class="submit ctrl-save" type="submit">SAVE COPY / LEGAL</button></div>
        </section>

        <section class="ctrl-card" id="ctrl-pay">
            <header><span>04 · PAY / SOCIAL</span><em>upi + links</em></header>
            <div class="ctrl-fields">
                <div class="field"><label>UPI ID</label><input name="upi_id" value="<?= esc($cfg['upi_id'] ?? '') ?>" placeholder="e.g. blackbunny@upi"></div>
                <div class="field"><label>UPI NAME</label><input name="upi_name" value="<?= esc($cfg['upi_name'] ?? '') ?>" placeholder="e.g. BLACK BUNNY"></div>
                <div class="field span-2"><label>QR IMAGE</label><input type="file" name="qr_image"></div>
                <div class="field"><label>YOUTUBE</label><input name="youtube_url" value="<?= esc($cfg['youtube_url'] ?? '') ?>" placeholder="https://youtube.com/..."></div>
                <div class="field"><label>INSTAGRAM</label><input name="instagram_url" value="<?= esc($cfg['instagram_url'] ?? '') ?>" placeholder="https://instagram.com/..."></div>
                <div class="field"><label>TELEGRAM CHANNEL</label><input name="telegram_url" value="<?= esc($cfg['telegram_url'] ?? '') ?>" placeholder="https://t.me/..."></div>
                <div class="field"><label>TELEGRAM SUPPORT</label><input name="telegram_support" value="<?= esc($cfg['telegram_support'] ?? '') ?>" placeholder="https://t.me/..."></div>
                <div class="field"><label>OWNER WHATSAPP</label><input name="owner_whatsapp" value="<?= esc($cfg['owner_whatsapp'] ?? '') ?>" placeholder="e.g. 91XXXXXXXXXX"></div>
                <div class="field"><label>ADMIN WHATSAPP</label><input name="admin_whatsapp" value="<?= esc($cfg['admin_whatsapp'] ?? '') ?>" placeholder="e.g. 91XXXXXXXXXX"></div>
            </div>
            <div class="ctrl-actions"><button class="submit ctrl-save" type="submit">SAVE PAY / SOCIAL</button></div>
        </section>
    <?= form_close() ?>

    <div class="ctrl-split">
        <section class="ctrl-card" id="ctrl-plans">
            <header><span>05 · KEY PLANS</span><em>price + show/hide</em></header>
            <?= form_open('public-control', ['class' => 'ctrl-add-plan']) ?>
                <input type="hidden" name="save_plan" value="1">
                <input type="hidden" name="plan_id" value="">
                <div class="ctrl-fields plan-add">
                    <div class="field hint-box">
                        <label>TITLE</label>
                        <input name="title" required placeholder="Plan name  ·  e.g. 5 Hour Drop">
                    </div>
                    <div class="field hint-box">
                        <label>HOURS</label>
                        <input name="hours" type="number" required placeholder="Key duration  ·  e.g. 5">
                    </div>
                    <div class="field hint-box">
                        <label>PRICE RS</label>
                        <input name="price" type="number" required placeholder="UPI amount  ·  e.g. 20">
                    </div>
                    <div class="field hint-box">
                        <label>DEVICES</label>
                        <input name="devices" type="number" required placeholder="Max binds  ·  e.g. 1">
                    </div>
                    <div class="field hint-box">
                        <label>BADGE</label>
                        <input name="badge" placeholder="Tag on card  ·  e.g. BLITZ">
                    </div>
                    <div class="field hint-box">
                        <label>SORT</label>
                        <input name="sort_order" type="number" placeholder="Order on store  ·  e.g. 1">
                    </div>
                </div>
                <label class="toggle-row"><input type="checkbox" name="visible" value="1" checked> Show on public store</label>
                <div class="ctrl-actions"><button class="submit ctrl-save" type="submit">ADD PLAN</button></div>
            <?= form_close() ?>
            <div class="plan-admin">
                <?php if (!$plans) : ?><p class="muted">No plans yet.</p><?php endif; ?>
                <?php foreach ($plans as $p) : ?>
                <div class="plan-row">
                    <form method="post" action="<?= site_url('public-control') ?>" class="plan-edit">
                        <?= csrf_field() ?>
                        <input type="hidden" name="save_plan" value="1">
                        <input type="hidden" name="plan_id" value="<?= (int) $p['id'] ?>">
                        <label class="plan-cell"><span>Title</span><input name="title" value="<?= esc($p['title']) ?>" placeholder="e.g. 5 Hour Drop"></label>
                        <label class="plan-cell"><span>Hours</span><input name="hours" type="number" value="<?= (int) $p['hours'] ?>" placeholder="e.g. 5"></label>
                        <label class="plan-cell"><span>Price Rs</span><input name="price" type="number" value="<?= (int) $p['price'] ?>" placeholder="e.g. 20"></label>
                        <label class="plan-cell"><span>Devices</span><input name="devices" type="number" value="<?= (int) $p['devices'] ?>" placeholder="e.g. 1"></label>
                        <label class="plan-cell"><span>Badge</span><input name="badge" value="<?= esc($p['badge']) ?>" placeholder="e.g. BLITZ"></label>
                        <label class="plan-cell"><span>Sort</span><input name="sort_order" type="number" value="<?= (int) $p['sort_order'] ?>" placeholder="e.g. 1"></label>
                        <label class="plan-on"><input type="checkbox" name="visible" value="1" <?= $p['visible'] ? 'checked' : '' ?>> ON</label>
                        <button type="submit" class="plan-save">SAVE</button>
                    </form>
                    <form method="post" action="<?= site_url('public-control') ?>" class="plan-del" onsubmit="return confirm('Delete this plan?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="delete_plan" value="1">
                        <input type="hidden" name="plan_id" value="<?= (int) $p['id'] ?>">
                        <button type="submit" class="ghost-btn">DELETE</button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="ctrl-card" id="ctrl-gallery">
            <header><span>06 · GALLERY</span><em>photo + video</em></header>
            <?= form_open_multipart('public-control') ?>
                <input type="hidden" name="upload_media" value="1">
                <div class="ctrl-fields">
                    <div class="field span-2"><label>FILE</label><input type="file" name="media_file" required></div>
                    <div class="field"><label>CAPTION</label><input name="caption" placeholder="e.g. Season clip / gameplay"></div>
                    <div class="field"><label>SORT</label><input name="sort_order" type="number" placeholder="e.g. 1" value=""></div>
                </div>
                <div class="ctrl-actions"><button class="submit ctrl-save" type="submit">UPLOAD MEDIA</button></div>
            <?= form_close() ?>
            <div class="media-mini">
                <?php if (!$media) : ?><p class="muted">No media yet.</p><?php endif; ?>
                <?php foreach ($media as $m) : ?>
                    <div class="media-mini-row">
                        <button type="button" class="media-preview" data-kind="<?= esc($m['kind']) ?>" data-src="<?= esc(base_url($m['file']), 'attr') ?>" data-cap="<?= esc($m['caption'] ?: basename($m['file']), 'attr') ?>">
                            <?php if (($m['kind'] ?? '') === 'video') : ?>
                                <video src="<?= base_url($m['file']) ?>" muted></video>
                            <?php else : ?>
                                <img src="<?= base_url($m['file']) ?>" alt="<?= esc($m['caption'] ?: 'media') ?>">
                            <?php endif; ?>
                            <span><?= esc($m['kind']) ?> · <?= esc($m['caption'] ?: basename($m['file'])) ?></span>
                        </button>
                        <form method="post" action="<?= site_url('public-control') ?>" onsubmit="return confirm('Delete this media?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="delete_media" value="1">
                            <input type="hidden" name="media_id" value="<?= (int) $m['id'] ?>">
                            <button type="submit" class="ghost-btn">DEL</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <section class="ctrl-card" id="ctrl-queue">
        <header>
            <span>07 · PAYMENT QUEUE</span>
            <em><?= (int) $pendingCount ?> pending · <?= (int) $verifiedCount ?> verified · <?= (int) $rejectedCount ?> rejected</em>
        </header>
        <div class="ctrl-filters" data-filter-wrap>
            <button type="button" class="ghost-btn is-on" data-filter="all">ALL</button>
            <button type="button" class="ghost-btn" data-filter="pending">PENDING <?= $pendingCount ? '(' . (int) $pendingCount . ')' : '' ?></button>
            <button type="button" class="ghost-btn" data-filter="verified">VERIFIED</button>
            <button type="button" class="ghost-btn" data-filter="rejected">REJECTED</button>
        </div>
        <div class="order-table">
            <?php foreach ($queueOrders as $o) : ?>
            <?php
                $plan = $planMap[(int) ($o['plan_id'] ?? 0)] ?? null;
                $hours = $plan ? (int) $plan['hours'] : 0;
                $duration = $hours ? hoursToDays($hours) : '-';
                $issued = trim((string) ($o['issued_key'] ?? ''));
            ?>
            <div class="order-row" data-status="<?= esc($o['status']) ?>">
                <div class="order-meta">
                    <strong>#<?= (int) $o['id'] ?> · <?= esc($o['customer_name']) ?></strong>
                    <small><?= esc($o['customer_phone']) ?> · txn <?= esc($o['txn_id']) ?> · Rs <?= (int) $o['amount'] ?><?= $plan ? ' · ' . esc($plan['title']) : '' ?></small>
                    <?php if (!empty($o['created_at'])) : ?><small><?= esc($o['created_at']) ?></small><?php endif; ?>
                    <span class="order-status <?= esc($o['status']) ?>"><?= esc(strtoupper($o['status'])) ?></span>
                    <?php if ($issued) : ?>
                        <div class="order-key-row">
                            <button type="button" class="key-chip" data-key="<?= esc($issued, 'attr') ?>"><?= esc($issued) ?></button>
                            <button type="button" class="ghost-btn copy-details" data-key="<?= esc($issued, 'attr') ?>" data-duration="<?= esc($duration, 'attr') ?>">COPY</button>
                        </div>
                    <?php endif; ?>
                    <?php $wa = waDigits($o['customer_phone']); ?>
                    <?php if ($wa) : ?>
                        <a class="ghost-btn" href="https://wa.me/<?= $wa ?>?text=<?= rawurlencode('BLACK BUNNY order #'.$o['id'].' status '.$o['status'].($issued ? ' key '.$issued : '')) ?>" target="_blank" rel="noopener">PING BUYER</a>
                    <?php endif; ?>
                </div>
                <?php if ($o['status'] === 'pending') : ?>
                <form method="post" action="<?= site_url('public-control') ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="order_id" value="<?= (int) $o['id'] ?>">
                    <button name="verify_order" value="1" type="submit">VERIFY + KEY</button>
                    <button name="reject_order" value="1" type="submit">REJECT</button>
                </form>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php if (!$orders) : ?><p class="muted">No store orders yet.</p><?php endif; ?>
        </div>
    </section>
</div>
<div id="shopLightbox" class="shop-lightbox" hidden>
    <button type="button" class="shop-lightbox-x" id="lbClose">CLOSE</button>
    <div id="lbBody"></div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?php $waPing = session()->getFlashdata('shop_wa_ping'); ?>
<?php if ($waPing) : ?>
<script>window.open(<?= json_encode($waPing) ?>, '_blank', 'noopener');</script>
<?php endif; ?>
<script>
(function(){
  function clip(v, toast){
    v = String(v || '');
    if (!v) return;
    if (navigator.clipboard && navigator.clipboard.writeText) navigator.clipboard.writeText(v);
    else {
      var t = document.createElement('textarea');
      t.value = v; document.body.appendChild(t); t.select();
      try { document.execCommand('copy'); } catch (e) {}
      t.remove();
    }
    if (window.bbToast) window.bbToast(toast || 'COPIED', 'ok');
  }
  document.querySelectorAll('.key-chip').forEach(function(el){
    el.addEventListener('click', function(){
      clip(String(el.getAttribute('data-key') || '').trim() + '\nThanks for purchase.', 'KEY COPIED');
    });
  });
  document.querySelectorAll('.copy-details').forEach(function(el){
    el.addEventListener('click', function(){
      var key = String(el.getAttribute('data-key') || '').trim();
      var duration = el.getAttribute('data-duration') || '-';
      clip('BLACK BUNNY KEY\nKeys: 1\nDuration: ' + duration + '\n' + key + '\nThanks for purchase.', 'DETAILS COPIED');
    });
  });
  var wrap = document.querySelector('[data-filter-wrap]');
  if (wrap) {
    wrap.addEventListener('click', function(e){
      var btn = e.target.closest('[data-filter]');
      if (!btn) return;
      var f = btn.getAttribute('data-filter');
      wrap.querySelectorAll('[data-filter]').forEach(function(b){ b.classList.toggle('is-on', b === btn); });
      document.querySelectorAll('.order-row').forEach(function(row){
        row.hidden = (f !== 'all' && row.getAttribute('data-status') !== f);
      });
    });
  }
  var box = document.getElementById('shopLightbox');
  var body = document.getElementById('lbBody');
  var close = document.getElementById('lbClose');
  document.querySelectorAll('.media-preview').forEach(function(tile){
    tile.addEventListener('click', function(){
      if (!box || !body) return;
      var kind = tile.getAttribute('data-kind');
      var src = tile.getAttribute('data-src') || '';
      body.innerHTML = '';
      if (kind === 'video') {
        var v = document.createElement('video'); v.controls = true; v.autoplay = true; v.src = src; body.appendChild(v);
      } else {
        var img = document.createElement('img'); img.src = src; img.alt = tile.getAttribute('data-cap') || ''; body.appendChild(img);
      }
      box.hidden = false;
    });
  });
  if (close) close.addEventListener('click', function(){ box.hidden = true; body.innerHTML = ''; });
  if (box) box.addEventListener('click', function(e){ if (e.target === box) { box.hidden = true; body.innerHTML = ''; } });
})();
</script>
<?= $this->endSection() ?>
