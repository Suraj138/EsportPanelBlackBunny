<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<?= view('Layout/HudCss') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?= view('Layout/HudHero', [
    'hudKick' => 'TELEGRAM · BOT COMMAND DECK',
    'hudTitle' => 'BOT',
    'hudAccent' => 'DECK',
    'hudOrbit' => 'LINK CORE',
    'hudIcon' => 'bot',
    'hudClocks' => [
        ['label' => 'VAULT CLOCK', 'id' => 'hudClock', 'value' => '--'],
        ['label' => 'OPERATOR', 'value' => $user->username],
        ['label' => 'CHAT', 'value' => !empty($tg_chat_id) ? 'LINKED' : 'OPEN'],
    ],
    'hudCta' => [
        ['label' => 'SETTINGS', 'href' => site_url('settings')],
        ['label' => 'DASHBOARD', 'href' => site_url('dashboard')],
    ],
]) ?>

    <?php if ((int) $user->level == 1) : ?>
    <div class="glass-card rounded-2xl p-8 mb-6 dk-reveal d1">
        <h2>OWNER BOT TOKEN</h2>
        <p class="muted">@BotFather se /newbot karke token lo. Yahan paste + SAVE.</p>
        <?php
            $h = $tg_health ?? [];
            $live = !empty($h['live']);
            $hookOk = !empty($h['hook_ok']);
        ?>
        <?php if (empty($tg_bot_set)) : ?>
            <p class="hud-chip" style="margin:12px 0;background:rgba(255,45,106,.18);color:#ff2d6a">TOKEN NOT SET</p>
        <?php elseif ($live && $hookOk) : ?>
            <p class="hud-chip" style="margin:12px 0">LIVE <?= esc($h['username'] ?: $tg_bot_masked) ?></p>
            <p class="muted">Webhook OK<?= !empty($h['pending']) ? ' · pending ' . (int) $h['pending'] : '' ?></p>
        <?php elseif ($live) : ?>
            <p class="hud-chip" style="margin:12px 0;background:rgba(255,45,106,.18);color:#ff2d6a">BOT UP · HOOK FAIL</p>
            <p class="muted"><?= esc($h['username'] ?: $tg_bot_masked) ?> · <?= esc($h['hook_error'] ?: 'webhook empty') ?></p>
        <?php else : ?>
            <p class="hud-chip" style="margin:12px 0;background:rgba(255,45,106,.18);color:#ff2d6a">BOT DOWN</p>
            <p class="muted"><?= esc($h['hook_error'] ?: 'getMe fail') ?></p>
        <?php endif; ?>
        <?= form_open('telegram/setup') ?>
            <input type="hidden" name="tg_save" value="1">
            <div class="field">
                <label>PASTE BOT TOKEN HERE</label>
                <input name="tg_bot_token" type="text" autocomplete="off" spellcheck="false"
                       placeholder="123456789:AAHxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
            </div>
            <button class="submit" type="submit" style="margin-top:8px">SAVE BOT + WEBHOOK</button>
        <?= form_close() ?>
        <?php if (!empty($tg_webhook)) : ?>
            <p class="muted" style="margin-top:14px;word-break:break-all">HOOK <?= esc($tg_webhook) ?></p>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="glass-card rounded-2xl p-8 mb-6 dk-reveal d1">
        <h2>LINK YOUR ACCOUNT</h2>
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

    <div class="glass-card rounded-2xl p-8 dk-reveal d2">
        <h2>BOT PAD</h2>
        <p class="muted">Bottom pad always on: GENERATE · MY KEYS · RADAR · PRICES · QUICK 5H/1D/7D · ACCOUNT · UNLINK.</p>
        <p class="muted" style="margin-top:10px">GENERATE wizard: duration → devices → count → FIRE. MY KEYS: BLOCK / RESET / COPY / DELETE. UNUSED + LIVE filters.</p>
        <p class="muted">Owner sare keys. Admin / User sirf apni + saldo cut.</p>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= view('Layout/HudJs', [
    'hudShape' => 'torus',
    'hudPhrases' => ['Owner token yahan paste. Phir har user LINK CODE se bot bind kare.', 'Bot me login nahi. Settings nahi.', 'GENERATE wizard: duration, devices, count, FIRE.'],
]) ?>
<?= $this->endSection() ?>
