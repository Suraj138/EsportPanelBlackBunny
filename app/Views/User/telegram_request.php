<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-4 py-6">
    <section class="page-hero">
        <div class="hero-kicker">RESTRICTED MODULE</div>
        <h1>TELEGRAM BOT</h1>
        <p>Bot control Owner ke paas hai. Access chahiye to request bhejo.</p>
    </section>
    <div class="mb-6"><?= $this->include('Layout/msgStatus') ?></div>

    <div class="glass-card rounded-2xl p-8" style="border:1px solid rgba(0,255,208,.25)">
        <h2 style="font-family:Orbitron,sans-serif;letter-spacing:.12em;color:#00ffd0;margin:0 0 10px">ACCESS LOCKED</h2>
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
