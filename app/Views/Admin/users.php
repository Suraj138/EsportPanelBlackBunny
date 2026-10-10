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
<?= $this->section('content') ?>

<div class="container-fluid px-4 py-6">
    <section class="page-hero">
        <div class="hero-kicker">ROSTER</div>
        <h1>MANAGE USERS</h1>
        <p>Search operators by username, fullname, saldo or uplink.</p>
    </section>
    <form method="get" action="<?= site_url('admin/manage-users') ?>" class="hud-search mb-6">
        <input type="text" name="q" value="<?= esc($q ?? '') ?>" placeholder="SCAN USERNAME / FULLNAME / UPLINK">
        <button type="submit" class="submit">SCAN ROSTER</button>
    </form>
    <div class="glass-card rounded-2xl p-6 sm:p-8 animate-fade-in-up" style="animation-delay: 0.1s">
        <div class="flex items-center justify-between mb-6">
            <h2>ROSTER GRID</h2>
            <span class="hud-chip"><?= (int) ($total ?? 0) ?> NODES</span>
        </div>
        
        <?php if ($user_list) : ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Pic</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Username</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Fullname</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Level</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Saldo</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Uplink</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Expiration</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user_list as $u) : ?>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-700"><?= $u->id_users ?></td>
                            <td class="px-4 py-3">
                                <?php $pic = function_exists('userAvatarUrl') ? userAvatarUrl($u) : ''; ?>
                                <span class="top-avatar"><?php if ($pic) : ?><img src="<?= esc($pic) ?>" alt=""><?php else : ?><?= esc(strtoupper(substr((string) ($u->fullname ?: $u->username), 0, 1))) ?><?php endif; ?></span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-semibold text-gray-800"><?= $u->username ?></span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700"><?= $u->fullname ?></td>
                            <td class="px-4 py-3">
                                <?php if($u->level == 1) : ?>
                                    <span class="px-2 py-1 bg-gradient-to-r from-purple-100 to-pink-100 text-purple-700 rounded-lg text-xs font-semibold">
                                        Owner
                                    </span>
                                <?php elseif($u->level == 2) : ?>
                                    <span class="px-2 py-1 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 rounded-lg text-xs font-semibold">
                                        Admin
                                    </span>
                                <?php else : ?>
                                    <span class="px-2 py-1 bg-gradient-to-r from-green-100 to-teal-100 text-green-700 rounded-lg text-xs font-semibold">
                                        User
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <?php if($u->level == 1) : ?>
                                    <span class="text-gray-400">∞</span>
                                <?php else : ?>
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-semibold">
                                        ₹<?= $u->saldo ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <?php if($u->status == 1) : ?>
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-semibold">
                                        Active
                                    </span>
                                <?php elseif($u->status == 2) : ?>
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-semibold">
                                        Banned
                                    </span>
                                <?php else : ?>
                                    <span class="px-2 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs font-semibold">
                                        Expired
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700"><?= $u->uplink ?></td>
                            <td class="px-4 py-3 text-sm text-gray-700"><?= $u->expiration_date ?></td>
                            <td class="px-4 py-3">
                                <a href="<?= site_url('admin/user/' . $u->id_users) ?>" class="px-3 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-500 hover:to-pink-500 transition-all inline-flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span class="text-xs">Edit</span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p class="text-center muted py-8">No users found</p>
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

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
     .gradient-bg { background: linear-gradient(135deg, #083048 0%, #00ffd0 100%); }
</style>

<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>
<?= $this->endSection() ?>