<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= BASE_NAME ?> - Register</title>
</head>
<body class="bba">
<?= view('Layout/WelcomeSplash') ?>
<?= view('Layout/AuthBackdrop') ?>

<div class="auth-scene">
    <div class="auth-brand">
        <div class="hex">BB</div>
        <div>
            <h1>BLACK BUNNY</h1>
            <small>JOIN THE ARENA</small>
        </div>
    </div>
    <div class="auth-ticks">
        <span><i></i> NEW NODE</span>
        <span><i></i> REFERRAL GATED</span>
        <span><i></i> HWID READY</span>
    </div>

    <section class="auth-card wide">
        <div class="a-head">
            <span class="dot r"></span><span class="dot y"></span><span class="dot g"></span>
            BB-PANEL v2.0 &mdash; NEW IDENTITY
            <span class="a-live">&bull; LIVE</span>
        </div>
        <div class="a-body">
            <div class="a-kicker">// NEW NODE</div>
            <h2>CREATE ACCOUNT</h2>
            <p>Owner, Admin and User access through a referral key.</p>

            <?= $this->include('Layout/msgStatus') ?>

            <?= form_open('', ['class' => 'login-form', 'autocomplete' => 'on']) ?>
                <div class="a-grid">
                    <div class="a-field">
                        <label>EMAIL</label>
                        <input type="email" name="email" id="email" required minlength="13" maxlength="40" value="<?= old('email') ?>" placeholder="Enter your email">
                        <?php if ($validation->hasError('email')) : ?><small><?= esc($validation->getError('email')) ?></small><?php endif; ?>
                    </div>
                    <div class="a-field">
                        <label>USERNAME</label>
                        <input type="text" name="username" id="username" required minlength="4" maxlength="24" value="<?= old('username') ?>" placeholder="Choose a username">
                        <?php if ($validation->hasError('username')) : ?><small><?= esc($validation->getError('username')) ?></small><?php endif; ?>
                    </div>
                </div>
                <div class="a-field">
                    <label>FULL NAME</label>
                    <input type="text" name="fullname" id="fullname" required minlength="4" maxlength="24" value="<?= old('fullname') ?>" placeholder="Enter your full name">
                    <?php if ($validation->hasError('fullname')) : ?><small><?= esc($validation->getError('fullname')) ?></small><?php endif; ?>
                </div>
                <div class="a-grid">
                    <div class="a-field">
                        <label>PASSWORD</label>
                        <input type="password" name="password" id="password" required minlength="6" maxlength="24" placeholder="Create a password">
                        <?php if ($validation->hasError('password')) : ?><small><?= esc($validation->getError('password')) ?></small><?php endif; ?>
                    </div>
                    <div class="a-field">
                        <label>CONFIRM PASSWORD</label>
                        <input type="password" name="password2" id="password2" required minlength="6" maxlength="24" placeholder="Confirm your password">
                        <?php if ($validation->hasError('password2')) : ?><small><?= esc($validation->getError('password2')) ?></small><?php endif; ?>
                    </div>
                </div>
                <div class="a-grid">
                    <div class="a-field">
                        <label>REFERRAL CODE</label>
                        <input type="text" name="referral" id="referral" required maxlength="25" value="<?= old('referral') ?>" placeholder="Enter referral code">
                        <?php if ($validation->hasError('referral')) : ?><small><?= esc($validation->getError('referral')) ?></small><?php endif; ?>
                    </div>
                    <div class="a-field">
                        <label>IP ADDRESS</label>
                        <input type="text" id="ip" readonly value="<?= esc($user_ip) ?>">
                    </div>
                </div>
                <button type="submit" class="a-btn purple">CREATE ACCOUNT</button>
            <?= form_close() ?>
            <div class="a-foot"><a href="<?= site_url('login') ?>">Already have an account? Sign in</a></div>
        </div>
    </section>
</div>
</body>
</html>
