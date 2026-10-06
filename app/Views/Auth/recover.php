<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= BASE_NAME ?> - Recover Key</title>
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
        <?= view('Layout/RadarStage', ['brandSub' => 'Recover Cryptographic Key']) ?>
        <section class="login-card">
            <div class="status"><?= $this->include('Layout/msgStatus') ?></div>
            <div class="card-kicker">IDENTITY CHECK</div>
            <h1>Recover Key</h1>
            <p>Verify operator identity to request a cryptographic key reset.</p>
            <?= form_open('', ['class'=>'login-form']) ?>
            <div class="field">
                <label>OPERATOR ID / USERNAME</label>
                <input type="text" name="username" id="username" required placeholder="Enter identity alias" value="<?= old('username') ?>">
            </div>
            <div class="field">
                <label>REGISTERED EMAIL</label>
                <input type="email" name="email" id="email" required placeholder="Enter registered email" value="<?= old('email') ?>">
            </div>
            <button type="submit" class="submit">REQUEST RECOVERY</button>
            <?= form_close() ?>
            <div class="secure"><a href="<?= site_url('login') ?>">Back to Portal Access</a></div>
        </section>
    </div>
</div>
<script src="<?= base_url('assets/js/blackbunny.js') ?>?v=<?= @filemtime(FCPATH . 'assets/js/blackbunny.js') ?: time() ?>"></script>
</body>
</html>
