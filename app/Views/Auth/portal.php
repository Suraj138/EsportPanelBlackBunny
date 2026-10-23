<?php
$tab = isset($portalTab) ? $portalTab : 'login';
$isLogin = $tab !== 'register';
$danger = session()->getFlashdata('msgDanger');
$success = session()->getFlashdata('msgSuccess');
$warning = session()->getFlashdata('msgWarning');
$flashRaw = $danger ?: ($success ?: $warning);
$flash = $flashRaw ? trim(preg_replace('/\s+/', ' ', strip_tags((string) $flashRaw))) : '';
$flashKind = $success ? 'ok' : ($flash ? 'bad' : '');
$err = function ($field) use ($validation) {
    return $validation && $validation->hasError($field);
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= esc(defined('BASE_NAME') ? BASE_NAME : 'BLACK BUNNY') ?> - <?= $isLogin ? 'Login' : 'Register' ?></title>
<link rel="stylesheet" href="<?= base_url('assets/css/bb-portal.css') ?>">
</head>
<body class="bb-portal" data-bb-flash="<?= esc($flash) ?>" data-bb-flash-kind="<?= esc($flashKind) ?>">

<div id="bbWebgl"></div>
<div class="bb-scan" aria-hidden="true"></div>
<div class="bb-cur-dot" aria-hidden="true"></div>
<div class="bb-cur-ring" aria-hidden="true"></div>

<div id="bbBoot" role="status" aria-label="System booting">
  <?= view('Layout/HexBadge', ['hbSize' => 86]) ?>
  <div class="bb-boot-title bb-glitch" data-text="BLACK BUNNY">BLACK BUNNY</div>
  <div class="bb-boot-lines" id="bbBootLines">
    <div class="bb-bline">&gt; BOOTING BLACK BUNNY OS <b>v3.0</b> ...</div>
    <div class="bb-bline">&gt; NODE LINK ............ <b>[ OK ]</b></div>
    <div class="bb-bline">&gt; FIREWALL SHIELD ...... <b>[ ACTIVE ]</b></div>
    <div class="bb-bline">&gt; DATABASE SYNC ........ <b>[ SYNCED ]</b></div>
    <div class="bb-bline">&gt; ENCRYPTION AES-256 ... <b>[ LOCKED ]</b></div>
    <div class="bb-bline">&gt; PORTAL READY. <b>WELCOME OPERATOR.</b></div>
  </div>
  <div class="bb-boot-bar"><i id="bbBootBar"></i></div>
  <div class="bb-boot-skip" id="bbBootSkip">[ CLICK TO SKIP ]</div>
</div>

<header class="bb-hud">
  <div>BLACK BUNNY // SECURE PORTAL</div>
  <div class="bb-hud-right">
    <span class="chip">v3.0</span>
    <span class="clock" id="bbClock">--:--:--</span>
  </div>
</header>

<main class="bb-stage">
  <section class="bb-card" id="bbCard" aria-label="Authentication portal">
    <div class="bb-card-head">
      <div class="bb-logo-mini"><?= view('Layout/HexBadge', ['hbSize' => 54]) ?></div>
      <h1><span class="bb-glitch" data-text="BLACK BUNNY">BLACK BUNNY</span></h1>
      <div class="bb-sub"><span id="bbType"></span><span class="caret" aria-hidden="true"></span></div>
    </div>

    <div class="bb-tabs" role="tablist">
      <a class="bb-tab<?= $isLogin ? ' on' : '' ?>" id="tabLogin" href="<?= site_url('login') ?>" role="tab" aria-selected="<?= $isLogin ? 'true' : 'false' ?>"><span class="num">01</span>ACCESS</a>
      <a class="bb-tab<?= $isLogin ? '' : ' on' ?>" id="tabReg" href="<?= site_url('register') ?>" role="tab" aria-selected="<?= $isLogin ? 'false' : 'true' ?>"><span class="num">02</span>NEW ID</a>
    </div>

    <?= form_open(site_url('login'), ['class' => 'bb-form' . ($isLogin ? ' on' : ''), 'id' => 'formLogin', 'autocomplete' => 'on']) ?>
      <div class="bb-field<?= $isLogin && $err('username') ? ' err' : '' ?>" data-f="username">
        <label for="liUser">OPERATOR ID</label>
        <input type="text" id="liUser" name="username" placeholder="username" autocomplete="username" spellcheck="false" value="<?= esc((string) old('username')) ?>" minlength="4" maxlength="25" required>
        <?php if ($isLogin && $err('username')) : ?><small><?= esc($validation->getError('username')) ?></small><?php endif; ?>
      </div>
      <div class="bb-field<?= $isLogin && $err('password') ? ' err' : '' ?>" data-f="password">
        <label for="liPass">PASSPHRASE</label>
        <input type="password" id="liPass" name="password" placeholder="min 6 chars" autocomplete="current-password" minlength="6" maxlength="45" required>
        <button type="button" class="bb-eye" data-eye="liPass" aria-label="Toggle password visibility">SHOW</button>
        <?php if ($isLogin && $err('password')) : ?><small><?= esc($validation->getError('password')) ?></small><?php endif; ?>
      </div>
      <input type="hidden" name="ip" value="portal">
      <label class="bb-toggle-row">
        <span>24H SESSION KEEP-ALIVE</span>
        <input type="checkbox" name="stay_log" id="liStay" value="1">
        <span class="bb-sw"></span>
      </label>
      <button class="bb-btn" type="submit" id="btnLogin" data-phase="idle">
        <span class="shine" aria-hidden="true"></span>
        <span class="spin" aria-hidden="true"></span>
        <span class="lbl">ESTABLISH CONNECTION</span>
        <span class="fill" aria-hidden="true"></span>
        <span class="bb-burst" aria-hidden="true"></span>
      </button>
      <div class="bb-links">
        <a href="<?= site_url('recover') ?>">RECOVER ID</a>
        <a href="<?= site_url('register') ?>">CREATE NEW ID</a>
      </div>
    <?= form_close() ?>

    <?= form_open(site_url('register'), ['class' => 'bb-form' . ($isLogin ? '' : ' on'), 'id' => 'formReg', 'autocomplete' => 'on']) ?>
      <div class="bb-row">
        <div class="bb-field<?= !$isLogin && $err('fullname') ? ' err' : '' ?>" data-f="fullname">
          <label for="rgFull">FULL NAME</label>
          <input type="text" id="rgFull" name="fullname" placeholder="Name" autocomplete="name" spellcheck="false" value="<?= esc((string) old('fullname')) ?>" minlength="4" maxlength="25" required>
          <?php if (!$isLogin && $err('fullname')) : ?><small><?= esc($validation->getError('fullname')) ?></small><?php endif; ?>
        </div>
        <div class="bb-field<?= !$isLogin && $err('username') ? ' err' : '' ?>" data-f="username">
          <label for="rgUser">OPERATOR ID</label>
          <input type="text" id="rgUser" name="username" placeholder="username" autocomplete="username" spellcheck="false" value="<?= esc((string) old('username')) ?>" minlength="4" maxlength="25" required>
          <?php if (!$isLogin && $err('username')) : ?><small><?= esc($validation->getError('username')) ?></small><?php endif; ?>
        </div>
      </div>
      <div class="bb-field<?= !$isLogin && $err('email') ? ' err' : '' ?>" data-f="email">
        <label for="rgMail">EMAIL</label>
        <input type="email" id="rgMail" name="email" placeholder="you@mail.com" autocomplete="email" spellcheck="false" value="<?= esc((string) old('email')) ?>" minlength="13" maxlength="40" required>
        <?php if (!$isLogin && $err('email')) : ?><small><?= esc($validation->getError('email')) ?></small><?php endif; ?>
      </div>
      <div class="bb-field<?= !$isLogin && $err('password') ? ' err' : '' ?>" data-f="password">
        <label for="rgPass">PASSPHRASE</label>
        <input type="password" id="rgPass" name="password" placeholder="min 6 chars" autocomplete="new-password" minlength="6" maxlength="45" required>
        <button type="button" class="bb-eye" data-eye="rgPass" aria-label="Toggle password visibility">SHOW</button>
        <?php if (!$isLogin && $err('password')) : ?><small><?= esc($validation->getError('password')) ?></small><?php endif; ?>
      </div>
      <div class="bb-meter" id="bbMeter">
        <div class="bb-segs"><i></i><i></i><i></i><i></i></div>
        <div class="bb-meter-lbl">ENCRYPTION STRENGTH: <b id="bbStrLbl">-</b></div>
      </div>
      <div class="bb-field<?= !$isLogin && $err('password2') ? ' err' : '' ?>" data-f="password2">
        <label for="rgPass2">CONFIRM KEYS</label>
        <input type="password" id="rgPass2" name="password2" placeholder="repeat passphrase" autocomplete="new-password" minlength="6" maxlength="45" required>
        <?php if (!$isLogin && $err('password2')) : ?><small><?= esc($validation->getError('password2')) ?></small><?php endif; ?>
      </div>
      <div class="bb-match" id="bbMatch">KEYS SYNCED</div>
      <div class="bb-field<?= !$isLogin && $err('referral') ? ' err' : '' ?>" data-f="referral">
        <label for="rgRef">REFERRAL CODE</label>
        <input type="text" id="rgRef" name="referral" placeholder="required" spellcheck="false" value="<?= esc((string) old('referral')) ?>" minlength="6" maxlength="25" required>
        <?php if (!$isLogin && $err('referral')) : ?><small><?= esc($validation->getError('referral')) ?></small><?php endif; ?>
      </div>
      <button class="bb-btn" type="submit" id="btnReg" data-phase="idle">
        <span class="shine" aria-hidden="true"></span>
        <span class="spin" aria-hidden="true"></span>
        <span class="lbl">FORGE NEW IDENTITY</span>
        <span class="fill" aria-hidden="true"></span>
        <span class="bb-burst" aria-hidden="true"></span>
      </button>
      <div class="bb-links">
        <a href="<?= site_url('login') ?>">BACK TO ACCESS</a>
      </div>
    <?= form_close() ?>
  </section>
</main>

<div id="bbAlert" role="alert"></div>
<div id="bbToast" aria-live="polite"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="<?= base_url('assets/js/bb-portal.js') ?>"></script>
</body>
</html>
