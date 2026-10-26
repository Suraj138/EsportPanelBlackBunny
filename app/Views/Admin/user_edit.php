<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<?= view('Layout/HudCss') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?= view('Layout/HudHero', [
    'hudKick' => 'OPERATOR PATCH · EDIT ACCOUNT',
    'hudTitle' => 'EDIT',
    'hudAccent' => 'ACCOUNT',
    'hudOrbit' => 'PATCH',
    'hudIcon' => 'users',
    'hudClocks' => [
        ['label' => 'VAULT CLOCK', 'id' => 'hudClock', 'value' => '--'],
        ['label' => 'TARGET', 'value' => getName($target)],
        ['label' => 'LEVEL', 'value' => getLevel($target->level)],
    ],
    'hudCta' => [
        ['label' => 'BACK TO ROSTER', 'href' => site_url('admin/manage-users')],
    ],
]) ?>
        <div class="glass-card rounded-2xl p-6 sm:p-8 dk-reveal d1">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2>ACCOUNT INFORMATION</h2>
                    <p class="muted"><?= getName($target) ?></p>
                </div>
                <a href="<?= site_url('admin/manage-users') ?>" class="dk-btn">BACK</a>
            </div>

            <?= form_open('', ['class' => 'space-y-6', 'enctype' => 'multipart/form-data']) ?>
                <input type="hidden" name="user_id" value="<?= $target->id_users ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label>Profile Pic</label>
                        <div class="flex items-center gap-4">
                            <?php $curPic = function_exists('userAvatarUrl') ? userAvatarUrl($target) : ''; ?>
                            <span class="top-avatar">
                                <?php if ($curPic) : ?><img src="<?= esc($curPic) ?>" alt=""><?php else : ?><?= esc(strtoupper(substr((string) ($target->fullname ?: $target->username), 0, 1))) ?><?php endif; ?>
                            </span>
                            <input type="file" name="avatar" accept="image/png,image/jpeg,image/webp,image/gif">
                        </div>
                        <p class="muted">JPG, PNG, WEBP or GIF, max 2 MB. Leave empty to keep current.</p>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="<?= old('email') ?: $target->email ?>" placeholder="name@example.com">
                        <?php if ($validation->hasError('email')) : ?>
                            <small class="text-red-500 text-xs mt-1"><?= $validation->getError('email') ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label>Username</label>
                        <input type="text" name="username" value="<?= old('username') ?: $target->username ?>" placeholder="Username">
                        <?php if ($validation->hasError('username')) : ?>
                            <small class="text-red-500 text-xs mt-1"><?= $validation->getError('username') ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Fullname</label>
                        <input type="text" name="fullname" value="<?= old('fullname') ?: $target->fullname ?>" placeholder="Full name">
                        <?php if ($validation->hasError('fullname')) : ?>
                            <small class="text-red-500 text-xs mt-1"><?= $validation->getError('fullname') ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>New Password</label>
                        <input type="text" name="new_password" value="" autocomplete="new-password" placeholder="Leave empty to keep current">
                        <p class="muted">Min 6 characters. Owner can reset any account password.</p>
                        <?php if ($validation->hasError('new_password')) : ?>
                            <small class="text-red-500 text-xs mt-1"><?= $validation->getError('new_password') ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Roles</label>
                        <?php $sel_level = ['' => '— Select Roles —', '1' => 'Owner', '2' => 'Admin', '3' => 'User']; ?>
                        <?= form_dropdown(['class' => 'w-full', 'name' => 'level', 'id' => 'level'], $sel_level, $target->level) ?>
                    </div>
                    <div>
                        <label>Status</label>
                        <?php
                            $sel_status = ['' => '— Select Status —', '2' => 'Banned/Block', '1' => 'Active', '3' => 'Expired'];
                            $curStatus = (int) $target->status;
                            if ($curStatus === 0) {
                                $curStatus = 3;
                            }
                        ?>
                        <?= form_dropdown(['class' => 'w-full', 'name' => 'status', 'id' => 'status'], $sel_status, $curStatus) ?>
                    </div>
                    <div>
                        <label>Saldo</label>
                        <input type="number" name="saldo" value="<?= old('saldo') ?: $target->saldo ?>" placeholder="0">
                        <?php if ($validation->hasError('saldo')) : ?>
                            <small class="text-red-500 text-xs mt-1"><?= $validation->getError('saldo') ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Uplink</label>
                        <input type="text" name="uplink" value="<?= old('uplink') ?: $target->uplink ?>" placeholder="Uplink">
                        <?php if ($validation->hasError('uplink')) : ?>
                            <small class="text-red-500 text-xs mt-1"><?= $validation->getError('uplink') ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Panel Login Devices</label>
                        <input type="number" name="login_devices" value="<?= old('login_devices') ?: (int) ($target->login_devices ?? 1) ?>" min="1" max="99">
                        <p class="muted">1 = sirf ek device login. Dusre device ke liye owner reset karega.</p>
                    </div>
                    <div>
                        <label>Referral Quota</label>
                        <input type="number" name="ref_accounts" value="<?= old('ref_accounts') ?: (int) ($target->ref_accounts ?? 0) ?>" min="0" max="999">
                        <div class="flex flex-wrap gap-2 mt-2">
                            <span class="hud-chip">USED <?= (int) ($ref_used ?? 0) ?></span>
                            <span class="hud-chip">LEFT <?= (int) ($ref_left ?? 0) ?></span>
                            <span class="hud-chip">QUOTA <?= (int) ($ref_quota ?? 0) ?></span>
                        </div>
                        <p class="muted">Is account ne kitne referral mint kiye, kitne bache hain. Quota badhao/ghatao yahan se.</p>
                    </div>
                    <div>
                        <label>Telegram Bot Access</label>
                        <label class="toggle-row"><input type="checkbox" name="tg_access" value="1" <?= !empty($target->tg_access) ? 'checked' : '' ?>> Allow this account to open the Telegram bot deck</label>
                        <p class="muted">Admin request bhejega, Owner yahan se grant karega.</p>
                    </div>
                    <div class="md:col-span-2">
                        <label>Expiration Date</label>
                        <input type="text" name="expiration" value="<?= old('expiration') ?: $target->expiration_date ?>" placeholder="YYYY-MM-DD HH:MM:SS">
                        <p class="muted">Bound devices: <b><?= (int) ($bound_count ?? 0) ?></b> / <?= (int) ($target->login_devices ?? 1) ?></p>
                        <?php if (!empty($bound_reset_wait)) : ?>
                            <p class="muted" style="color:#ffb84d">Device reset locked: <?= (int) floor($bound_reset_wait / 3600) ?>h <?= (int) floor(($bound_reset_wait % 3600) / 60) ?>m left (24h cooldown).</p>
                        <?php endif; ?>
                        <label class="toggle-row" style="margin-top:12px"><input type="checkbox" name="reset_bound" value="1" <?= !empty($bound_reset_wait) ? 'disabled' : '' ?>> Reset bound panel logins</label>
                        <?php if ($validation->hasError('expiration')) : ?>
                            <small class="text-red-500 text-xs mt-1"><?= $validation->getError('expiration') ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <button type="submit" class="w-full py-4 px-6 submit">LOCK ACCOUNT PATCH</button>
            <?= form_close() ?>

            <?php if ((int) $target->id_users !== (int) $user->id_users) : ?>
            <div class="mt-8 pt-6 border-t border-red-200">
                <h3 class="text-red-600 font-bold mb-2">DANGER ZONE</h3>
                <p class="muted mb-4">Permanently remove <b><?= esc($target->username) ?></b>. This cannot be undone.</p>
                <form method="post" action="<?= site_url('admin/user/' . $target->id_users . '/delete') ?>" onsubmit="return confirm('Delete <?= esc($target->username) ?> permanently?');">
                    <?= csrf_field() ?>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <input type="text" name="confirm" placeholder="Type DELETE to confirm">
                        <button type="submit" class="ghost-btn" style="border-color:rgba(255,45,106,.45);color:#ff2d6a">DELETE ACCOUNT</button>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= view('Layout/HudJs', [
    'hudShape' => 'knot',
    'hudPhrases' => ['Role, saldo and expiration for this operator.', 'Owner can edit any admin or reseller.', 'Telegram access is granted here.'],
]) ?>
<?= $this->endSection() ?>
