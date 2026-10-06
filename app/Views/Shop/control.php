<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/shop.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/shop.css') ?: time() ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php
$pendingCount = 0;
foreach ($orders as $o) {
    if (($o['status'] ?? '') === 'pending') $pendingCount++;
}
$storeOn = !empty($cfg['page_on']) && $cfg['page_on'] === '1';
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

    <div class="ctrl-strip">
        <article><small>STORE</small><b class="<?= $storeOn ? 'hud-stat lime' : 'hud-stat rose' ?>"><?= $storeOn ? 'LIVE' : 'OFF' ?></b></article>
        <article><small>PLANS</small><b class="hud-stat"><?= count($plans) ?></b></article>
        <article><small>GALLERY</small><b class="hud-stat"><?= count($media) ?></b></article>
        <article><small>QUEUE</small><b class="hud-stat rose"><?= $pendingCount ?></b></article>
    </div>

    <?= form_open_multipart('public-control', ['class' => 'ctrl-page-form']) ?>
        <input type="hidden" name="save_page" value="1">

        <section class="ctrl-card">
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
            <div class="ctrl-actions"><button class="submit ctrl-save" type="submit">SAVE STORE / HERO</button></div>
        </section>

        <section class="ctrl-card">
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

        <section class="ctrl-card">
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

        <section class="ctrl-card">
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
        <section class="ctrl-card">
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

        <section class="ctrl-card">
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
                        <span><?= esc($m['kind']) ?> · <?= esc($m['caption'] ?: basename($m['file'])) ?></span>
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

    <section class="ctrl-card">
        <header><span>07 · PAYMENT QUEUE</span><em>manual verify</em></header>
        <div class="order-table">
            <?php foreach ($orders as $o) : ?>
            <div class="order-row">
                <div class="order-meta">
                    <strong>#<?= (int) $o['id'] ?> · <?= esc($o['customer_name']) ?></strong>
                    <small><?= esc($o['customer_phone']) ?> · txn <?= esc($o['txn_id']) ?> · Rs <?= (int) $o['amount'] ?></small>
                    <span class="order-status <?= esc($o['status']) ?>"><?= esc(strtoupper($o['status'])) ?></span>
                    <?php if ($o['issued_key']) : ?><small>KEY <?= esc($o['issued_key']) ?></small><?php endif; ?>
                    <?php $wa = waDigits($o['customer_phone']); ?>
                    <?php if ($wa) : ?>
                        <a class="ghost-btn" href="https://wa.me/<?= $wa ?>?text=<?= rawurlencode('BLACK BUNNY order #'.$o['id'].' status '.$o['status'].($o['issued_key'] ? ' key '.$o['issued_key'] : '')) ?>" target="_blank" rel="noopener">PING BUYER</a>
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
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?php $waPing = session()->getFlashdata('shop_wa_ping'); ?>
<?php if ($waPing) : ?>
<script>window.open(<?= json_encode($waPing) ?>, '_blank', 'noopener');</script>
<?php endif; ?>
<?= $this->endSection() ?>
