<?php
function color($value) {
if($value == 1) {
return "#0000FF";
} else {
return "#FF0000";
}
}
?>
<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<?= view('Layout/HudCss') ?>
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?= view('Layout/HudHero', [
    'hudKick' => 'ROSTER · MANAGE USERS',
    'hudTitle' => 'MANAGE',
    'hudAccent' => 'USERS',
    'hudOrbit' => 'ROSTER',
    'hudIcon' => 'users',
    'hudClocks' => [
        ['label' => 'VAULT CLOCK', 'id' => 'hudClock', 'value' => '--'],
        ['label' => 'NODES', 'value' => (string) (int) ($total ?? 0)],
        ['label' => 'QUERY', 'value' => strlen((string) ($q ?? '')) ? (string) $q : 'IDLE'],
    ],
    'hudCta' => [
        ['label' => 'CREATE REFERRAL', 'href' => site_url('admin/create-referral')],
        ['label' => 'AUDIT LOG', 'href' => site_url('audit')],
    ],
]) ?>
    <form method="get" action="<?= site_url('admin/manage-users') ?>" class="hud-search mb-6 dk-reveal d1">
        <input type="text" name="q" value="<?= esc($q ?? '') ?>" placeholder="SCAN USERNAME / FULLNAME / UPLINK">
        <button type="submit" class="submit">SCAN ROSTER</button>
    </form>
    <div class="glass-card rounded-2xl p-6 sm:p-8 dk-reveal d2">
        <div class="flex items-center justify-between mb-6">
            <h2>ROSTER GRID</h2>
            <span class="hud-chip"><?= (int) ($total ?? 0) ?> NODES</span>
        </div>
        <?php if ($user_list) : ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pic</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Level</th>
                            <th>Saldo</th>
                            <th>Status</th>
                            <th>Uplink</th>
                            <th>Referrals</th>
                            <th>Expiration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user_list as $u) : ?>
                        <tr>
                            <td><?= $u->id_users ?></td>
                            <td>
                                <?php $pic = function_exists('userAvatarUrl') ? userAvatarUrl($u) : ''; ?>
                                <span class="top-avatar"><?php if ($pic) : ?><img src="<?= esc($pic) ?>" alt=""><?php else : ?><?= esc(strtoupper(substr((string) ($u->fullname ?: $u->username), 0, 1))) ?><?php endif; ?></span>
                            </td>
                            <td><span><?= $u->username ?></span></td>
                            <td><?= $u->fullname ?></td>
                            <td>
                                <?php if($u->level == 1) : ?>
                                    <span class="hud-chip">Owner</span>
                                <?php elseif($u->level == 2) : ?>
                                    <span class="hud-chip">Admin</span>
                                <?php else : ?>
                                    <span class="hud-chip">User</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($u->level == 1) : ?>
                                    <span class="muted">∞</span>
                                <?php else : ?>
                                    <span class="hud-chip">Rs <?= $u->saldo ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($u->status == 1) : ?>
                                    <span class="hud-chip">Active</span>
                                <?php elseif($u->status == 2) : ?>
                                    <span class="hud-chip" style="color:#ff2d6a">Banned</span>
                                <?php else : ?>
                                    <span class="hud-chip" style="color:#ffb84d">Expired</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $u->uplink ?></td>
                            <td>
                                <?php
                                    $quota = (int) ($u->ref_accounts ?? 0);
                                    $used = (int) (($ref_used_map[$u->username] ?? 0));
                                    $left = max(0, $quota - $used);
                                ?>
                                <?php if ((int) $u->level === 1) : ?>
                                    <span class="muted">Owner</span>
                                <?php else : ?>
                                    <span class="hud-chip">USED <?= $used ?></span>
                                    <span class="hud-chip">LEFT <?= $left ?></span>
                                    <span class="muted" style="display:block;margin-top:4px">quota <?= $quota ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= $u->expiration_date ?></td>
                            <td>
                                <a href="<?= site_url('admin/user/' . $u->id_users) ?>" class="dk-btn kv-mini">EDIT</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p class="muted">No users found</p>
        <?php endif; ?>
        <?php if (!empty($pages) && $pages > 1) : ?>
        <div class="hud-pager">
            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                <a class="<?= ($page ?? 1) == $i ? 'on' : '' ?>" href="<?= site_url('admin/manage-users') ?>?q=<?= urlencode($q ?? '') ?>&page=<?= $i ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= view('Layout/HudJs', [
    'hudShape' => 'icosa',
    'hudPhrases' => ['Search operators by username, fullname, saldo or uplink.', 'Owner can patch any admin or reseller.', 'Referral mint stays inside quota.'],
]) ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>
<?= $this->endSection() ?>
