<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/shop.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/shop.css') ?: time() ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container-fluid px-4 py-6 control-deck">
    <div class="mb-4"><?= $this->include('Layout/msgStatus') ?></div>
    <section class="page-hero">
        <div class="hero-kicker">OWNER CONTROL</div>
        <h1>PUBLIC WEBSITE DECK</h1>
        <p>Toggle the store, price plans, drop media, and verify UPI orders from one lane.</p>
        <a class="ghost-btn" href="<?= site_url('shop') ?>" target="_blank" rel="noopener">OPEN PUBLIC STORE</a>
    </section>

    <div class="cmd-grid control-grid">
        <section class="cmd-panel fill">
            <header><span>PAGE / LEGAL / PAY</span><em>live switch</em></header>
            <?= form_open_multipart('public-control') ?>
                <input type="hidden" name="save_page" value="1">
                <label class="toggle-row">
                    <input type="checkbox" name="page_on" value="1" <?= !empty($cfg['page_on']) && $cfg['page_on'] === '1' ? 'checked' : '' ?>>
                    Public page ON
                </label>
                <div class="field"><label>HERO TITLE</label><input name="hero_title" value="<?= esc($cfg['hero_title'] ?? '') ?>"></div>
                <div class="field"><label>HERO SUB</label><input name="hero_sub" value="<?= esc($cfg['hero_sub'] ?? '') ?>"></div>
                <div class="field"><label>HERO TYPE</label>
                    <select name="hero_type">
                        <option value="photo" <?= ($cfg['hero_type'] ?? '') === 'photo' ? 'selected' : '' ?>>Photo</option>
                        <option value="video" <?= ($cfg['hero_type'] ?? '') === 'video' ? 'selected' : '' ?>>Video</option>
                    </select>
                </div>
                <div class="field"><label>HERO MEDIA</label><input type="file" name="hero_media"></div>
                <div class="field"><label>LOADER NAME</label><input name="loader_name" value="<?= esc($cfg['loader_name'] ?? 'BLACK BUNNY') ?>" placeholder="BLACK BUNNY"></div>
                <div class="field"><label>LOADER SIZE</label><input name="loader_size" value="<?= esc($cfg['loader_size'] ?? '10 MB') ?>" placeholder="10 MB"></div>
                <div class="field"><label>GAME</label><input name="loader_game" value="<?= esc($cfg['loader_game'] ?? 'BGMI / PUBG Mobile') ?>" placeholder="BGMI / PUBG Mobile"></div>
                <div class="field"><label>APK DOWNLOAD URL</label><input name="apk_url" value="<?= esc($cfg['apk_url'] ?? '') ?>" placeholder="https://... or upload below"></div>
                <div class="field"><label>APK FILE (UPLOAD)</label><input type="file" name="apk_file" accept=".apk"></div>
                <div class="field"><label>ABOUT</label><textarea name="about_text" rows="3"><?= esc($cfg['about_text'] ?? '') ?></textarea></div>
                <div class="field"><label>FEATURES</label><textarea name="features_text" rows="4"><?= esc($cfg['features_text'] ?? '') ?></textarea></div>
                <div class="field"><label>UPDATES</label><textarea name="updates_text" rows="3"><?= esc($cfg['updates_text'] ?? '') ?></textarea></div>
                <div class="field"><label>PRIVACY</label><textarea name="privacy_text" rows="3"><?= esc($cfg['privacy_text'] ?? '') ?></textarea></div>
                <div class="field"><label>TERMS</label><textarea name="terms_text" rows="3"><?= esc($cfg['terms_text'] ?? '') ?></textarea></div>
                <div class="field"><label>REFUND</label><textarea name="refund_text" rows="3"><?= esc($cfg['refund_text'] ?? '') ?></textarea></div>
                <div class="field"><label>CONTACT</label><textarea name="contact_text" rows="3"><?= esc($cfg['contact_text'] ?? '') ?></textarea></div>
                <div class="field"><label>UPI ID</label><input name="upi_id" value="<?= esc($cfg['upi_id'] ?? '') ?>"></div>
                <div class="field"><label>UPI NAME</label><input name="upi_name" value="<?= esc($cfg['upi_name'] ?? '') ?>"></div>
                <div class="field"><label>QR IMAGE</label><input type="file" name="qr_image"></div>
                <div class="field"><label>YOUTUBE</label><input name="youtube_url" value="<?= esc($cfg['youtube_url'] ?? '') ?>"></div>
                <div class="field"><label>INSTAGRAM</label><input name="instagram_url" value="<?= esc($cfg['instagram_url'] ?? '') ?>"></div>
                <div class="field"><label>TELEGRAM CHANNEL</label><input name="telegram_url" value="<?= esc($cfg['telegram_url'] ?? '') ?>"></div>
                <div class="field"><label>TELEGRAM SUPPORT</label><input name="telegram_support" value="<?= esc($cfg['telegram_support'] ?? '') ?>"></div>
                <div class="field"><label>OWNER WHATSAPP</label><input name="owner_whatsapp" value="<?= esc($cfg['owner_whatsapp'] ?? '') ?>" placeholder="91XXXXXXXXXX"></div>
                <div class="field"><label>ADMIN WHATSAPP</label><input name="admin_whatsapp" value="<?= esc($cfg['admin_whatsapp'] ?? '') ?>" placeholder="91XXXXXXXXXX"></div>
                <button class="submit" type="submit">SAVE PUBLIC PAGE</button>
            <?= form_close() ?>
        </section>

        <section class="cmd-panel">
            <header><span>KEY PLANS</span><em>price + show/hide</em></header>
            <?= form_open('public-control') ?>
                <input type="hidden" name="save_plan" value="1">
                <input type="hidden" name="plan_id" value="">
                <div class="field"><label>TITLE</label><input name="title" required placeholder="5 Hour Drop"></div>
                <div class="field"><label>HOURS</label><input name="hours" type="number" required value="5"></div>
                <div class="field"><label>PRICE RS</label><input name="price" type="number" required value="20"></div>
                <div class="field"><label>DEVICES</label><input name="devices" type="number" required value="1"></div>
                <div class="field"><label>BADGE</label><input name="badge" placeholder="BLITZ"></div>
                <div class="field"><label>SORT</label><input name="sort_order" type="number" value="0"></div>
                <label class="toggle-row"><input type="checkbox" name="visible" value="1" checked> Show on public store</label>
                <button class="submit" type="submit">ADD / SAVE PLAN</button>
            <?= form_close() ?>
            <div class="plan-admin">
                <?php foreach ($plans as $p) : ?>
                <form method="post" action="<?= site_url('public-control') ?>" class="plan-edit">
                    <?= csrf_field() ?>
                    <input type="hidden" name="save_plan" value="1">
                    <input type="hidden" name="plan_id" value="<?= (int) $p['id'] ?>">
                    <input name="title" value="<?= esc($p['title']) ?>">
                    <input name="hours" type="number" value="<?= (int) $p['hours'] ?>">
                    <input name="price" type="number" value="<?= (int) $p['price'] ?>">
                    <input name="devices" type="number" value="<?= (int) $p['devices'] ?>">
                    <input name="badge" value="<?= esc($p['badge']) ?>">
                    <input name="sort_order" type="number" value="<?= (int) $p['sort_order'] ?>">
                    <label><input type="checkbox" name="visible" value="1" <?= $p['visible'] ? 'checked' : '' ?>> ON</label>
                    <button type="submit">SAVE</button>
                </form>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="cmd-panel">
            <header><span>GALLERY</span><em>photo + video</em></header>
            <?= form_open_multipart('public-control') ?>
                <input type="hidden" name="upload_media" value="1">
                <div class="field"><label>FILE</label><input type="file" name="media_file" required></div>
                <div class="field"><label>CAPTION</label><input name="caption" placeholder="Season clip"></div>
                <div class="field"><label>SORT</label><input name="sort_order" type="number" value="0"></div>
                <button class="submit" type="submit">UPLOAD MEDIA</button>
            <?= form_close() ?>
            <div class="media-mini">
                <?php foreach ($media as $m) : ?>
                    <div><?= esc($m['kind']) ?> · <?= esc($m['caption'] ?: basename($m['file'])) ?></div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="cmd-panel fill">
            <header><span>PAYMENT QUEUE</span><em>manual verify</em></header>
            <div class="order-table">
                <?php foreach ($orders as $o) : ?>
                <div class="order-row">
                    <div>
                        <strong>#<?= (int) $o['id'] ?> · <?= esc($o['customer_name']) ?></strong>
                        <small><?= esc($o['customer_phone']) ?> · txn <?= esc($o['txn_id']) ?> · Rs <?= (int) $o['amount'] ?> · <?= esc($o['status']) ?></small>
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
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?php $waPing = session()->getFlashdata('shop_wa_ping'); ?>
<?php if ($waPing) : ?>
<script>window.open(<?= json_encode($waPing) ?>, '_blank', 'noopener');</script>
<?php endif; ?>
<?= $this->endSection() ?>
