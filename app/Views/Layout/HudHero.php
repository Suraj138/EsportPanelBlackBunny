<?php
$hudKick    = $hudKick    ?? 'MODULE';
$hudTitle   = $hudTitle   ?? 'BLACK BUNNY';
$hudAccent  = $hudAccent  ?? '';
$hudOrbit   = $hudOrbit   ?? 'CORE';
$hudCta     = $hudCta     ?? [];
$hudClocks  = $hudClocks  ?? [];
$hudIcon    = $hudIcon    ?? 'key';

$icons = [
  'key'    => '<path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>',
  'scan'   => '<circle cx="11" cy="11" r="8"></circle><path d="M21 21l-4.35-4.35"></path>',
  'gear'   => '<circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"></path>',
  'bot'    => '<rect x="3" y="11" width="18" height="10" rx="2"></rect><circle cx="12" cy="5" r="2"></circle><path d="M12 7v4M8 16h.01M16 16h.01"></path>',
  'wallet' => '<rect x="2" y="6" width="20" height="14" rx="2"></rect><path d="M16 12h.01"></path><path d="M2 10h20"></path>',
  'link'   => '<path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"></path>',
  'shop'   => '<path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 01-8 0"></path>',
  'server' => '<rect x="2" y="2" width="20" height="8" rx="2"></rect><rect x="2" y="14" width="20" height="8" rx="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line>',
  'pack'   => '<path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"></path>',
  'users'  => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"></path>',
  'audit'  => '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>',
  'lock'   => '<rect x="3" y="11" width="18" height="11" rx="2"></rect><path d="M7 11V7a5 5 0 0110 0v4"></path>',
];
$svgPath = $icons[$hudIcon] ?? $icons['key'];
?>
<canvas id="hud3d"></canvas>
<div class="hud-torch" id="hudTorch"></div>
<div class="hud-wrap">
    <div class="mb-3"><?= $this->include('Layout/msgStatus') ?></div>
    <section class="dk-hero dk-reveal" id="hudHero">
        <div class="dk-scangrid"></div>
        <div>
            <div class="dk-kick"><?= esc($hudKick) ?></div>
            <div class="dk-hero-title">
                <?= view('Layout/HexBadge', ['hbSize' => 56]) ?>
                <h1><?= esc($hudTitle) ?><?php if ($hudAccent !== '') : ?> <span><?= esc($hudAccent) ?></span><?php endif; ?></h1>
            </div>
            <p class="dk-type"><span id="hudTyped"></span><span class="caret">&nbsp;</span></p>
            <?php if ($hudClocks) : ?>
            <div class="dk-clocks">
                <?php foreach ($hudClocks as $c) : ?>
                <div>
                    <small><?= esc($c['label'] ?? '') ?></small>
                    <strong<?= !empty($c['id']) ? ' id="' . esc($c['id'], 'attr') . '"' : '' ?><?= !empty($c['class']) ? ' class="' . esc($c['class'], 'attr') . '"' : '' ?>><?= esc($c['value'] ?? '') ?></strong>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if ($hudCta) : ?>
            <div class="dk-hero-cta">
                <?php foreach ($hudCta as $btn) : ?>
                <a class="dk-btn<?= !empty($btn['fill']) ? ' fill' : '' ?>" href="<?= esc($btn['href'] ?? '#') ?>"<?= !empty($btn['blank']) ? ' target="_blank" rel="noopener"' : '' ?>><?= esc($btn['label'] ?? '') ?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="dk-orbit" id="hudOrbit" aria-hidden="true">
            <span class="ring r1"></span>
            <span class="ring r2"></span>
            <span class="ring r3"></span>
            <span class="sonar"></span>
            <span class="sweep"></span>
            <span class="core"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= $svgPath ?></svg></span>
            <small><?= esc($hudOrbit) ?></small>
        </div>
    </section>
