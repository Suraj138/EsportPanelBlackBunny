<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<?= view('Layout/HudCss') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?= view('Layout/HudHero', [
    'hudKick' => 'UPLINK · CREATE REFERRAL',
    'hudTitle' => 'CREATE',
    'hudAccent' => 'REFERRAL',
    'hudOrbit' => 'MINT CORE',
    'hudIcon' => 'link',
    'hudClocks' => [
        ['label' => 'VAULT CLOCK', 'id' => 'hudClock', 'value' => '--'],
        ['label' => 'CODES', 'value' => (string) ($total_code ?? 0)],
        ['label' => 'LEFT', 'value' => !empty($is_owner) ? 'OWNER' : (string) (int) ($ref_left ?? 0)],
    ],
    'hudCta' => [
        ['label' => 'MANAGE USERS', 'href' => site_url('admin/manage-users')],
        ['label' => 'DASHBOARD', 'href' => site_url('dashboard')],
    ],
]) ?>

    <?php if (empty($is_owner)) : ?>
    <div class="glass-card rounded-2xl p-6 mb-6 dk-reveal d1" style="display:flex;flex-wrap:wrap;gap:14px;align-items:center">
        <span class="hud-chip">REFERRALS LEFT: <?= (int) $ref_left ?> / <?= (int) $ref_quota ?></span>
        <span class="hud-chip">USED: <?= (int) $ref_used ?></span>
        <?php if ((int) $ref_left < 1) : ?>
            <span class="hud-chip" style="background:rgba(255,45,106,.18);color:#ff2d6a">QUOTA COMPLETE · ASK OWNER FOR MORE</span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="glass-card rounded-2xl p-6 sm:p-8 dk-reveal d1">
            <h2>GENERATE <?= esc($title) ?></h2>
            <?= form_open('', ['class' => 'space-y-6']) ?>
                <div>
                    <label>Set Saldo</label>
                    <input type="number" name="set_saldo" value="5" min="1" max="99999">
                    <?php if ($validation->hasError('set_saldo')) : ?>
                        <small class="text-red-500 text-xs mt-1"><?= $validation->getError('set_saldo') ?></small>
                    <?php endif; ?>
                </div>
                <div>
                    <label>Account Expiration</label>
                    <?= form_dropdown(['class' => 'w-full', 'name' => 'accExpire', 'id' => 'accExpire'], $accExpire, old('accExpire') ?: '') ?>
                    <?php if ($validation->hasError('accExpire')) : ?>
                        <small class="text-red-500 text-xs mt-1"><?= $validation->getError('accExpire') ?></small>
                    <?php endif; ?>
                </div>
                <div>
                    <label>Account Level</label>
                    <?= form_dropdown(['class' => 'w-full', 'name' => 'accLevel', 'id' => 'accLevel'], $accLevel, old('accLevel') ?: '') ?>
                    <?php if ($validation->hasError('accLevel')) : ?>
                        <small class="text-red-500 text-xs mt-1"><?= $validation->getError('accLevel') ?></small>
                    <?php endif; ?>
                </div>
                <div>
                    <label>Panel Login Devices</label>
                    <input type="number" name="login_devices" value="<?= old('login_devices') ?: 1 ?>" min="1" max="99">
                    <p class="muted">How many different browsers/devices this new account may use.</p>
                    <?php if ($validation->hasError('login_devices')) : ?>
                        <small class="text-red-500 text-xs mt-1"><?= $validation->getError('login_devices') ?></small>
                    <?php endif; ?>
                </div>
                <div>
                    <label>Referral Accounts They Can Create</label>
                    <input type="number" name="ref_accounts" value="<?= old('ref_accounts') ?: 0 ?>" min="0" max="999">
                    <p class="muted">0 = cannot create child referrals. Owner can still set limits.</p>
                    <?php if ($validation->hasError('ref_accounts')) : ?>
                        <small class="text-red-500 text-xs mt-1"><?= $validation->getError('ref_accounts') ?></small>
                    <?php endif; ?>
                </div>
                <?php if (empty($is_owner) && (int) $ref_left < 1) : ?>
                <button type="button" class="w-full py-3 px-6 submit" disabled style="opacity:.45;cursor:not-allowed">QUOTA COMPLETE</button>
                <?php else : ?>
                <button type="submit" class="w-full py-3 px-6 submit">MINT REFERRAL</button>
                <?php endif; ?>
            <?= form_close() ?>
        </div>

        <div class="lg:col-span-2 glass-card rounded-2xl p-6 sm:p-8 dk-reveal d2">
            <h2>HISTORY GENERATE · TOTAL <?= $total_code ?></h2>
            <?php if ($code) : ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Referral</th>
                                <th>Hashed</th>
                                <th>Saldo</th>
                                <th>Level</th>
                                <th>Expiration</th>
                                <th>Devices</th>
                                <th>Ref Acc</th>
                                <th>Used by</th>
                                <th>Create by</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($code as $c) : ?>
                                <tr>
                                    <td><?= $c->id_reff ?></td>
                                    <td><span class="hud-chip"><?= $c->Referral ?></span></td>
                                    <td><?= substr($c->code, 1, 15) ?></td>
                                    <td><span class="hud-chip">Rs <?= $c->set_saldo ?></span></td>
                                    <td><?= $c->level ?></td>
                                    <td><?= $c->acc_expiration ?></td>
                                    <td><?= isset($c->login_devices) ? $c->login_devices : 1 ?></td>
                                    <td><?= isset($c->ref_accounts) ? $c->ref_accounts : 0 ?></td>
                                    <td><?= $c->used_by ?></td>
                                    <td><?= $c->created_by ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p class="muted">No referral codes generated yet</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= view('Layout/HudJs', [
    'hudShape' => 'knot',
    'hudPhrases' => ['Mint operator codes with saldo, role and device limits.', 'Quota applies to Admin and User. Owner is unlimited.', 'Child referrals inherit the uplink you set.'],
]) ?>
<?= $this->endSection() ?>
