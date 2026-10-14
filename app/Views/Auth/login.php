<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= BASE_NAME ?> - Login</title>
</head>
<body class="bba">
<?= view('Layout/WelcomeSplash') ?>
<?= view('Layout/AuthBackdrop') ?>

<div class="auth-scene">
    <div class="auth-brand">
        <div class="hex">BB</div>
        <div>
            <h1>BLACK BUNNY</h1>
            <small>PREMIUM APK STORE</small>
        </div>
    </div>
    <div class="auth-ticks">
        <span><i></i> NODE ONLINE</span>
        <span><i></i> ENCRYPTION ACTIVE</span>
        <span><i></i> LOBBY LINKED</span>
    </div>

    <section class="auth-card">
        <div class="a-head">
            <span class="dot r"></span><span class="dot y"></span><span class="dot g"></span>
            BB-PANEL v2.0 &mdash; SECURE LOGIN
            <span class="a-live">&bull; LIVE</span>
        </div>
        <div class="a-body">
            <div class="a-kicker">// SECURE CHANNEL</div>
            <h2>PORTAL ACCESS</h2>
            <p>Authorize operator identity. Drop in. Own the lobby.</p>

            <?= $this->include('Layout/msgStatus') ?>

            <?= form_open('', ['class'=>'login-form', 'autocomplete'=>'on']) ?>
            <div class="a-field">
                <label>OPERATOR ID / USERNAME</label>
                <input type="text" name="username" id="username" required autocomplete="username" placeholder="Enter identity alias" value="<?= old('username') ?>">
                <?php if ($validation->hasError('username')) : ?><small><?= esc($validation->getError('username')) ?></small><?php endif; ?>
            </div>
            <div class="a-field">
                <label>CRYPTOGRAPHIC KEY</label>
                <input type="password" name="password" id="password" required minlength="6" autocomplete="current-password" placeholder="Enter cryptographic key">
                <?php if ($validation->hasError('password')) : ?><small><?= esc($validation->getError('password')) ?></small><?php endif; ?>
            </div>
            <input type="hidden" name="ip" value="portal" id="ip">
            <div class="a-rowx">
                <label><input class="a-check" type="checkbox" name="stay_log" id="stay_log" value="1"> 24H Session Active</label>
                <a href="<?= site_url('recover') ?>">Recover Key?</a>
            </div>
            <button type="submit" class="a-btn">AUTHENTICATE &amp; ENTER</button>
            <?= form_close() ?>
            <div class="a-foot">Unregistered node? <a href="<?= site_url('register') ?>">Register Identity</a></div>
            <div class="a-alt">OWNER &middot; ADMIN &middot; USER</div>
        </div>
    </section>
</div>
</body>
</html>
