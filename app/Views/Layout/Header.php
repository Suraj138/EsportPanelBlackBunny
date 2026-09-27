<?php $uri = uri_string(); ?>
<header class="app-shell-header">
    <aside class="app-sidebar" id="appSidebar">
        <div class="brand-lockup">
            <a href="<?= site_url() ?>" class="brand-link">
                <span class="brand-cube"><span>W</span></span>
                <span class="brand-copy"><strong>WALTER PANEL</strong><small>CONTROL EVERYTHING</small></span>
            </a>
        </div>
        <?php if (session()->has('userid')) : ?>
        <nav class="side-nav">
            <a href="<?= site_url() ?>" class="side-item <?= $uri === '' ? 'active' : '' ?>"><i>⌂</i><span>Dashboard</span></a>
            <a href="<?= site_url('keys/generate') ?>" class="side-item <?= strpos($uri, 'keys/generate') === 0 ? 'active' : '' ?>"><i>＋</i><span>Create Key</span></a>
            <a href="<?= site_url('keys') ?>" class="side-item <?= $uri === 'keys' ? 'active' : '' ?>"><i>⌁</i><span>View Keys</span></a>
            <a href="<?= site_url('keys/generate') ?>" class="side-item"><i>⚿</i><span>Generate Key</span></a>
            <a href="<?= site_url('admin/manage-users') ?>" class="side-item <?= strpos($uri, 'admin/manage-users') === 0 ? 'active' : '' ?>"><i>♙</i><span>Users</span></a>
            <a href="<?= site_url('settings') ?>" class="side-item <?= strpos($uri, 'settings') === 0 ? 'active' : '' ?>"><i>⚙</i><span>Settings</span></a>
            <?php if (($user->level == 1) || ($user->level == 2)) : ?>
                <a href="<?= site_url('Server') ?>" class="side-item <?= strpos($uri, 'Server') === 0 ? 'active' : '' ?>"><i>◉</i><span>Online System</span></a>
                <a href="<?= site_url('admin/create-referral') ?>" class="side-item <?= strpos($uri, 'admin/create-referral') === 0 ? 'active' : '' ?>"><i>♧</i><span>Create Referral</span></a>
            <?php endif; ?>
            <a href="<?= site_url('logout') ?>" class="side-item logout"><i>↪</i><span>Logout</span></a>
        </nav>
        <div class="sidebar-user">
            <div class="avatar-orb">◈</div><div><strong><?= getName($user) ?></strong><small>Super Admin</small></div>
        </div>
        <?php endif; ?>
    </aside>
    <div class="mobile-topbar">
        <a href="<?= site_url() ?>" class="brand-link"><span class="brand-cube"><span>W</span></span><span class="brand-copy"><strong>WALTER PANEL</strong><small>CONTROL EVERYTHING</small></span></a>
        <button id="mobile-menu-button" class="neon-menu">☰</button>
    </div>
    <div class="app-topbar">
        <div class="topbar-search"><span>⌕</span><input placeholder="Search anything..." aria-label="Search"></div>
        <div class="topbar-actions"><span class="pulse-dot">●</span><span>⚙</span><span class="top-avatar">◈</span><div><strong><?= session()->has('userid') ? getName($user) : 'Guest' ?></strong><small>Super Admin⌄</small></div></div>
    </div>
</header>
<script>
(function(){
 const btn=document.getElementById('mobile-menu-button'), side=document.getElementById('appSidebar');
 if(btn&&side) btn.addEventListener('click',()=>side.classList.toggle('mobile-open'));
})();
</script>
