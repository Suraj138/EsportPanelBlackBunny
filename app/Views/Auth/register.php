<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= BASE_NAME ?> - Register</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/blackbunny.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/blackbunny.css') ?: time() ?>">
<style>
.register-card { max-height: calc(100vh - 48px); overflow-y: auto; }
.auth-wrap { grid-template-columns: 1fr 520px; }
@media (max-width: 980px) { .auth-wrap { grid-template-columns: 1fr; } }
</style>
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
        <?= view('Layout/RadarStage', ['brandSub' => 'Join the Arena']) ?>
        <section class="register-card">
            <?= $this->include('Layout/msgStatus') ?>
            <div class="card-kicker">NEW NODE</div>
            <h1>Create Account</h1>
            <p>Owner, Admin and User access through a referral key.</p>
            <?= form_open('', ['class' => 'login-form']) ?>
                <div class="field">
                    <label>EMAIL</label>
                    <input type="email" name="email" id="email" required minlength="13" maxlength="40" value="<?= old('email') ?>" placeholder="Enter your email">
                    <?php if ($validation->hasError('email')) : ?><small class="text-red-400"><?= $validation->getError('email') ?></small><?php endif; ?>
                </div>
                <div class="field">
                    <label>USERNAME</label>
                    <input type="text" name="username" id="username" required minlength="4" maxlength="24" value="<?= old('username') ?>" placeholder="Choose a username">
                    <?php if ($validation->hasError('username')) : ?><small class="text-red-400"><?= $validation->getError('username') ?></small><?php endif; ?>
                </div>
                <div class="field">
                    <label>FULL NAME</label>
                    <input type="text" name="fullname" id="fullname" required minlength="4" maxlength="24" value="<?= old('fullname') ?>" placeholder="Enter your full name">
                    <?php if ($validation->hasError('fullname')) : ?><small class="text-red-400"><?= $validation->getError('fullname') ?></small><?php endif; ?>
                </div>
                <div class="field">
                    <label>PASSWORD</label>
                    <input type="password" name="password" id="password" required minlength="6" maxlength="24" placeholder="Create a password">
                    <?php if ($validation->hasError('password')) : ?><small class="text-red-400"><?= $validation->getError('password') ?></small><?php endif; ?>
                </div>
                <div class="field">
                    <label>CONFIRM PASSWORD</label>
                    <input type="password" name="password2" id="password2" required minlength="6" maxlength="24" placeholder="Confirm your password">
                    <?php if ($validation->hasError('password2')) : ?><small class="text-red-400"><?= $validation->getError('password2') ?></small><?php endif; ?>
                </div>
                <div class="field">
                    <label>REFERRAL CODE</label>
                    <input type="text" name="referral" id="referral" required maxlength="25" value="<?= old('referral') ?>" placeholder="Enter referral code">
                    <?php if ($validation->hasError('referral')) : ?><small class="text-red-400"><?= $validation->getError('referral') ?></small><?php endif; ?>
                </div>
                <div class="field">
                    <label>IP ADDRESS</label>
                    <input type="text" id="ip" readonly placeholder="<?php echo $user_ip ?>">
                </div>
                <button type="submit" class="submit">CREATE ACCOUNT</button>
            <?= form_close() ?>
            <div class="secure"><a href="<?= site_url('login') ?>">Already have an account? Sign in</a></div>
        </section>
    </div>
</div>
<script src="<?= base_url('assets/js/blackbunny.js') ?>?v=<?= @filemtime(FCPATH . 'assets/js/blackbunny.js') ?: time() ?>"></script>
</body>
</html>
