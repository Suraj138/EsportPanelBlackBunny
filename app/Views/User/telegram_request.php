<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<?= view('Layout/HudCss') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?= view('Layout/HudHero', [
    'hudKick' => 'RESTRICTED MODULE',
    'hudTitle' => 'TELEGRAM',
    'hudAccent' => 'LOCKED',
    'hudOrbit' => 'GATE',
    'hudIcon' => 'lock',
    'hudClocks' => [
        ['label' => 'VAULT CLOCK', 'id' => 'hudClock', 'value' => '--'],
        ['label' => 'ROLE', 'value' => getLevel((int) $user->level)],
        ['label' => 'ACCESS', 'value' => 'DENIED', 'class' => 'rose'],
    ],
    'hudCta' => [
        ['label' => 'DASHBOARD', 'href' => site_url('dashboard')],
    ],
]) ?>

    <div class="glass-card rounded-2xl p-8 dk-reveal d1">
        <h2>ACCESS LOCKED</h2>
        <p class="muted">Aapka role is module ko manage nahi kar sakta. Owner ko request bhejne par wo Manage Users se Telegram access de sakta hai.</p>

        <div style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0">
            <span class="hud-chip">ROLE <?= esc(getLevel((int) $user->level)) ?></span>
            <span class="hud-chip">ACCOUNT <?= esc($user->username) ?></span>
            <span class="hud-chip" style="background:rgba(255,45,106,.18);color:#ff2d6a">NO BOT ACCESS</span>
        </div>

        <?php if ((int) $request_wait > 0) : ?>
            <p class="hud-chip" style="margin:12px 0">REQUEST SENT · RETRY IN <?= (int) ceil($request_wait / 60) ?> MIN</p>
        <?php else : ?>
            <?= form_open('telegram/request') ?>
                <button class="submit" type="submit">REQUEST OWNER ACCESS</button>
            <?= form_close() ?>
        <?php endif; ?>

        <p class="muted" style="margin-top:14px">Owner Telegram chat linked ho to request seedha owner ke bot par jayegi. Warna request audit log me record hogi.</p>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= view('Layout/HudJs', [
    'hudShape' => 'octa',
    'hudPhrases' => ['Bot control Owner ke paas hai. Access chahiye to request bhejo.', 'Owner Manage Users se Telegram access de sakta hai.'],
]) ?>
<?= $this->endSection() ?>
