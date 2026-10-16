<?php
$hbSize  = isset($hbSize) ? (int) $hbSize : 64;
$hbSpin  = isset($hbSpin) ? (bool) $hbSpin : true;
$hbClass = isset($hbClass) ? (string) $hbClass : '';
$hbId    = 'hb' . substr(md5(uniqid('', true)), 0, 8);
if (empty($GLOBALS['__hexBadgeCss'])) {
    $GLOBALS['__hexBadgeCss'] = true;
    ?>
<style>
.hex-badge{position:relative;width:var(--hb,64px);height:var(--hb,64px);display:inline-grid;place-items:center;flex-shrink:0}
.hex-badge svg{position:absolute;inset:0;width:100%;height:100%;overflow:visible}
.hex-badge .hb-outer{animation:hbSpin 14s linear infinite;transform-origin:50% 50%}
.hex-badge.no-spin .hb-outer{animation:none}
@keyframes hbSpin{to{transform:rotate(360deg)}}
.hex-badge .hb-glow{filter:drop-shadow(0 0 6px rgba(0,255,208,.55))}
.hex-badge .hb-bb{position:relative;z-index:2;font-family:Orbitron,sans-serif;font-weight:900;
  font-size:calc(var(--hb,64px) * .34);letter-spacing:.02em;color:#00ffd0;
  text-shadow:0 0 12px rgba(0,255,208,.9),0 0 34px rgba(0,255,208,.45);animation:hbPulse 3s ease-in-out infinite}
@keyframes hbPulse{50%{text-shadow:0 0 20px rgba(0,255,208,1),0 0 54px rgba(0,255,208,.6)}}
.hex-badge .hb-halo{position:absolute;inset:8%;border-radius:50%;pointer-events:none;
  background:radial-gradient(circle,rgba(0,255,208,.22),transparent 68%);animation:hbHalo 3.4s ease-in-out infinite}
@keyframes hbHalo{50%{opacity:.35;transform:scale(1.06)}}
@media(prefers-reduced-motion:reduce){.hex-badge .hb-outer,.hex-badge .hb-bb,.hex-badge .hb-halo{animation:none}}
</style>
<?php } ?>
<span class="hex-badge<?= $hbSpin ? '' : ' no-spin' ?><?= $hbClass ? ' ' . esc($hbClass) : '' ?>" style="--hb:<?= $hbSize ?>px" aria-hidden="true">
    <span class="hb-halo"></span>
    <svg class="hb-outer" viewBox="0 0 100 100">
        <defs>
            <linearGradient id="<?= $hbId ?>" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0" stop-color="#ff2d6a"/>
                <stop offset=".5" stop-color="#ff6bd6"/>
                <stop offset="1" stop-color="#00ffd0"/>
            </linearGradient>
        </defs>
        <polygon points="50,4 92,27 92,73 50,96 8,73 8,27" fill="none" stroke="url(#<?= $hbId ?>)" stroke-width="2.6" class="hb-glow"/>
        <polygon points="50,13 84,31.5 84,68.5 50,87 16,68.5 16,31.5" fill="none" stroke="rgba(0,255,208,.28)" stroke-width="1"/>
    </svg>
    <svg viewBox="0 0 100 100">
        <polygon points="50,20 76,35 76,65 50,80 24,65 24,35" fill="none" stroke="rgba(0,255,208,.85)" stroke-width="2" stroke-linejoin="round"/>
    </svg>
    <span class="hb-bb">BB</span>
</span>
