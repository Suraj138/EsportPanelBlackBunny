<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<?= view('Layout/HudCss') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $avatarUrl = function_exists('userAvatarUrl') ? userAvatarUrl($user) : ''; ?>
<?= view('Layout/HudHero', [
    'hudKick' => 'OPERATOR · ACCOUNT SETTINGS',
    'hudTitle' => 'ACCOUNT',
    'hudAccent' => 'SETTINGS',
    'hudOrbit' => 'ID CORE',
    'hudIcon' => 'gear',
    'hudClocks' => [
        ['label' => 'VAULT CLOCK', 'id' => 'hudClock', 'value' => '--'],
        ['label' => 'OPERATOR', 'value' => $user->username],
        ['label' => 'LEVEL', 'value' => getLevel($user->level)],
    ],
    'hudCta' => [
        ['label' => 'TELEGRAM BOT', 'href' => site_url('telegram')],
        ['label' => 'DASHBOARD', 'href' => site_url('dashboard')],
    ],
]) ?>

    <div class="glass-card rounded-2xl p-8 mb-6 dk-reveal d1">
        <h2>PROFILE PIC</h2>
        <p class="muted">Owner, Admin and User can lock a HUD mugshot. JPG / PNG / WEBP / GIF · max 2 MB.</p>
        <div class="profile-pic-row">
            <div class="profile-pic-preview">
                <?php if ($avatarUrl) : ?>
                    <img src="<?= esc($avatarUrl) ?>" alt="Profile">
                <?php else : ?>
                    <span><?= esc(strtoupper(substr(getName($user), 0, 1))) ?></span>
                <?php endif; ?>
            </div>
            <div class="profile-pic-form">
                <?= form_open_multipart('settings') ?>
                    <input type="hidden" name="avatar_form" value="1">
                    <div class="field">
                        <label>IMAGE</label>
                        <input type="file" name="avatar" accept="image/jpeg,image/png,image/webp,image/gif" required>
                    </div>
                    <button class="submit" type="submit">LOCK PIC</button>
                <?= form_close() ?>
                <?php if ($avatarUrl) : ?>
                <?= form_open('settings') ?>
                    <input type="hidden" name="avatar_remove" value="1">
                    <button class="ghost-btn" type="submit">CLEAR PIC</button>
                <?= form_close() ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if ((int) $user->level == 1) : ?>
    <div class="glass-card rounded-2xl p-6 mb-6 dk-reveal d1">
        <h2>OWNER 2FA</h2>
        <?php if (!empty($otp_secret)) : ?>
            <p class="muted">Armed. Scan QR in Google Authenticator / Aegis.</p>
            <img class="otp-qr" alt="2FA QR" src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=<?= rawurlencode($otp_uri) ?>">
            <p class="hud-chip" style="margin:10px 0"><?= esc($otp_secret) ?></p>
            <p class="muted" style="word-break:break-all"><?= esc($otp_uri) ?></p>
            <?= form_open('settings') ?>
                <input type="hidden" name="otp_disable" value="1">
                <div class="field"><label>CONFIRM CODE</label><input name="otp_code" maxlength="6" placeholder="000000"></div>
                <button class="submit" type="submit">DISARM 2FA</button>
            <?= form_close() ?>
        <?php else : ?>
            <p class="muted">Not armed. Enable TOTP for owner portal login.</p>
            <?= form_open('settings') ?>
                <input type="hidden" name="otp_enable" value="1">
                <button class="submit" type="submit">ARM OWNER 2FA</button>
            <?= form_close() ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <p class="muted mb-6">Bot bind: <a href="<?= site_url('telegram') ?>" style="color:#00ffd0">Telegram Bot</a></p>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="glass-card rounded-2xl p-8 dk-reveal d2">
            <h2>CHANGE PASSWORD</h2>
            <p class="muted">Update your password to keep your account secure</p>
            <?= form_open() ?>
            <input type="hidden" name="password_form" value="1">
            <div class="space-y-5">
                <div>
                    <label for="current">Current Password</label>
                    <input type="password" name="current" id="current" class="input-field" placeholder="Enter your current password">
                    <?php if ($validation->hasError('current')) : ?>
                        <small class="text-red-500 text-xs mt-1 block"><?= $validation->getError('current') ?></small>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" class="input-field" placeholder="Enter your new password">
                    <?php if ($validation->hasError('password')) : ?>
                        <small class="text-red-500 text-xs mt-1 block"><?= $validation->getError('password') ?></small>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="password2">Confirm Password</label>
                    <input type="password" name="password2" id="password2" class="input-field" placeholder="Confirm your new password">
                    <?php if ($validation->hasError('password2')) : ?>
                        <small class="text-red-500 text-xs mt-1 block"><?= $validation->getError('password2') ?></small>
                    <?php endif; ?>
                </div>
                <div class="pt-2">
                    <button type="submit" class="submit w-full py-3 px-6">LOCK NEW KEY</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>

        <div class="glass-card rounded-2xl p-8 dk-reveal d2">
            <h2>ACCOUNT INFORMATION</h2>
            <p class="muted">Update your personal details</p>
            <?= form_open() ?>
            <input type="hidden" name="fullname_form" value="1">
            <div class="space-y-5">
                <div>
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" id="fullname" class="input-field" placeholder="Enter your full name" value="<?= old('fullname') ?: ($user->fullname ?: '') ?>">
                    <?php if ($validation->hasError('fullname')) : ?>
                        <small class="text-red-500 text-xs mt-1 block"><?= $validation->getError('fullname') ?></small>
                    <?php endif; ?>
                </div>
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-5 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Email</span>
                        <span class="text-sm font-semibold"><?= $user->email ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Username</span>
                        <span class="text-sm font-semibold"><?= $user->username ?></span>
                    </div>
                </div>
                <div class="pt-2">
                    <button type="submit" class="submit w-full py-3 px-6">LOCK IDENTITY</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <div class="glass-card rounded-2xl p-6 dk-reveal d2">
            <h3>SECURITY TIPS</h3>
            <ul class="space-y-2 text-sm">
                <li>Use a strong, unique password</li>
                <li>Change password regularly</li>
                <li>Never share your credentials</li>
            </ul>
        </div>
        <div class="glass-card rounded-2xl p-6 dk-reveal d2">
            <h3>ACCOUNT STATS</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm">Account Level</span>
                    <span class="hud-chip"><?= getLevel($user->level) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm">Balance</span>
                    <span class="hud-chip">Rs <?= $user->saldo ?></span>
                </div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-6 dk-reveal d2">
            <h3>QUICK ACTIONS</h3>
            <div class="space-y-2">
                <a href="<?= site_url('dashboard') ?>" class="dk-btn" style="width:100%">GO TO DASHBOARD</a>
                <a href="<?= base_url('keys') ?>" class="dk-btn" style="width:100%">MANAGE KEYS</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= view('Layout/HudJs', [
    'hudShape' => 'knot',
    'hudPhrases' => ['Swap cryptographic key, identity alias, profile pic, and Owner 2FA.', 'Bot bind lives on Telegram.', 'Lock a HUD mugshot. JPG PNG WEBP GIF.'],
]) ?>
<?= $this->endSection() ?>
