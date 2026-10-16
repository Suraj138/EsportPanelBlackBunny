<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<style>
:root{--dk-cyan:#00ffd0;--dk-lime:#b6ff3c;--dk-rose:#ff2d6a;--dk-purple:#b44bff;--dk-gold:#ffb84d;--dk-ink:#e8f6ff;--dk-dim:#8aa3c2;--dk-line:rgba(0,255,208,.18)}
body.dk-body{cursor:none}
@media(hover:none){body.dk-body{cursor:auto}}

/* cursor */
#dkDot,#dkRing{position:fixed;top:0;left:0;pointer-events:none;z-index:9999;border-radius:50%;transform:translate(-50%,-50%)}
#dkDot{width:8px;height:8px;background:var(--dk-cyan);box-shadow:0 0 12px var(--dk-cyan)}
#dkRing{width:34px;height:34px;border:1px solid rgba(0,255,208,.5);transition:width .22s,height .22s,border-color .22s}
body.dk-hover #dkRing{width:54px;height:54px;border-color:var(--dk-lime)}
@media(hover:none){#dkDot,#dkRing{display:none}}

#dk3d{position:fixed;inset:0;z-index:0;pointer-events:none}
.dk-wrap{position:relative;z-index:3;padding:18px 22px 56px!important}
.dk-reveal{opacity:0;transform:translateY(34px);transition:opacity .7s cubic-bezier(.2,.7,.3,1),transform .7s cubic-bezier(.2,.7,.3,1)}
.dk-reveal.in{opacity:1;transform:none}
.dk-reveal.d1{transition-delay:.08s}.dk-reveal.d2{transition-delay:.16s}.dk-reveal.d3{transition-delay:.24s}

/* ticker */
.dk-ticker{position:relative;overflow:hidden;margin:0 0 16px;border:1px solid var(--dk-line);background:rgba(0,255,208,.03)}
.dk-tk{display:flex;width:max-content;animation:dkTick 30s linear infinite}
.dk-tk span{font-family:'Share Tech Mono',monospace;letter-spacing:.2em;font-size:11px;color:var(--dk-dim);padding:11px 26px;white-space:nowrap}
.dk-tk span b{color:var(--dk-cyan);font-weight:400}
.dk-tk span i{color:var(--dk-lime);font-style:normal}
@keyframes dkTick{to{transform:translateX(-50%)}}

/* hero */
.dk-hero{position:relative;overflow:hidden;min-height:250px;margin:0 0 16px;padding:30px 34px;display:grid;grid-template-columns:1.42fr .58fr;align-items:center;gap:22px;
  border:1px solid rgba(0,255,208,.32);
  background:radial-gradient(460px 200px at 10% 0%,rgba(0,255,208,.16),transparent 60%),radial-gradient(420px 220px at 96% 100%,rgba(180,75,255,.14),transparent 62%),linear-gradient(135deg,rgba(4,12,24,.96),rgba(6,14,30,.92));
  transform-style:preserve-3d;transition:transform .18s ease-out}
.dk-hero:after{content:'';position:absolute;left:-30%;top:0;width:28%;height:100%;background:linear-gradient(90deg,transparent,rgba(0,255,208,.12),transparent);animation:dkSweep 5.4s ease-in-out infinite;pointer-events:none}
@keyframes dkSweep{0%{left:-30%}55%,100%{left:130%}}
.dk-hero .dk-scangrid{position:absolute;inset:0;pointer-events:none;background:repeating-linear-gradient(180deg,transparent 0 12px,rgba(0,255,208,.035) 13px);animation:gridDrift 9s linear infinite}
.dk-kick{font-family:Orbitron,sans-serif;letter-spacing:.28em;font-size:11px;color:var(--dk-lime);margin-bottom:10px}
.dk-hero-title{display:flex;align-items:center;gap:16px;margin-bottom:8px}
.dk-hero h1{margin:0 0 10px;font-family:Orbitron,sans-serif;font-size:clamp(1.9rem,4.2vw,3.3rem);letter-spacing:.09em;line-height:1.04;color:var(--dk-ink)}
.dk-hero-title h1{margin:0}
.dk-hero h1 span{background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));-webkit-background-clip:text;background-clip:text;color:transparent;background-size:200%;animation:dkGrad 4s linear infinite}
@keyframes dkGrad{to{background-position:200%}}
.dk-type{max-width:560px;color:var(--dk-dim);min-height:26px;font-size:16px;margin:0 0 6px}
.dk-type .caret{display:inline-block;width:9px;background:var(--dk-cyan);margin-left:2px;animation:dkBlink .8s infinite}
@keyframes dkBlink{50%{opacity:0}}
.dk-clocks{display:flex;gap:30px;flex-wrap:wrap;margin-top:16px}
.dk-clocks small{display:block;letter-spacing:.2em;color:var(--dk-lime);font-size:10px;font-family:Orbitron,sans-serif}
.dk-clocks strong{display:block;font-family:Orbitron,sans-serif;font-size:18px;color:var(--dk-cyan);text-shadow:0 0 14px rgba(0,255,208,.4)}
.dk-hero-cta{display:flex;gap:12px;flex-wrap:wrap;margin-top:20px}
.dk-btn{font-family:Orbitron,sans-serif;font-size:11px;letter-spacing:.1em;padding:12px 20px;text-decoration:none;position:relative;overflow:hidden;border:1px solid rgba(0,255,208,.25);color:var(--dk-ink);transition:.25s;cursor:none}
@media(hover:none){.dk-btn{cursor:pointer}}
.dk-btn.fill{background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));color:#03110c;font-weight:700;border-color:transparent}
.dk-btn:hover{transform:translateY(-2px);box-shadow:0 10px 30px rgba(0,255,208,.28)}
.dk-btn .ripple{position:absolute;border-radius:50%;background:rgba(255,255,255,.45);transform:scale(0);animation:dkRip .6s ease-out;pointer-events:none}
@keyframes dkRip{to{transform:scale(4);opacity:0}}

/* orbit */
.dk-orbit{position:relative;width:210px;height:210px;justify-self:end;display:grid;place-items:center}
.dk-orbit .ring{position:absolute;border-radius:50%;border:1px solid rgba(0,255,208,.28);animation:dkSpin 9s linear infinite}
.dk-orbit .r1{inset:6%}
.dk-orbit .r2{inset:20%;animation-duration:6s;border-color:rgba(255,45,106,.35);animation-direction:reverse}
.dk-orbit .r3{inset:34%;animation-duration:4s}
.dk-orbit .sweep{position:absolute;inset:6%;border-radius:50%;background:conic-gradient(from 0deg,transparent 0 78%,rgba(0,255,208,.35) 88%,transparent 100%);animation:dkSpin 2.4s linear infinite;pointer-events:none}
.dk-orbit .core{width:74px;height:74px;display:grid;place-items:center;font-family:Orbitron,sans-serif;font-size:23px;color:#031018;
  background:linear-gradient(135deg,var(--dk-cyan),var(--dk-lime));clip-path:polygon(50% 0,95% 25%,95% 75%,50% 100%,5% 75%,5% 25%);box-shadow:0 0 40px rgba(0,255,208,.4);animation:dkPulse 3s ease-in-out infinite}
@keyframes dkSpin{to{transform:rotate(360deg)}}
@keyframes dkPulse{50%{box-shadow:0 0 70px rgba(0,255,208,.7)}}
.dk-orbit small{position:absolute;bottom:16px;letter-spacing:.16em;font-size:9px;color:var(--dk-dim);font-family:Orbitron,sans-serif}

/* stat strip */
.dk-strip{display:grid;grid-template-columns:repeat(6,minmax(0,1fr));gap:10px;margin:0 0 16px}
.dk-stat{position:relative;overflow:hidden;display:flex;gap:11px;align-items:center;padding:15px 13px;border:1px solid var(--dk-line);background:rgba(4,12,24,.92);transition:.3s}
.dk-stat:hover{border-color:rgba(0,255,208,.45);transform:translateY(-4px);box-shadow:0 14px 40px rgba(0,255,208,.12)}
.dk-stat i{display:block;width:8px;height:30px;background:var(--dk-cyan);box-shadow:0 0 10px var(--dk-cyan)}
.dk-stat i.lime{background:var(--dk-lime);box-shadow:0 0 10px var(--dk-lime)}
.dk-stat i.rose{background:var(--dk-rose);box-shadow:0 0 10px var(--dk-rose)}
.dk-stat i.gold{background:var(--dk-gold);box-shadow:0 0 10px var(--dk-gold)}
.dk-stat i.purple{background:var(--dk-purple);box-shadow:0 0 10px var(--dk-purple)}
.dk-stat small{display:block;font-size:9px;letter-spacing:.16em;color:var(--dk-dim);font-family:Orbitron,sans-serif;white-space:nowrap}
.dk-stat b{display:block;font-family:Orbitron,sans-serif;font-size:23px;color:var(--dk-cyan);text-shadow:0 0 14px rgba(0,255,208,.35)}
.dk-stat b.lime{color:var(--dk-lime);text-shadow:0 0 14px rgba(182,255,60,.35)}
.dk-stat b.rose{color:var(--dk-rose);text-shadow:0 0 14px rgba(255,45,106,.35)}
.dk-stat b.gold{color:var(--dk-gold);text-shadow:0 0 14px rgba(255,184,77,.35)}
.dk-stat b.purple{color:var(--dk-purple);text-shadow:0 0 14px rgba(180,75,255,.4)}

/* grid + panels */
.dk-grid{display:grid;grid-template-columns:1.35fr .65fr;gap:14px}
.dk-panel{position:relative;overflow:hidden;padding:18px;border:1px solid rgba(0,255,208,.22);background:linear-gradient(160deg,rgba(6,16,32,.96),rgba(4,10,20,.94));transition:.3s}
.dk-panel:before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--dk-cyan),transparent);background-size:40% 100%;background-repeat:no-repeat;opacity:.75;animation:dkBeam 5s linear infinite}
@keyframes dkBeam{0%{background-position:-40% 0}100%{background-position:140% 0}}
.dk-panel:after{content:'';position:absolute;top:0;left:-45%;width:45%;height:100%;pointer-events:none;background:linear-gradient(90deg,transparent,rgba(0,255,208,.055),transparent);animation:dkSweep 6.5s linear infinite}
@keyframes dkSweep{to{left:120%}}
.dk-panel:hover{box-shadow:0 20px 60px rgba(0,255,208,.1)}
.dk-panel h2{margin:0;font-family:Orbitron,sans-serif;letter-spacing:.14em;font-size:12px;color:var(--dk-cyan)}
.dk-panel header{display:flex;justify-content:space-between;align-items:center;margin:0 0 14px}
.dk-panel header em{color:var(--dk-dim);font-style:normal;font-size:10px;font-family:Orbitron,sans-serif;letter-spacing:.1em}
.dk-h{display:flex;align-items:center;gap:10px}

/* flow */
.dk-flow-row{display:grid;grid-template-columns:74px 1fr 46px;gap:11px;align-items:center;margin:0 0 11px;font-size:11px;letter-spacing:.12em;font-family:Orbitron,sans-serif;color:var(--dk-dim)}
.dk-flow-track{height:9px;background:rgba(0,255,208,.08);overflow:hidden}
.dk-flow-track b{display:block;height:9px;width:0;background:var(--dk-cyan);box-shadow:0 0 12px rgba(0,255,208,.5);transition:width 1s cubic-bezier(.2,.8,.3,1)}
.dk-flow-track b.lime{background:var(--dk-lime);box-shadow:0 0 12px rgba(182,255,60,.5)}
.dk-flow-track b.rose{background:var(--dk-rose);box-shadow:0 0 12px rgba(255,45,106,.5)}
.dk-flow-track b.gold{background:var(--dk-gold);box-shadow:0 0 12px rgba(255,184,77,.5)}
.dk-flow-row strong{color:var(--dk-ink);font-family:Orbitron,sans-serif;text-align:right}

/* radial */
.dk-radial{display:flex;gap:22px;align-items:center;margin-top:16px;padding-top:16px;border-top:1px dashed rgba(0,255,208,.14)}
.dk-dial{--fill:0;position:relative;width:118px;height:118px;border-radius:50%;flex-shrink:0;
  background:conic-gradient(var(--dk-cyan) calc(var(--fill)*1%),rgba(0,255,208,.08) 0);transition:--fill 1s}
.dk-dial:before{content:'';position:absolute;inset:11px;border-radius:50%;background:radial-gradient(circle,rgba(3,12,20,.98),rgba(4,12,24,.98))}
.dk-dial span{position:absolute;inset:0;display:grid;place-items:center;font-family:Orbitron,sans-serif;font-size:22px;color:var(--dk-lime);text-shadow:0 0 14px rgba(182,255,60,.4)}
.dk-dial small{position:absolute;bottom:26px;left:0;right:0;text-align:center;font-family:Orbitron,sans-serif;font-size:8px;letter-spacing:.2em;color:var(--dk-dim)}
.dk-radial-copy{font-size:13px;color:var(--dk-dim)}
.dk-radial-copy b{display:block;font-family:Orbitron,sans-serif;color:var(--dk-ink);font-size:14px;margin-bottom:4px;letter-spacing:.1em}

/* operator */
.dk-op{list-style:none;margin:0;padding:0;display:grid;gap:8px}
.dk-op li{display:flex;justify-content:space-between;gap:10px;padding:9px 0;border-bottom:1px solid rgba(0,255,208,.1);font-size:13px}
.dk-op li span{color:var(--dk-dim)}
.dk-op li b{color:var(--dk-ink);font-family:Orbitron,sans-serif;font-size:12px;letter-spacing:.06em}
.dk-actions{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:14px}
.dk-actions a{text-decoration:none;text-align:center;padding:10px;font-family:Orbitron,sans-serif;font-size:10.5px;letter-spacing:.08em;
  background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));color:#03110c;font-weight:700;transition:.25s}
.dk-actions a:hover{transform:translateY(-2px);box-shadow:0 10px 26px rgba(0,255,208,.3)}

/* feed */
.dk-feed{display:grid;gap:8px;max-height:300px;overflow-y:auto;padding-right:2px}
.dk-feed::-webkit-scrollbar{width:6px}
.dk-feed::-webkit-scrollbar-thumb{background:rgba(0,255,208,.3)}
.dk-drop{display:flex;gap:11px;align-items:center;padding:9px 0;border-bottom:1px solid rgba(0,255,208,.1)}
.dk-drop i{display:block;width:8px;height:8px;flex-shrink:0;background:var(--dk-lime);box-shadow:0 0 8px var(--dk-lime)}
.dk-drop strong{display:block;font-size:13px;color:var(--dk-ink);letter-spacing:.04em}
.dk-drop small{display:block;color:var(--dk-dim);font-size:11px}
.dk-empty{color:var(--dk-dim);font-size:13px}

/* lanes */
.dk-lanes{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.dk-lanes a{display:flex;gap:9px;align-items:center;text-decoration:none;padding:11px;border:1px solid rgba(0,255,208,.2);color:var(--dk-ink);
  font-family:Orbitron,sans-serif;font-size:10.5px;letter-spacing:.06em;transition:.25s}
.dk-lanes a:hover{border-color:var(--dk-cyan);background:rgba(0,255,208,.07);transform:translateX(4px)}
.dk-lanes a b{color:var(--dk-cyan);font-family:Orbitron,sans-serif}
.dk-span2{grid-column:1/-1}

/* console */
.dk-console{font-family:'Share Tech Mono',monospace;background:rgba(2,10,8,.7);border:1px solid rgba(0,255,208,.28);padding:14px;height:190px;overflow:hidden;display:flex;flex-direction:column;gap:5px;font-size:12px}
.dk-console .ln{color:var(--dk-dim);opacity:0;animation:dkLn .5s forwards}
.dk-console .ln b{color:var(--dk-cyan);font-weight:400}
.dk-console .ln i{color:var(--dk-lime);font-style:normal}
@keyframes dkLn{to{opacity:1}}
.dk-console-head{display:flex;gap:7px;align-items:center;margin-bottom:10px;font-family:'Share Tech Mono',monospace;font-size:11px;color:var(--dk-dim);letter-spacing:.14em}
.dk-console-head .d{width:9px;height:9px;border-radius:50%}
.dk-console-head .dr{background:#ff5f56}.dk-console-head .dy{background:#ffbd2e}.dk-console-head .dg{background:#27c93f}
.dk-console-head .live{margin-left:auto;color:var(--dk-lime);animation:dkBlink 1.4s infinite}

/* torch */
.dk-torch{position:fixed;inset:0;z-index:2;pointer-events:none;opacity:.5;transition:opacity .3s;
  background:radial-gradient(340px circle at var(--tx,50%) var(--ty,30%),rgba(0,255,208,.08),transparent 70%)}

@media (max-width:1100px){.dk-strip{grid-template-columns:repeat(3,minmax(0,1fr))}}
@media (max-width:980px){
  .dk-hero{grid-template-columns:1fr;padding:24px}
  .dk-grid{grid-template-columns:1fr}
  .dk-orbit{justify-self:center;margin-top:10px}
  .dk-strip{grid-template-columns:repeat(2,minmax(0,1fr))}
}
@media (prefers-reduced-motion:reduce){*{animation-duration:.001ms!important;animation-iteration-count:1!important;transition-duration:.001ms!important}}
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<canvas id="dk3d"></canvas>
<div class="dk-torch" id="dkTorch"></div>
<div id="dkDot"></div><div id="dkRing"></div>

<div class="dk-wrap">
    <div class="mb-3"><?= $this->include('Layout/msgStatus') ?></div>

    <!-- ticker -->
    <div class="dk-ticker dk-reveal">
        <div class="dk-tk" id="dkTk">
            <span><b>LICENSE CORE</b> <i>ONLINE</i></span>
            <span><b>KEYS MINTED</b> <i><?= (int) $stats['total'] ?></i></span>
            <span><b>BOUND</b> <i><?= (int) $stats['used'] ?></i></span>
            <span><b>IDLE STOCK</b> <i><?= (int) $stats['unused'] ?></i></span>
            <span><b>LIVE PINGS</b> <i><?= (int) $stats['online'] ?></i></span>
            <span><b>STORE QUEUE</b> <i><?= (int) $stats['pending'] ?></i></span>
            <span><b>HWID LOCK</b> <i>ARMED</i></span>
            <span><b>ENCRYPTION</b> <i>ACTIVE</i></span>
        </div>
    </div>

    <!-- hero -->
    <section class="dk-hero dk-reveal d1" id="dkHero">
        <div class="dk-scangrid"></div>
        <div>
            <div class="dk-hero-title">
                <?= view('Layout/HexBadge', ['hbSize' => 58]) ?>
                <div>
                    <div class="dk-kick">OPERATOR DECK &middot; <?= esc($roleLabel) ?></div>
                    <h1>NODE <span><?= esc(strtoupper(getName($user))) ?></span></h1>
                </div>
            </div>
            <p class="dk-type"><span id="dkTyped"></span><span class="caret">&nbsp;</span></p>
            <?php if (keyExpirySoon($expiration_date, 7)) : ?>
                <div class="hud-alert warn" data-stamp="HOLD">Account window closing &middot; <?= esc($expiration_date) ?></div>
            <?php endif; ?>
            <div class="dk-clocks">
                <div><small>SESSION EXPIRES</small><strong id="exp">--</strong></div>
                <div><small>LOBBY CLOCK</small><strong id="lobbyClock">--</strong></div>
                <div><small>SHIFT OPENED</small><strong><?= $time::parse(session()->time_since)->humanize() ?></strong></div>
            </div>
            <div class="dk-hero-cta">
                <a class="dk-btn fill" href="<?= site_url('keys/generate') ?>">GENERATE KEY</a>
                <a class="dk-btn" href="<?= site_url('keys') ?>">LICENSE VAULT</a>
                <?php if ((int) $user->level <= 2) : ?>
                <a class="dk-btn" href="<?= site_url('public-control') ?>">PUBLIC CONTROL</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="dk-orbit" aria-hidden="true">
            <span class="ring r1"></span>
            <span class="ring r2"></span>
            <span class="ring r3"></span>
            <span class="sweep"></span>
            <span class="core" id="orbitOnline"><?= (int) $stats['online'] ?></span>
            <small>LIVE PINGS</small>
        </div>
    </section>

    <!-- stat strip -->
    <div class="dk-strip dk-reveal d2">
        <article class="dk-stat"><i></i><div><small>TOTAL KEYS</small><b id="stTotal">0</b></div></article>
        <article class="dk-stat"><i class="lime"></i><div><small>USED / BOUND</small><b class="lime" id="stUsed">0</b></div></article>
        <article class="dk-stat"><i class="rose"></i><div><small>UNUSED STOCK</small><b class="rose" id="stUnused">0</b></div></article>
        <article class="dk-stat"><i class="gold"></i><div><small>FILL RATE</small><b class="gold" id="stFill">0%</b></div></article>
        <article class="dk-stat"><i class="purple"></i><div><small>OPERATORS</small><b class="purple" id="stUsers">0</b></div></article>
        <article class="dk-stat"><i class="rose"></i><div><small>STORE QUEUE</small><b class="rose" id="stPending">0</b></div></article>
    </div>

    <div class="dk-grid">
        <!-- license flow -->
        <section class="dk-panel dk-reveal d1" data-tilt>
            <header><span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>LICENSE FLOW</h2></span><em id="flowMeta"><?= (int) $stats['used'] ?> bound &middot; <?= (int) $stats['unused'] ?> idle</em></header>
            <?php
            $maxBar = max(1, (int) $stats['total']);
            $rows = [
                ['TOTAL', (int) $stats['total'], 'total', ''],
                ['USED', (int) $stats['used'], 'used', 'lime'],
                ['UNUSED', (int) $stats['unused'], 'unused', 'rose'],
                ['ONLINE', (int) $stats['online'], 'online', 'gold'],
            ];
            foreach ($rows as $r) :
                $w = min(100, round(($r[1] / $maxBar) * 100));
            ?>
            <div class="dk-flow-row">
                <span><?= $r[0] ?></span>
                <div class="dk-flow-track"><b class="<?= $r[3] ?>" data-flow="<?= $r[2] ?>" style="width:<?= $w ?>%"></b></div>
                <strong data-flowval="<?= $r[2] ?>"><?= $r[1] ?></strong>
            </div>
            <?php endforeach; ?>
            <div class="dk-radial">
                <div class="dk-dial" id="dkDial" style="--fill:<?= (int) $stats['fill'] ?>"><span id="dialNum"><?= (int) $stats['fill'] ?>%</span><small>FILL</small></div>
                <div class="dk-radial-copy">
                    <b>LICENSE UTILISATION</b>
                    <?= (int) $stats['used'] ?> of <?= (int) $stats['total'] ?> keys bound to devices. <?= (int) $stats['unused'] ?> sitting in the vault, ready to drop.
                </div>
            </div>
        </section>

        <!-- operator -->
        <section class="dk-panel dk-reveal d2" data-tilt>
            <header><span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>OPERATOR</h2></span><em><?= esc($user->username) ?></em></header>
            <ul class="dk-op">
                <li><span>Role</span><b><?= esc($roleLabel) ?></b></li>
                <li><span>Balance</span><b>Rs <?= (int) $user->saldo ?></b></li>
                <li><span>Auto logout</span><b><?= $time::now()->difference($time::parse(session()->time_login))->humanize() ?></b></li>
                <li><span>Public store</span><b style="color:<?= !empty($stats['page_on']) ? 'var(--dk-lime)' : 'var(--dk-rose)' ?>"><?= !empty($stats['page_on']) ? 'LIVE' : 'OFF' ?></b></li>
                <li><span>Device lock</span><b>HWID ON</b></li>
            </ul>
            <div class="dk-actions">
                <a href="<?= site_url('keys/generate') ?>">GENERATE</a>
                <a href="<?= site_url('keys') ?>">KEYS</a>
                <a href="<?= site_url('telegram') ?>">TELEGRAM</a>
                <a href="<?= site_url('wallet') ?>">WALLET</a>
            </div>
        </section>

        <!-- console -->
        <section class="dk-panel dk-reveal d3" data-tilt>
            <header><span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>LIVE CONSOLE</h2></span><em>realtime feed</em></header>
            <div class="dk-console-head"><span class="d dr"></span><span class="d dy"></span><span class="d dg"></span> BB-DECK &mdash; SESSION LOG<span class="live">&bull; LIVE</span></div>
            <div class="dk-console" id="dkConsole"></div>
        </section>

        <!-- recent drops -->
        <section class="dk-panel dk-reveal" data-tilt>
            <header><span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>RECENT DROPS</h2></span><em>history feed</em></header>
            <div class="dk-feed">
                <?php if ($history) : ?>
                    <?php foreach ($history as $h) : $in = explode('|', $h->info); ?>
                    <div class="dk-drop">
                        <i></i>
                        <div>
                            <strong><?= esc($in[0] ?? 'KEY') ?> &middot; <?= esc($in[1] ?? '-') ?>**</strong>
                            <small><?= hoursToDays($in[2] ?? 0) ?> &middot; <?= esc($in[3] ?? '-') ?> devices &middot; <?= $time::parse($h->created_at)->humanize() ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="dk-empty">No drops yet. Mint a key to light this feed.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- quick lanes -->
        <section class="dk-panel dk-reveal d1 dk-span2" data-tilt>
            <header><span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>QUICK LANES</h2></span><em>jump</em></header>
            <div class="dk-lanes">
                <?php $n = 1; ?>
                <a href="<?= site_url('keys/generate') ?>"><b><?= sprintf('%02d', $n++) ?></b> Generate Key</a>
                <a href="<?= site_url('keys') ?>"><b><?= sprintf('%02d', $n++) ?></b> View Keys</a>
                <a href="<?= site_url('search') ?>"><b><?= sprintf('%02d', $n++) ?></b> SCAN</a>
                <a href="<?= site_url('settings') ?>"><b><?= sprintf('%02d', $n++) ?></b> Settings</a>
                <a href="<?= site_url('wallet') ?>"><b><?= sprintf('%02d', $n++) ?></b> Wallet</a>
                <a href="<?= site_url('telegram') ?>"><b><?= sprintf('%02d', $n++) ?></b> Telegram Bot</a>
                <?php if ((int) $user->level <= 2) : ?>
                <a href="<?= site_url('Server') ?>"><b><?= sprintf('%02d', $n++) ?></b> Online System</a>
                <a href="<?= site_url('shop') ?>" target="_blank" rel="noopener"><b><?= sprintf('%02d', $n++) ?></b> Public Shop</a>
                <a href="<?= site_url('public-control') ?>"><b><?= sprintf('%02d', $n++) ?></b> Public Control</a>
                <a href="<?= site_url('store') ?>"><b><?= sprintf('%02d', $n++) ?></b> Loader Packages</a>
                <?php endif; ?>
                <?php if ((int) $user->level == 1) : ?>
                <a href="<?= site_url('admin/manage-users') ?>"><b><?= sprintf('%02d', $n++) ?></b> Manage Users</a>
                <a href="<?= site_url('admin/create-referral') ?>"><b><?= sprintf('%02d', $n++) ?></b> Create Referral</a>
                <a href="<?= site_url('audit') ?>"><b><?= sprintf('%02d', $n++) ?></b> Audit Log</a>
                <?php endif; ?>
                <a href="<?= site_url('logout') ?>"><b><?= sprintf('%02d', $n++) ?></b> Logout</a>
            </div>
        </section>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
(function(){
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  document.body.classList.add('dk-body');

  /* ---------- custom cursor + torch ---------- */
  var dot=document.getElementById('dkDot'),ring=document.getElementById('dkRing'),torch=document.getElementById('dkTorch');
  var cx=innerWidth/2,cy=innerHeight/2,rx=cx,ry=cy;
  addEventListener('mousemove',function(e){cx=e.clientX;cy=e.clientY;dot.style.left=cx+'px';dot.style.top=cy+'px';
    torch.style.setProperty('--tx',cx+'px');torch.style.setProperty('--ty',cy+'px');});
  (function cur(){rx+=(cx-rx)*.16;ry+=(cy-ry)*.16;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(cur);})();
  document.querySelectorAll('a,button,input').forEach(function(el){
    el.addEventListener('mouseenter',function(){document.body.classList.add('dk-hover')});
    el.addEventListener('mouseleave',function(){document.body.classList.remove('dk-hover')});
  });

  /* ---------- three.js 3d backdrop ---------- */
  (function(){
    var canvas=document.getElementById('dk3d');if(!canvas||!window.THREE)return;
    var renderer=new THREE.WebGLRenderer({canvas:canvas,alpha:true,antialias:true});
    renderer.setPixelRatio(Math.min(devicePixelRatio,2));renderer.setSize(innerWidth,innerHeight);
    var scene=new THREE.Scene();scene.fog=new THREE.FogExp2(0x04090c,0.05);
    var camera=new THREE.PerspectiveCamera(60,innerWidth/innerHeight,.1,100);camera.position.set(0,0,15);
    var N=1200,pos=new Float32Array(N*3),col=new Float32Array(N*3);
    var pal=[[0,1,.82],[.71,1,.24],[.7,.3,1],[1,.72,.3]];
    for(var i=0;i<N;i++){
      pos[i*3]=(Math.random()-.5)*46;pos[i*3+1]=(Math.random()-.5)*28;pos[i*3+2]=(Math.random()-.5)*36-4;
      var c=pal[(Math.random()*pal.length)|0];col[i*3]=c[0];col[i*3+1]=c[1];col[i*3+2]=c[2];
    }
    var pg=new THREE.BufferGeometry();
    pg.setAttribute('position',new THREE.BufferAttribute(pos,3));
    pg.setAttribute('color',new THREE.BufferAttribute(col,3));
    var pts=new THREE.Points(pg,new THREE.PointsMaterial({size:.07,vertexColors:true,transparent:true,opacity:.85,blending:THREE.AdditiveBlending,depthWrite:false}));
    scene.add(pts);
    var m1=new THREE.MeshBasicMaterial({color:0x00ffd0,wireframe:true,transparent:true,opacity:.22});
    var m2=new THREE.MeshBasicMaterial({color:0xb44bff,wireframe:true,transparent:true,opacity:.16});
    var objs=[
      {m:new THREE.Mesh(new THREE.IcosahedronGeometry(2.6,1),m1),p:[-7,2,-4]},
      {m:new THREE.Mesh(new THREE.TorusGeometry(1.8,.42,10,28),m2),p:[6.5,-1,-6]},
      {m:new THREE.Mesh(new THREE.OctahedronGeometry(1.6,0),m1),p:[4,3.5,-8]},
      {m:new THREE.Mesh(new THREE.TorusKnotGeometry(1.35,.35,60,8),m2),p:[-4.5,-3.6,-7]}
    ];
    objs.forEach(function(o){o.m.position.set(o.p[0],o.p[1],o.p[2]);scene.add(o.m)});
    var grid=new THREE.GridHelper(72,46,0x00ffd0,0x0a2a22);grid.material.transparent=true;grid.material.opacity=.32;grid.position.y=-8;scene.add(grid);
    var mx=0,my=0;
    addEventListener('mousemove',function(e){mx=(e.clientX/innerWidth-.5)*2;my=(e.clientY/innerHeight-.5)*2});
    addEventListener('resize',function(){camera.aspect=innerWidth/innerHeight;camera.updateProjectionMatrix();renderer.setSize(innerWidth,innerHeight)});
    if(reduce){renderer.render(scene,camera);return;}
    var clock=new THREE.Clock();
    (function loop(){
      requestAnimationFrame(loop);
      var t=clock.getElapsedTime();
      pts.rotation.y=t*.02;
      objs.forEach(function(o,i){o.m.rotation.x=t*(.2+i*.07);o.m.rotation.y=t*(.25+i*.05);o.m.position.y=o.p[1]+Math.sin(t+i*2)*.5});
      grid.position.z=(t*.6)%1.57;
      camera.position.x+=(mx*1.6-camera.position.x)*.04;
      camera.position.y+=(-my*1.2-camera.position.y)*.04;
      camera.lookAt(0,0,0);renderer.render(scene,camera);
    })();
  })();

  /* ---------- typewriter ---------- */
  var phrases=['Live license radar. Keys, pings and store orders in one frame.','HWID-locked keys. Secured to your device.','Mint fast. Drop faster. Own the lobby.'];
  var typed=document.getElementById('dkTyped'),pi=0,ci=0,del=false;
  (function type(){
    if(!typed)return;
    var cur=phrases[pi];
    typed.textContent=del?cur.slice(0,--ci):cur.slice(0,++ci);
    if(!del&&ci===cur.length){del=true;return setTimeout(type,2400)}
    if(del&&ci===0){del=false;pi=(pi+1)%phrases.length}
    setTimeout(type,del?24:48);
  })();

  /* ---------- reveal ---------- */
  var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target)}})},{threshold:.1});
  document.querySelectorAll('.dk-reveal').forEach(function(el){io.observe(el)});

  /* ---------- tilt ---------- */
  document.querySelectorAll('[data-tilt]').forEach(function(c){
    c.addEventListener('mousemove',function(e){
      if(reduce||innerWidth<980)return;
      var r=c.getBoundingClientRect(),x=(e.clientX-r.left)/r.width-.5,y=(e.clientY-r.top)/r.height-.5;
      c.style.transform='perspective(1100px) rotateY('+(x*6)+'deg) rotateX('+(-y*6)+'deg) translateY(-3px)';
    });
    c.addEventListener('mouseleave',function(){c.style.transform=''});
  });
  var hero=document.getElementById('dkHero');
  if(hero)addEventListener('mousemove',function(e){
    if(reduce||innerWidth<980)return;
    var x=e.clientX/innerWidth-.5,y=e.clientY/innerHeight-.5;
    hero.style.transform='perspective(1200px) rotateY('+(x*4)+'deg) rotateX('+(-y*3)+'deg)';
  });

  /* ---------- fire burst + ripple ---------- */
  function burst(btn){
    if(reduce||!btn)return;
    btn.classList.add('firing');
    var r=btn.getBoundingClientRect();
    for(var i=0;i<12;i++){
      var f=document.createElement('span');f.className='flame';
      var s=4+Math.random()*7;f.style.width=f.style.height=s+'px';
      f.style.cssText+='position:fixed;border-radius:50%;pointer-events:none;z-index:9998;background:radial-gradient(circle,#fff3b0,#ff9d00 50%,#ff3d00 80%,transparent);box-shadow:0 0 8px rgba(255,120,0,.9);width:'+s+'px;height:'+s+'px;left:'+(r.left+r.width*Math.random())+'px;top:'+(r.top+r.height*.5)+'px';
      document.body.appendChild(f);
      f.animate([{transform:'translateY(0) scale(1)',opacity:1},{transform:'translateY('+(-26-Math.random()*46)+'px) scale(.15)',opacity:0}],{duration:480+Math.random()*380,easing:'ease-out'}).onfinish=function(){f.remove()};
    }
    setTimeout(function(){btn.classList.remove('firing')},650);
  }
  document.querySelectorAll('.dk-btn,.dk-actions a').forEach(function(b){
    b.addEventListener('click',function(e){
      burst(this);
      if(reduce)return;
      var r=this.getBoundingClientRect(),s=document.createElement('span');
      s.className='ripple';s.style.cssText+='width:'+Math.max(r.width,r.height)+'px;height:'+Math.max(r.width,r.height)+'px;left:'+(e.clientX-r.left)+'px;top:'+(e.clientY-r.top)+'px';
      this.style.position='relative';this.style.overflow='hidden';this.appendChild(s);setTimeout(function(){s.remove()},650);
    });
  });

  /* ---------- ticker duplicate ---------- */
  var tk=document.getElementById('dkTk');
  if(tk)tk.innerHTML+=tk.innerHTML;

  /* ---------- console ---------- */
  var consoleEl=document.getElementById('dkConsole');
  var logs=[
    ['boot','license engine ready'],
    ['db','synced 128 rows'],
    ['ping','node AP-SOUTH-1 24ms'],
    ['hwid','device lock armed'],
    ['store','queue scan complete'],
    ['auth','session heartbeat OK'],
    ['mint','key generator hot'],
    ['shield','rate-limiter active']
  ];
  function pushLine(){
    if(!consoleEl||reduce)return;
    var l=logs[(Math.random()*logs.length)|0];
    var now=new Date();
    var p=function(v){return(v<10?'0':'')+v};
    var t=p(now.getHours())+':'+p(now.getMinutes())+':'+p(now.getSeconds());
    var el=document.createElement('div');el.className='ln';
    el.innerHTML='<b>'+t+'</b> ['+l[0]+'] <i>'+l[1]+'</i>';
    consoleEl.appendChild(el);
    while(consoleEl.children.length>9)consoleEl.removeChild(consoleEl.firstChild);
    consoleEl.scrollTop=consoleEl.scrollHeight;
  }
  for(var k=0;k<6;k++)setTimeout(pushLine,k*120);
  setInterval(pushLine,2200);

  /* ---------- clocks ---------- */
  var target=new Date("<?= esc($expiration_date) ?>").getTime();
  setInterval(function(){
    var diff=target-new Date().getTime(),el=document.getElementById('exp');if(!el)return;
    if(diff<0){el.innerHTML='EXPIRED';return;}
    var d=Math.floor(diff/864e5),h=Math.floor(diff/36e5)%24,m=Math.floor(diff/6e4)%60,s=Math.floor(diff/1e3)%60;
    el.innerHTML=d+'D '+h+'H '+m+'M '+s+'S';
  },1000);
  function lobby(){var n=new Date(),p=function(v){return(v<10?'0':'')+v},el=document.getElementById('lobbyClock');if(el)el.textContent=p(n.getHours())+':'+p(n.getMinutes())+':'+p(n.getSeconds());}
  lobby();setInterval(lobby,1000);

  /* ---------- stat counters + pulse ---------- */
  function tick(el,next,suffix){
    if(!el)return;
    var cur=parseInt((el.textContent||'0').replace(/\D+/g,''),10)||0;
    var end=parseInt(next,10)||0;
    if(cur===end){el.textContent=end+(suffix||'');return;}
    var step=(end-cur)/16,i=0,t=setInterval(function(){i++;el.textContent=Math.round(cur+step*i)+(suffix||'');if(i>=16){el.textContent=end+(suffix||'');clearInterval(t)}},26);
  }
  function apply(d,fromZero){
    if(!d)return;
    var map=[['stTotal',d.total,''],['stUsed',d.used,''],['stUnused',d.unused,''],['stFill',d.fill,'%'],['stUsers',d.users,''],['stPending',d.pending,'']];
    map.forEach(function(m){
      var el=document.getElementById(m[0]);
      if(el&&fromZero)el.textContent='0';
      tick(el,m[1],m[2]);
    });
    var core=document.getElementById('orbitOnline');if(core)core.textContent=d.online;
    var max=Math.max(1,d.total);
    var flows={total:d.total,used:d.used,unused:d.unused,online:d.online};
    Object.keys(flows).forEach(function(key){
      var bar=document.querySelector('[data-flow="'+key+'"]');
      if(bar)bar.style.width=Math.min(100,Math.round(flows[key]/max*100))+'%';
      var val=document.querySelector('[data-flowval="'+key+'"]');
      if(val)val.textContent=flows[key];
    });
    var dial=document.getElementById('dkDial');if(dial)dial.style.setProperty('--fill',d.fill);
    var dn=document.getElementById('dialNum');if(dn)dn.textContent=d.fill+'%';
    var fm=document.getElementById('flowMeta');if(fm)fm.innerHTML=d.used+' bound &middot; '+d.unused+' idle';
  }
  apply({total:<?= (int)$stats['total'] ?>,used:<?= (int)$stats['used'] ?>,unused:<?= (int)$stats['unused'] ?>,fill:<?= (int)$stats['fill'] ?>,users:<?= (int)$stats['users'] ?>,pending:<?= (int)$stats['pending'] ?>,online:<?= (int)$stats['online'] ?>},true);

  function pulseDeck(){
    fetch('<?= site_url('pulse') ?>',{headers:{'Accept':'application/json'}})
      .then(function(r){return r.ok?r.json():null})
      .then(function(d){apply(d,false)}).catch(function(){});
  }
  setInterval(pulseDeck,12000);

  /* ---------- welcome ---------- */
  <?php if (session()->get('welcome_toast')) : ?>
  if(window.bbBurst)window.bbBurst('LOCKED IN');
  if(window.bbToast)window.bbToast('NODE ONLINE','ok');
  <?php session()->remove('welcome_toast'); endif; ?>
})();
</script>
<?= $this->endSection() ?>
