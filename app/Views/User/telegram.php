<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-4 py-6">
    <section class="page-hero">
        <div class="hero-kicker">TELEGRAM</div>
        <h1>BOT COMMAND DECK</h1>
        <p>Owner token yahan paste. Phir har user LINK CODE se bot bind kare.</p>
    </section>
    <div class="mb-6"><?= $this->include('Layout/msgStatus') ?></div>

    <?php if ((int) $user->level == 1) : ?>
    <div class="glass-card rounded-2xl p-8 mb-6" style="border:2px solid #00ffd0">
        <h2 style="font-family:Orbitron,sans-serif;letter-spacing:.12em;color:#00ffd0;margin:0 0 8px">OWNER BOT TOKEN</h2>
        <p class="muted">@BotFather se /newbot karke token lo. Yahan paste + SAVE.</p>
        <?php if (!empty($tg_bot_set)) : ?>
            <p class="hud-chip" style="margin:12px 0">LIVE <?= esc($tg_bot_masked) ?></p>
        <?php else : ?>
            <p class="hud-chip" style="margin:12px 0;background:rgba(255,45,106,.18);color:#ff2d6a">TOKEN NOT SET</p>
        <?php endif; ?>
        <?= form_open('telegram/setup') ?>
            <input type="hidden" name="tg_save" value="1">
            <div class="field">
                <label>PASTE BOT TOKEN HERE</label>
                <input name="tg_bot_token" type="text" autocomplete="off" spellcheck="false"
                       placeholder="123456789:AAHxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
                       style="width:100%;height:56px;font-size:16px;font-family:monospace;letter-spacing:.04em">
            </div>
            <button class="submit" type="submit" style="margin-top:8px">SAVE BOT + WEBHOOK</button>
        <?= form_close() ?>
        <?php if (!empty($tg_webhook)) : ?>
            <p class="muted" style="margin-top:14px;word-break:break-all">HOOK <?= esc($tg_webhook) ?></p>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="glass-card rounded-2xl p-8 mb-6">
        <h2 style="font-family:Orbitron,sans-serif;letter-spacing:.12em;color:#00ffd0;margin:0 0 8px">LINK YOUR ACCOUNT</h2>
        <p class="muted">Bot me login nahi. Settings nahi. Yahan code banao, Telegram pe bhejo.</p>
        <?php if (!empty($tg_chat_id)) : ?>
            <p class="hud-chip" style="margin:12px 0">LINKED CHAT <?= esc($tg_chat_id) ?></p>
            <?= form_open('telegram/link') ?>
                <input type="hidden" name="tg_self_unlink" value="1">
                <button class="submit" type="submit">UNLINK TELEGRAM</button>
            <?= form_close() ?>
        <?php else : ?>
            <?php if (!empty($tg_link_code) && !empty($tg_link_exp) && strtotime($tg_link_exp) > time()) : ?>
                <p class="muted">Bot ko ye message bhejo (10 min):</p>
                <p class="hud-chip" style="margin:12px 0;font-size:18px">/start <?= esc($tg_link_code) ?></p>
            <?php endif; ?>
            <?= form_open('telegram/link') ?>
                <input type="hidden" name="tg_make_code" value="1">
                <button class="submit" type="submit">MAKE LINK CODE</button>
            <?= form_close() ?>
        <?php endif; ?>
    </div>

    <div class="glass-card rounded-2xl p-8">
        <h2 style="font-family:Orbitron,sans-serif;letter-spacing:.12em;color:#00ffd0;margin:0 0 8px">BOT PAD</h2>
        <p class="muted">Bottom pad always on: GENERATE · MY KEYS · RADAR · PRICES · QUICK 5H/1D/7D · ACCOUNT · UNLINK.</p>
        <p class="muted" style="margin-top:10px">GENERATE wizard: duration → devices → count → FIRE. MY KEYS: BLOCK / RESET / COPY / DELETE. UNUSED + LIVE filters.</p>
        <p class="muted">Owner sare keys. Admin / User sirf apni + saldo cut.</p>
    </div>
</div>
<?= $this->endSection() ?>
