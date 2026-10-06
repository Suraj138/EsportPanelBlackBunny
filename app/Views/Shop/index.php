<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= esc($cfg['hero_title'] ?? 'BLACK BUNNY') ?> · Public Store</title>
<link rel="stylesheet" href="<?= base_url('assets/css/blackbunny.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/blackbunny.css') ?: time() ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/shop.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/shop.css') ?: time() ?>">
</head>
<body class="shop-body">
<?= view('Layout/WelcomeSplash') ?>
<div class="bb-stage">
    <div class="bb-aurora"></div>
    <div class="bb-grid"></div>
    <div class="bb-orb a"></div>
    <div class="bb-orb b"></div>
    <div class="bb-vignette"></div>
    <div class="bb-film"></div>
</div>
<header class="shop-nav">
    <a class="brand-link" href="<?= site_url('shop') ?>">
        <?= view('Layout/BrandMark') ?>
        <span class="brand-copy"><strong>BLACK BUNNY</strong><small>PUBLIC STORE</small></span>
    </a>
    <nav id="shopNav">
        <a href="#loader"><?= shopLang('Loader', 'Loader') ?></a>
        <a href="#plans"><?= shopLang('Plans', 'Plans') ?></a>
        <a href="#gallery"><?= shopLang('Gallery', 'Gallery') ?></a>
        <a href="#about"><?= shopLang('About', 'Baare mein') ?></a>
        <a href="<?= site_url('shop/lookup') ?>"><?= shopLang('Track', 'Track') ?></a>
        <a href="<?= site_url('shop/legal/contact') ?>"><?= shopLang('Contact', 'Contact') ?></a>
        <a href="<?= site_url('shop/lang/' . ((isset($_COOKIE['bb_lang']) && $_COOKIE['bb_lang'] === 'hi') ? 'en' : 'hi')) ?>"><?= (isset($_COOKIE['bb_lang']) && $_COOKIE['bb_lang'] === 'hi') ? 'EN' : 'HI' ?></a>
        <a class="ghost" href="<?= site_url('login') ?>"><?= shopLang('Operator', 'Operator') ?></a>
    </nav>
    <button type="button" class="shop-menu neon-menu" id="shopMenuBtn">MENU</button>
</header>

<section class="shop-hero">
    <div class="shop-hero-copy">
        <div class="hero-kicker"><?= shopLang('ONLINE KEY STORE', 'ONLINE KEY STORE') ?></div>
        <h1><?= esc($cfg['hero_title'] ?? 'BLACK BUNNY ARENA') ?></h1>
        <p><?= esc($cfg['hero_sub'] ?? '') ?></p>
        <div class="shop-cta">
            <a href="<?= site_url('login') ?>" class="submit shop-btn"><?= shopLang('LOGIN', 'LOGIN') ?></a>
            <?php
                $apkHref = trim((string) ($cfg['apk_url'] ?? ''));
                if ($apkHref !== '' && strpos($apkHref, 'http') !== 0) {
                    $apkHref = base_url($apkHref);
                }
            ?>
            <?php if ($apkHref) : ?>
                <a class="ghost-btn" href="<?= esc($apkHref) ?>" download>DOWNLOAD APK</a>
            <?php else : ?>
                <a class="ghost-btn" href="#loader">DOWNLOAD APK · 10 MB</a>
            <?php endif; ?>
            <a href="#plans" class="ghost-btn"><?= shopLang('BUY KEY', 'KEY LO') ?></a>
        </div>
    </div>
    <div class="shop-hero-media">
        <?php if (!empty($cfg['hero_media']) && ($cfg['hero_type'] ?? '') === 'video') : ?>
            <video autoplay muted loop playsinline src="<?= base_url($cfg['hero_media']) ?>"></video>
        <?php elseif (!empty($cfg['hero_media'])) : ?>
            <img src="<?= base_url($cfg['hero_media']) ?>" alt="Hero">
        <?php else : ?>
            <div class="radar-core shop-radar">
                <span class="radar-ring r1"></span>
                <span class="radar-ring r2"></span>
                <span class="radar-ring r3"></span>
                <span class="radar-sweep"></span>
                <span class="radar-cross"></span>
                <span class="radar-mark">BB</span>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
    $loaderName = $cfg['loader_name'] ?? 'BLACK BUNNY';
    $loaderSize = $cfg['loader_size'] ?? '10 MB';
    $loaderGame = $cfg['loader_game'] ?? 'BGMI / PUBG Mobile';
    $featList = [];
    $rawFeat = trim((string) ($cfg['features_text'] ?? ''));
    if ($rawFeat !== '') {
        $featList = preg_split('/\r\n|\r|\n|,/', $rawFeat);
        $featList = array_values(array_filter(array_map('trim', $featList)));
    }
    if (!$featList) {
        $featList = ['ESP Wallhack', 'Item ESP', 'AIM Bot', 'Silent Aim', 'Bullet Track', 'Memory Bypass', 'Floating Menu', 'In-Game Settings', '1 Device Bind', 'Key Based Access'];
    }
    $liveMap = [
        'ESP' => 'ESP',
        'Item' => 'Items',
        'AIM' => 'Aim-Bot',
        'SilentAim' => 'Silent Aim',
        'BulletTrack' => 'Bullet Track',
        'Memory' => 'Memory',
        'Floating' => 'Floating',
        'Setting' => 'Settings',
    ];
?>
<section id="loader" class="shop-section loader-deck">
    <div class="shop-kicker">LOADER PACKAGE</div>
    <h2><?= esc($loaderName) ?> · <?= esc($loaderGame) ?></h2>
    <div class="loader-grid">
        <article class="loader-card">
            <small>PACKAGE</small>
            <b><?= esc($loaderName) ?></b>
            <p><?= esc($loaderGame) ?> tactical overlay. Drop in, own the lobby.</p>
            <div class="loader-stats">
                <span>SIZE <em><?= esc($loaderSize) ?></em></span>
                <span>TYPE <em>APK LOADER</em></span>
                <span>ACCESS <em>KEY + LOGIN</em></span>
            </div>
            <div class="shop-cta">
                <a href="<?= site_url('login') ?>" class="submit shop-btn">LOGIN PORTAL</a>
                <?php if ($apkHref) : ?>
                    <a class="ghost-btn" href="<?= esc($apkHref) ?>" download>DOWNLOAD <?= esc($loaderSize) ?> APK</a>
                <?php else : ?>
                    <a class="ghost-btn" href="#plans">GET KEY FIRST</a>
                <?php endif; ?>
            </div>
        </article>
        <article class="loader-card">
            <small>BGMI FEATURES</small>
            <ul class="feat-list">
                <?php foreach ($featList as $f) : ?>
                    <li><?= esc($f) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if (!empty($feat)) : ?>
            <div class="live-feats">
                <?php foreach ($liveMap as $k => $label) : ?>
                    <span class="<?= (!empty($feat[$k]) && $feat[$k] === 'on') ? 'on' : 'off' ?>"><?= esc($label) ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </article>
    </div>
</section>

<section id="plans" class="shop-section">
    <div class="shop-kicker">KEY LANES</div>
    <h2>Pick a duration. Pay UPI. Owner drops the key.</h2>
    <div class="plan-grid">
        <?php foreach ($plans as $p) : ?>
        <article class="plan-card">
            <span class="plan-badge"><?= esc($p['badge'] ?: 'PLAN') ?></span>
            <h3><?= esc($p['title']) ?></h3>
            <p class="plan-hours"><?= hoursToDays((int) $p['hours']) ?></p>
            <p class="plan-price">Rs <?= (int) $p['price'] ?></p>
            <small><?= (int) $p['devices'] ?> device<?= ((int) $p['devices'] === 1) ? '' : 's' ?></small>
            <a href="<?= site_url('shop/buy/' . $p['id']) ?>">BUY LANE</a>
        </article>
        <?php endforeach; ?>
        <?php if (!$plans) : ?>
            <p class="muted">No public plans are live.</p>
        <?php endif; ?>
    </div>
</section>

<?php if ($media) : ?>
<section id="gallery" class="shop-section">
    <div class="shop-kicker">MEDIA SHOWCASE</div>
    <h2>Gameplay + drops</h2>
    <div class="media-rail">
        <?php foreach ($media as $i => $m) : ?>
            <figure class="media-tile t<?= ($i % 4) + 1 ?>" data-kind="<?= esc($m['kind']) ?>" data-src="<?= base_url($m['file']) ?>" data-cap="<?= esc($m['caption']) ?>">
                <?php if ($m['kind'] === 'video') : ?>
                    <video src="<?= base_url($m['file']) ?>" muted></video>
                <?php else : ?>
                    <img src="<?= base_url($m['file']) ?>" alt="<?= esc($m['caption']) ?>">
                <?php endif; ?>
                <?php if ($m['caption']) : ?><figcaption><?= esc($m['caption']) ?></figcaption><?php endif; ?>
            </figure>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<section id="about" class="shop-section about-grid">
    <article>
        <div class="shop-kicker">ABOUT</div>
        <p><?= nl2br(esc($cfg['about_text'] ?? '')) ?></p>
    </article>
    <article>
        <div class="shop-kicker">FEATURES</div>
        <p><?= nl2br(esc($cfg['features_text'] ?? '')) ?></p>
    </article>
    <article>
        <div class="shop-kicker">UPDATES</div>
        <p><?= nl2br(esc($cfg['updates_text'] ?? '')) ?></p>
    </article>
</section>

<section class="shop-section social-row">
    <?php if (!empty($cfg['youtube_url'])) : ?><a href="<?= esc($cfg['youtube_url']) ?>" target="_blank" rel="noopener">YouTube</a><?php endif; ?>
    <?php if (!empty($cfg['instagram_url'])) : ?><a href="<?= esc($cfg['instagram_url']) ?>" target="_blank" rel="noopener">Instagram</a><?php endif; ?>
    <?php if (!empty($cfg['telegram_url'])) : ?><a href="<?= esc($cfg['telegram_url']) ?>" target="_blank" rel="noopener">Telegram</a><?php endif; ?>
    <?php if (!empty($cfg['telegram_support'])) : ?><a href="<?= esc($cfg['telegram_support']) ?>" target="_blank" rel="noopener">Support</a><?php endif; ?>
</section>

<footer class="shop-foot">
    <a href="<?= site_url('shop/legal/privacy') ?>">Privacy</a>
    <a href="<?= site_url('shop/legal/terms') ?>">Terms</a>
    <a href="<?= site_url('shop/legal/refund') ?>">Refund</a>
    <a href="<?= site_url('shop/legal/contact') ?>">Contact</a>
    <span>&copy; <?= date('Y') ?> BLACK BUNNY</span>
</footer>
<div id="shopLightbox" class="shop-lightbox" hidden>
    <button type="button" class="shop-lightbox-x" id="lbClose">CLOSE</button>
    <div id="lbBody"></div>
</div>
<script src="<?= base_url('assets/js/blackbunny.js') ?>?v=<?= @filemtime(FCPATH . 'assets/js/blackbunny.js') ?: time() ?>"></script>
<script>
(function(){
  var btn=document.getElementById('shopMenuBtn');
  var nav=document.getElementById('shopNav');
  if(btn&&nav) btn.addEventListener('click', function(){ nav.classList.toggle('open'); });
  var box=document.getElementById('shopLightbox');
  var body=document.getElementById('lbBody');
  var close=document.getElementById('lbClose');
  document.querySelectorAll('.media-tile').forEach(function(tile){
    tile.addEventListener('click', function(){
      if(!box||!body) return;
      var kind=tile.getAttribute('data-kind');
      var src=tile.getAttribute('data-src');
      var safe=src||'';
      body.innerHTML='';
      if(kind==='video'){
        var v=document.createElement('video'); v.controls=true; v.autoplay=true; v.src=safe; body.appendChild(v);
      } else {
        var img=document.createElement('img'); img.src=safe; img.alt=''; body.appendChild(img);
      }
      box.hidden=false;
    });
  });
  if(close) close.addEventListener('click', function(){ box.hidden=true; body.innerHTML=''; });
  if(box) box.addEventListener('click', function(e){ if(e.target===box){ box.hidden=true; body.innerHTML=''; } });
})();
</script>
</body>
</html>
