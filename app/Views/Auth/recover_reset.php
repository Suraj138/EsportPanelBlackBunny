<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= BASE_NAME ?> - Reset Key</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/blackbunny.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/blackbunny.css') ?: time() ?>">
</head>
<body>
<?= view('Layout/WelcomeSplash') ?>
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
        <?= view('Layout/RadarStage', ['brandSub' => 'Set New Cryptographic Key']) ?>
        <section class="login-card">
            <div class="status"><?= $this->include('Layout/msgStatus') ?></div>
            <div class="card-kicker">NEW CIPHER</div>
            <h1>Reset Key</h1>
            <p>Identity verified. Choose a new cryptographic key.</p>
            <?= form_open('', ['class'=>'login-form']) ?>
            <div class="field">
                <label>NEW CRYPTOGRAPHIC KEY</label>
                <input type="password" name="password" required minlength="6" placeholder="Enter new key">
                <?php if ($validation->hasError('password')) : ?>
                    <small class="text-red-400"><?= $validation->getError('password') ?></small>
                <?php endif; ?>
            </div>
            <div class="field">
                <label>CONFIRM KEY</label>
                <input type="password" name="password2" required minlength="6" placeholder="Confirm new key">
                <?php if ($validation->hasError('password2')) : ?>
                    <small class="text-red-400"><?= $validation->getError('password2') ?></small>
                <?php endif; ?>
            </div>
            <button type="submit" class="submit">SAVE NEW KEY</button>
            <?= form_close() ?>
            <div class="secure"><a href="<?= site_url('login') ?>">Back to Portal Access</a></div>
        </section>
    </div>
</div>
<script src="<?= base_url('assets/js/blackbunny.js') ?>?v=<?= @filemtime(FCPATH . 'assets/js/blackbunny.js') ?: time() ?>"></script>
</body>
</html>
