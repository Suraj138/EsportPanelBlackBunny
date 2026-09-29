<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= BASE_NAME ?> - Login</title>
<script src="https://cdn.tailwindcss.com"></script>
<?= link_tag('assets/css/blackbunny.css') ?>
</head>
<body>
<div class="bb-stage">
    <div class="bb-aurora"></div>
    <div class="bb-grid"></div>
    <div class="bb-orb a"></div>
    <div class="bb-orb b"></div>
    <div class="bb-vignette"></div>
    <div class="bb-film"></div>
</div>
<div class="auth-scene">
    <div class="auth-wrap">
        <?= view('Layout/RadarStage', ['brandSub' => 'Esport Key HUD']) ?>
        <section class="login-card">
            <div class="status"><?= $this->include('Layout/msgStatus') ?></div>
            <div class="card-kicker">SECURE CHANNEL</div>
            <h1>PORTAL ACCESS</h1>
            <p>Authorize operator identity. Drop in. Own the lobby.</p>
            <?= form_open('', ['class'=>'login-form']) ?>
            <div class="field">
                <label>OPERATOR ID / USERNAME</label>
                <input type="text" name="username" id="username" required placeholder="Enter identity alias">
                <?php if ($validation->hasError('username')) : ?>
                    <small class="text-red-400"><?= $validation->getError('username') ?></small>
                <?php endif; ?>
            </div>
            <div class="field">
                <label>CRYPTOGRAPHIC KEY</label>
                <input type="password" name="password" id="password" required minlength="6" placeholder="Enter cryptographic key">
                <?php if ($validation->hasError('password')) : ?>
                    <small class="text-red-400"><?= $validation->getError('password') ?></small>
                <?php endif; ?>
            </div>
            <input type="hidden" name="ip" value="<?= $_SERVER['HTTP_USER_AGENT']; ?>" id="ip" required>
            <div class="rowx">
                <label><input type="checkbox" name="stay_log" id="stay_log" value="1"> 24H Session Active</label>
                <a href="<?= site_url('recover') ?>">Recover Key?</a>
            </div>
            <button type="submit" class="submit">AUTHENTICATE &amp; ENTER</button>
            <?= form_close() ?>
            <div class="secure">Unregistered node? <a href="<?= site_url('register') ?>">Register Identity</a></div>
            <div class="secure">Owner · Admin · User</div>
        </section>
    </div>
</div>
<?= script_tag('assets/js/blackbunny.js') ?>
</body>
</html>
