<?php $uri = uri_string(); ?>
<?php
$roleLabel = 'User';
if (isset($user) && isset($user->level)) {
    if ($user->level == 1) $roleLabel = 'Owner';
    elseif ($user->level == 2) $roleLabel = 'Admin';
    else $roleLabel = 'User';
}
$initial = strtoupper(substr(session()->has('userid') && isset($user) ? getName($user) : 'G', 0, 1));
?>
<header class="app-shell-header">
    <aside class="app-sidebar" id="appSidebar">
        <div class="brand-lockup">
            <a href="<?= session()->has('userid') ? site_url('dashboard') : site_url('shop') ?>" class="brand-link">
                <?= $this->include('Layout/BrandMark') ?>
                <span class="brand-copy"><strong>BLACK BUNNY</strong><small>TACTICAL HUD</small></span>
            </a>
        </div>
        <?php if (session()->has('userid')) : ?>
        <nav class="side-nav">
            <a href="<?= site_url('dashboard') ?>" class="side-item <?= $uri === '' || $uri === 'dashboard' ? 'active' : '' ?>"><i></i><span>Dashboard</span></a>
            <a href="<?= site_url('keys') ?>" class="side-item <?= $uri === 'keys' ? 'active' : '' ?>"><i></i><span>View Keys</span></a>
            <a href="<?= site_url('keys/generate') ?>" class="side-item <?= strpos($uri, 'keys/generate') === 0 ? 'active' : '' ?>"><i></i><span>Generate Key</span></a>
            <a href="<?= site_url('search') ?>" class="side-item <?= strpos($uri, 'search') === 0 ? 'active' : '' ?>"><i></i><span>SCAN</span></a>
            <a href="<?= site_url('settings') ?>" class="side-item <?= strpos($uri, 'settings') === 0 ? 'active' : '' ?>"><i></i><span>Settings</span></a>
            <a href="<?= site_url('telegram') ?>" class="side-item <?= $uri === 'telegram' ? 'active' : '' ?>"><i></i><span>Telegram Bot</span></a>
            <?php if (($user->level == 1) || ($user->level == 2)) : ?>
                <a href="<?= site_url('Server') ?>" class="side-item <?= strpos($uri, 'Server') === 0 ? 'active' : '' ?>"><i></i><span>Online System</span></a>
                <a href="<?= site_url('admin/create-referral') ?>" class="side-item <?= strpos($uri, 'admin/create-referral') === 0 ? 'active' : '' ?>"><i></i><span>Create Referral</span></a>
                <a href="<?= site_url('public-control') ?>" class="side-item <?= strpos($uri, 'public-control') === 0 ? 'active' : '' ?>"><i></i><span>Public Control</span></a>
                <a href="<?= site_url('shop') ?>" class="side-item <?= $uri === 'shop' ? 'active' : '' ?>"><i></i><span>Public Shop</span></a>
                <a href="<?= site_url('store') ?>" class="side-item <?= $uri === 'store' || $uri === 'lib' ? 'active' : '' ?>"><i></i><span>Loader Packages</span></a>
            <?php endif; ?>
            <?php if (isset($user->level) && $user->level == 1) : ?>
                <a href="<?= site_url('admin/manage-users') ?>" class="side-item <?= strpos($uri, 'admin/manage-users') === 0 ? 'active' : '' ?>"><i></i><span>Manage Users</span></a>
                <a href="<?= site_url('audit') ?>" class="side-item <?= $uri === 'audit' ? 'active' : '' ?>"><i></i><span>Audit Log</span></a>
            <?php endif; ?>
            <a href="<?= site_url('logout') ?>" class="side-item logout"><i></i><span>Logout</span></a>
        </nav>
        <div class="sidebar-user">
            <div class="avatar-orb"><?= esc($initial) ?></div>
            <div>
                <strong><?= getName($user) ?></strong>
                <small><?= $roleLabel ?></small>
            </div>
        </div>
        <?php endif; ?>
    </aside>
    <div class="mobile-topbar">
        <a href="<?= session()->has('userid') ? site_url('dashboard') : site_url('shop') ?>" class="brand-link">
            <?= $this->include('Layout/BrandMark') ?>
            <span class="brand-copy"><strong>BLACK BUNNY</strong><small>TACTICAL HUD</small></span>
        </a>
        <a class="neon-menu" href="<?= site_url('search') ?>">SCAN</a>
        <button id="mobile-menu-button" class="neon-menu" type="button">MENU</button>
    </div>
    <div id="sidebarOverlay" class="sidebar-overlay"></div>
    <div class="app-topbar">
        <form class="topbar-search" action="<?= site_url('search') ?>" method="get">
            <span></span>
            <input name="q" placeholder="Search keys, users, licenses..." aria-label="Search">
        </form>
        <div class="topbar-actions">
            <span class="live-chip"><i></i> LIVE</span>
            <span class="top-avatar"><?= esc($initial) ?></span>
            <div>
                <strong><?= session()->has('userid') ? getName($user) : 'Guest' ?></strong>
                <small><?= session()->has('userid') ? $roleLabel : 'Guest' ?></small>
            </div>
        </div>
    </div>
</header>
<script>
(function(){
 const btn=document.getElementById('mobile-menu-button');
 const side=document.getElementById('appSidebar');
 const overlay=document.getElementById('sidebarOverlay');
 function closeMenu(){ if(side) side.classList.remove('mobile-open'); if(overlay) overlay.classList.remove('show'); }
 function openMenu(){ if(side) side.classList.add('mobile-open'); if(overlay) overlay.classList.add('show'); }
 if(btn&&side) btn.addEventListener('click',function(){ if(side.classList.contains('mobile-open')) closeMenu(); else openMenu(); });
 if(overlay) overlay.addEventListener('click', closeMenu);
})();
</script>
