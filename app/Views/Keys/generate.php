<?= $this->extend('Layout/Starter') ?>

<?= $this->section('css') ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<style>
@property --dkAng{syntax:'<angle>';initial-value:0deg;inherits:false}
:root{--dk-cyan:#00ffd0;--dk-lime:#b6ff3c;--dk-rose:#ff2d6a;--dk-purple:#b44bff;--dk-gold:#ffb84d;--dk-ink:#e8f6ff;--dk-dim:#8aa3c2;--dk-line:rgba(0,255,208,.18)}
::selection{background:rgba(0,255,208,.35);color:#03110c}

#gen3d{position:fixed;inset:0;z-index:0;pointer-events:none}
.gen-torch{position:fixed;inset:0;z-index:1;pointer-events:none;opacity:.5;
  background:radial-gradient(340px circle at var(--tx,50%) var(--ty,30%),rgba(0,255,208,.08),transparent 70%)}
.gen-wrap{position:relative;z-index:3;padding:18px 22px 56px;perspective:1600px}

.dk-reveal{opacity:0;transform:translateY(46px) rotateX(10deg) scale(.985);transform-origin:50% 0;transition:opacity .8s cubic-bezier(.2,.7,.3,1),transform .8s cubic-bezier(.2,.7,.3,1)}
.dk-reveal.in{opacity:1;transform:none}
.dk-reveal.d1{transition-delay:.08s}.dk-reveal.d2{transition-delay:.16s}

/* hero */
.dk-hero{position:relative;overflow:hidden;min-height:230px;margin:0 0 16px;padding:28px 32px;display:grid;grid-template-columns:1.45fr .55fr;align-items:center;gap:22px;
  border:1px solid rgba(0,255,208,.32);
  background:radial-gradient(460px 200px at 10% 0%,rgba(0,255,208,.16),transparent 60%),radial-gradient(420px 220px at 96% 100%,rgba(180,75,255,.14),transparent 62%),linear-gradient(135deg,rgba(4,12,24,.96),rgba(6,14,30,.92));
  transform-style:preserve-3d;transition:transform .18s ease-out;will-change:transform}
.dk-hero:after{content:'';position:absolute;left:-30%;top:0;width:28%;height:100%;background:linear-gradient(90deg,transparent,rgba(0,255,208,.12),transparent);animation:dkSweep 5.4s ease-in-out infinite;pointer-events:none}
@keyframes dkSweep{0%{left:-30%}55%,100%{left:130%}}
.dk-hero .dk-scangrid{position:absolute;inset:0;pointer-events:none;background:repeating-linear-gradient(180deg,transparent 0 12px,rgba(0,255,208,.035) 13px);animation:gridDrift 9s linear infinite}
.dk-kick{font-family:Orbitron,sans-serif;letter-spacing:.28em;font-size:11px;color:var(--dk-lime);margin-bottom:10px}
.dk-hero-title{display:flex;align-items:center;gap:16px;margin-bottom:8px}
.dk-hero h1{margin:0;font-family:Orbitron,sans-serif;font-size:clamp(1.7rem,4vw,2.9rem);letter-spacing:.09em;line-height:1.04;color:var(--dk-ink)}
.dk-hero h1 span{position:relative;display:inline-block;background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));-webkit-background-clip:text;background-clip:text;color:transparent;background-size:200%;animation:dkGrad 4s linear infinite}
@keyframes dkGrad{to{background-position:200%}}
.dk-type{max-width:560px;color:var(--dk-dim);min-height:26px;font-size:15px;margin:6px 0}
.dk-type .caret{display:inline-block;width:9px;background:var(--dk-cyan);margin-left:2px;animation:dkBlink .8s infinite}
@keyframes dkBlink{50%{opacity:0}}
.dk-clocks{display:flex;gap:28px;flex-wrap:wrap;margin-top:14px}
.dk-clocks small{display:block;letter-spacing:.2em;color:var(--dk-lime);font-size:10px;font-family:Orbitron,sans-serif}
.dk-clocks strong{display:block;font-family:Orbitron,sans-serif;font-size:17px;color:var(--dk-cyan);text-shadow:0 0 14px rgba(0,255,208,.4);transition:transform .25s,text-shadow .25s}
.dk-clocks div:hover strong{transform:translateY(-3px);text-shadow:0 0 22px rgba(0,255,208,.75)}
.dk-hero-cta{display:flex;gap:12px;flex-wrap:wrap;margin-top:18px}

/* orbit */
.dk-orbit{position:relative;width:200px;height:200px;justify-self:end;display:grid;place-items:center;will-change:transform}
.dk-orbit .ring{position:absolute;border-radius:50%;border:1px solid rgba(0,255,208,.22);border-top-color:rgba(0,255,208,.85)}
.dk-orbit .r1{inset:6%;animation:dkGyroX1 9s linear infinite}
.dk-orbit .r2{inset:20%;border-color:rgba(255,45,106,.25);border-top-color:rgba(255,45,106,.85);animation:dkGyroX2 6s linear infinite reverse}
.dk-orbit .r3{inset:34%;border-color:rgba(182,255,60,.25);border-top-color:rgba(182,255,60,.85);animation:dkGyroY1 4.5s linear infinite}
@keyframes dkGyroX1{from{transform:rotateX(68deg) rotateZ(0)}to{transform:rotateX(68deg) rotateZ(360deg)}}
@keyframes dkGyroX2{from{transform:rotateX(76deg) rotateZ(0)}to{transform:rotateX(76deg) rotateZ(360deg)}}
@keyframes dkGyroY1{from{transform:rotateY(74deg) rotateZ(0)}to{transform:rotateY(74deg) rotateZ(360deg)}}
.dk-orbit .sonar{position:absolute;inset:26%;border-radius:50%;border:1px solid rgba(0,255,208,.55);opacity:0;animation:dkSonar 3.2s ease-out infinite}
@keyframes dkSonar{0%{transform:scale(.35);opacity:.9}100%{transform:scale(1.55);opacity:0}}
.dk-orbit .sweep{position:absolute;inset:6%;border-radius:50%;background:conic-gradient(from 0deg,transparent 0 78%,rgba(0,255,208,.35) 88%,transparent 100%);animation:dkSpin 2.4s linear infinite;filter:blur(.4px)}
@keyframes dkSpin{to{transform:rotate(360deg)}}
.dk-orbit .core{width:70px;height:70px;display:grid;place-items:center;color:#031018;
  background:linear-gradient(135deg,var(--dk-cyan),var(--dk-lime));clip-path:polygon(50% 0,95% 25%,95% 75%,50% 100%,5% 75%,5% 25%);box-shadow:0 0 40px rgba(0,255,208,.4);
  animation:dkCoreWob 6s ease-in-out infinite,dkPulse 3s ease-in-out infinite}
.dk-orbit .core svg{width:30px;height:30px}
@keyframes dkCoreWob{0%,100%{transform:rotateY(-18deg) rotateX(6deg)}50%{transform:rotateY(18deg) rotateX(-6deg)}}
@keyframes dkPulse{50%{box-shadow:0 0 70px rgba(0,255,208,.7)}}
.dk-orbit small{position:absolute;bottom:14px;letter-spacing:.16em;font-size:9px;color:var(--dk-dim);font-family:Orbitron,sans-serif}

/* buttons */
.dk-btn{font-family:Orbitron,sans-serif;font-size:11px;letter-spacing:.1em;padding:12px 20px;text-decoration:none;position:relative;overflow:hidden;border:1px solid rgba(0,255,208,.25);color:var(--dk-ink);background:rgba(3,10,20,.5);display:inline-flex;align-items:center;justify-content:center;gap:8px;
  transition:transform .18s cubic-bezier(.2,.7,.3,1),box-shadow .25s,border-color .2s,filter .2s,text-shadow .2s;cursor:pointer;will-change:transform}
.dk-btn.fill{background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));color:#03110c;font-weight:700;border-color:transparent;
  box-shadow:0 6px 0 rgba(11,94,74,.65),0 12px 28px rgba(0,255,208,.22)}
.dk-btn:hover{transform:translateY(-3px) rotateX(9deg);box-shadow:0 16px 36px rgba(0,255,208,.32);border-color:var(--dk-cyan)}
.dk-btn.fill:hover{box-shadow:0 9px 0 rgba(11,94,74,.55),0 20px 42px rgba(0,255,208,.38)}
.dk-btn:active{transform:translateY(2px) scale(.97) rotateX(0)}
.dk-btn:not(.fill):hover{text-shadow:-1.5px 0 rgba(255,45,106,.75),1.5px 0 rgba(0,255,208,.75)}
.dk-btn:not(.fill):before{content:'';position:absolute;inset:0;padding:1.5px;pointer-events:none;
  background:conic-gradient(from var(--dkAng),transparent 0 60%,rgba(0,255,208,.2) 70%,var(--dk-cyan) 78%,var(--dk-lime) 84%,transparent 92%);
  -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;
  mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);mask-composite:exclude;
  opacity:0;transition:opacity .25s}
.dk-btn:not(.fill):hover:before{opacity:1;animation:dkAngRot 1.9s linear infinite}
@keyframes dkAngRot{to{--dkAng:360deg}}
.dk-btn-wave{position:absolute;left:0;right:0;bottom:0;height:10px;display:flex;align-items:flex-end;gap:2px;pointer-events:none;opacity:.5}
.dk-btn-wave i{flex:1;height:3px;background:currentColor;transform-origin:bottom;animation:dkBtnWv .7s ease-in-out infinite alternate}
.dk-btn-wave i:nth-child(2){animation-delay:.08s}.dk-btn-wave i:nth-child(3){animation-delay:.16s}.dk-btn-wave i:nth-child(4){animation-delay:.24s}
.dk-btn-wave i:nth-child(5){animation-delay:.32s}.dk-btn-wave i:nth-child(6){animation-delay:.4s}.dk-btn-wave i:nth-child(7){animation-delay:.48s}.dk-btn-wave i:nth-child(8){animation-delay:.56s}
@keyframes dkBtnWv{from{transform:scaleY(.2)}to{transform:scaleY(1)}}
.dk-btn.fill .dk-btn-wave{color:#03110c;opacity:.35}
.dk-btn:not(.fill) .dk-btn-wave{color:var(--dk-cyan)}

/* panel */
.dk-panel{position:relative;padding:20px;border:1px solid rgba(0,255,208,.22);background:linear-gradient(160deg,rgba(6,16,32,.96),rgba(4,10,20,.94));transition:box-shadow .3s,border-color .3s;will-change:transform}
.dk-panel:before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--dk-cyan),transparent);background-size:40% 100%;background-repeat:no-repeat;opacity:.75;animation:dkBeam 5s linear infinite}
@keyframes dkBeam{0%{background-position:-40% 0}100%{background-position:140% 0}}
.dk-panel:hover{box-shadow:0 22px 64px rgba(0,255,208,.12);border-color:rgba(0,255,208,.4)}
.dk-panel h2{margin:0;font-family:Orbitron,sans-serif;letter-spacing:.14em;font-size:12px;color:var(--dk-cyan)}
.dk-panel header{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin:0 0 16px}
.dk-panel header em{color:var(--dk-dim);font-style:normal;font-size:10px;font-family:Orbitron,sans-serif;letter-spacing:.1em}
.dk-h{display:flex;align-items:center;gap:10px}
.dk-glare{position:absolute;inset:0;pointer-events:none;background:radial-gradient(520px circle at var(--gx,50%) var(--gy,50%),rgba(255,255,255,.09),transparent 46%);opacity:0;transition:opacity .3s}
.dk-panel:hover .dk-glare{opacity:1}
.dk-corners{position:absolute;inset:0;pointer-events:none}
.dk-corners i{position:absolute;width:13px;height:13px;border:1px solid var(--dk-cyan);opacity:0;transition:opacity .35s,transform .35s;filter:drop-shadow(0 0 4px rgba(0,255,208,.6))}
.dk-corners i:nth-child(1){top:6px;left:6px;border-right:0;border-bottom:0;transform:translate(4px,4px)}
.dk-corners i:nth-child(2){top:6px;right:6px;border-left:0;border-bottom:0;transform:translate(-4px,4px)}
.dk-corners i:nth-child(3){bottom:6px;left:6px;border-right:0;border-top:0;transform:translate(4px,-4px)}
.dk-corners i:nth-child(4){bottom:6px;right:6px;border-left:0;border-top:0;transform:translate(-4px,-4px)}
.dk-panel:hover .dk-corners i{opacity:.9;transform:translate(0,0)}
.dk-trace{position:absolute;inset:0;width:100%;height:100%;pointer-events:none;opacity:0;transition:opacity .4s}
.dk-panel:hover .dk-trace{opacity:1}
.dk-trace rect{fill:none;stroke:var(--dk-cyan);stroke-width:1.6;stroke-dasharray:16 84;filter:drop-shadow(0 0 5px rgba(0,255,208,.7));animation:dkTrace 3s linear infinite}
@keyframes dkTrace{to{stroke-dashoffset:-100}}
.dk-panel.flick{animation:dkFlick .65s steps(2)}
@keyframes dkFlick{0%{box-shadow:0 0 0 rgba(0,255,208,0)}30%{box-shadow:0 0 46px rgba(0,255,208,.35)}55%{box-shadow:0 0 6px rgba(0,255,208,.04)}100%{box-shadow:0 22px 64px rgba(0,255,208,.12)}}

/* form */
.gen-form{display:flex;flex-direction:column;gap:18px}
.gen-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.gen-field label{display:block;font-family:Orbitron,sans-serif;font-size:10px;letter-spacing:.18em;color:var(--dk-lime);margin-bottom:8px;text-transform:uppercase}
.gen-input,.gen-form select,.gen-form input[type=number],.gen-form input[type=text]{
  width:100%!important;background:rgba(4,12,24,.92)!important;border:1px solid rgba(0,255,208,.25)!important;color:var(--dk-ink)!important;
  font-family:'Share Tech Mono',monospace;font-size:14px;padding:12px 14px;border-radius:2px;outline:none;
  transition:border-color .25s,box-shadow .25s,background .25s;height:auto}
.gen-input:focus,.gen-form select:focus,.gen-form input:focus{border-color:var(--dk-cyan)!important;box-shadow:0 0 16px rgba(0,255,208,.3)!important;background:rgba(5,16,30,.98)!important}
.gen-form select option{background:#04101c;color:var(--dk-ink)}
.gen-error{display:block;color:var(--dk-rose);font-family:'Share Tech Mono',monospace;font-size:11px;margin-top:6px}

.gen-check{display:flex;align-items:center;gap:14px;padding:14px 16px;border:1px solid rgba(0,255,208,.22);background:linear-gradient(90deg,rgba(0,255,208,.06),transparent);transition:border-color .25s,box-shadow .25s}
.gen-check:hover{border-color:rgba(0,255,208,.45);box-shadow:0 0 20px rgba(0,255,208,.1)}
.gen-check input{appearance:none;-webkit-appearance:none;width:20px;height:20px;flex-shrink:0;margin:0;border:1px solid rgba(0,255,208,.55);background:rgba(3,10,20,.9);position:relative;cursor:pointer;transition:background .2s,border-color .2s,box-shadow .2s}
.gen-check input:checked{background:linear-gradient(135deg,var(--dk-cyan),var(--dk-lime));border-color:transparent;box-shadow:0 0 14px rgba(0,255,208,.5)}
.gen-check input:checked:after{content:'';position:absolute;left:6px;top:2px;width:5px;height:10px;border:solid #03110c;border-width:0 2px 2px 0;transform:rotate(45deg)}
.gen-check label{margin:0;cursor:pointer;font-family:Orbitron,sans-serif;font-size:11px;letter-spacing:.1em;color:var(--dk-ink)}
.gen-check small{margin-left:auto;color:var(--dk-dim);font-family:'Share Tech Mono',monospace;font-size:10px;letter-spacing:.12em}

.gen-est{background:linear-gradient(90deg,rgba(182,255,60,.12),rgba(0,255,208,.05))!important;border-color:rgba(182,255,60,.45)!important;color:var(--dk-lime)!important;font-family:Orbitron,sans-serif!important;font-weight:700;letter-spacing:.08em;box-shadow:inset 0 0 22px rgba(182,255,60,.08)}
.gen-submit{width:100%;padding:16px 22px;font-size:12px;letter-spacing:.2em}
.gen-submit.is-firing:after{content:'FORGING';background:rgba(3,10,18,.82);letter-spacing:.24em}
.gen-hint{color:var(--dk-dim);font-family:'Share Tech Mono',monospace;font-size:10px;letter-spacing:.12em;text-align:center;margin:0}

/* success drop */
.gen-drop{position:relative;margin-bottom:16px;border:1px solid rgba(182,255,60,.4);background:linear-gradient(160deg,rgba(6,20,16,.96),rgba(4,12,20,.96));box-shadow:0 0 44px rgba(182,255,60,.1);padding:22px;overflow:hidden}
.gen-drop:before{content:'';position:absolute;left:-20%;top:0;width:24%;height:100%;background:linear-gradient(90deg,transparent,rgba(182,255,60,.14),transparent);animation:dkSweep 4.6s ease-in-out infinite}
.gen-drop h2{font-family:Orbitron,sans-serif;font-size:16px;letter-spacing:.16em;color:var(--dk-lime);margin:0}
.gen-drop .drop-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;margin:16px 0}
.gen-drop .drop-grid small{display:block;color:var(--dk-dim);font-family:Orbitron,sans-serif;font-size:9px;letter-spacing:.16em}
.gen-drop .drop-grid b{display:block;color:var(--dk-ink);font-family:'Share Tech Mono',monospace;font-size:15px}
.key-mono-list{display:flex;flex-wrap:wrap;gap:8px;margin:8px 0 14px}
.key-mono-list code{font-family:'Share Tech Mono',monospace;font-size:13px;padding:7px 11px;border:1px solid rgba(0,255,208,.3);background:rgba(0,255,208,.06);color:var(--dk-lime);border-radius:2px;letter-spacing:.06em;cursor:pointer;transition:box-shadow .25s,border-color .25s}
.key-mono-list code:hover{box-shadow:0 0 16px rgba(0,255,208,.35);border-color:var(--dk-cyan)}
.gen-drop .shop-cta{display:flex;gap:10px;flex-wrap:wrap;margin:0}

/* shock + ripple */
.dk-shock{position:fixed;width:10px;height:10px;border:2px solid rgba(0,255,208,.75);border-radius:50%;pointer-events:none;z-index:9997;transform:translate(-50%,-50%);box-shadow:0 0 18px rgba(0,255,208,.5);animation:dkShock .55s cubic-bezier(.2,.7,.3,1) forwards}
@keyframes dkShock{0%{width:10px;height:10px;opacity:1;border-width:2px}100%{width:150px;height:150px;opacity:0;border-width:1px}}
.ripple{position:absolute;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.5),rgba(0,255,208,.25) 40%,transparent 70%);pointer-events:none;transform:translate(-50%,-50%) scale(0);animation:dkRip .6s ease-out forwards;z-index:5}
@keyframes dkRip{from{transform:translate(-50%,-50%) scale(0);opacity:.7}to{transform:translate(-50%,-50%) scale(1);opacity:0}}

/* forge overlay */
.gen-forge{position:fixed;inset:0;z-index:9998;display:grid;place-items:center;background:radial-gradient(circle at 50% 45%,rgba(0,255,208,.1),rgba(2,8,14,.9) 55%,rgba(2,6,10,.96));backdrop-filter:blur(8px);opacity:0;visibility:hidden;transition:opacity .3s,visibility .3s}
.gen-forge.on{opacity:1;visibility:visible}
.gen-forge-in{position:relative;text-align:center;width:min(360px,80vw)}
.gen-forge-in .forge-hex{animation:forgeFloat 1.4s ease-in-out infinite}
@keyframes forgeFloat{50%{transform:translateY(-10px) scale(1.06)}}
.gen-forge-in .forge-ring{position:absolute;left:50%;top:44px;width:150px;height:150px;margin:-75px 0 0 -75px;border-radius:50%;border:1px solid rgba(0,255,208,.35);animation:forgeRing 1.2s linear infinite}
.gen-forge-in .forge-ring.r2{animation-duration:1.8s;animation-direction:reverse;border-color:rgba(182,255,60,.3)}
@keyframes forgeRing{from{transform:rotateX(70deg) rotateZ(0)}to{transform:rotateX(70deg) rotateZ(360deg)}}
.gen-forge-in .forge-txt{margin-top:18px;font-family:Orbitron,sans-serif;font-size:12px;letter-spacing:.3em;color:var(--dk-cyan);text-shadow:0 0 14px rgba(0,255,208,.6)}
.gen-forge-in .forge-pct{margin-top:8px;font-family:Orbitron,sans-serif;font-size:22px;color:var(--dk-lime);text-shadow:0 0 16px rgba(182,255,60,.5)}
.gen-forge-in .forge-bar{margin-top:16px;height:3px;background:rgba(0,255,208,.14);overflow:hidden}
.gen-forge-in .forge-bar i{display:block;height:100%;width:0;background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));box-shadow:0 0 14px rgba(0,255,208,.8)}
.gen-forge.on .forge-bar i{animation:forgeFill 1.15s linear forwards}
@keyframes forgeFill{to{width:100%}}

@media (max-width:980px){
  .dk-hero{grid-template-columns:1fr;padding:24px}
  .dk-orbit{justify-self:center;margin-top:8px}
  .gen-grid{grid-template-columns:1fr}
  .gen-drop .drop-grid{grid-template-columns:1fr}
}
@media (prefers-reduced-motion:reduce){*{animation-duration:.001ms!important;animation-iteration-count:1!important;transition-duration:.001ms!important}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<canvas id="gen3d"></canvas>
<div class="gen-torch" id="genTorch"></div>

<div class="gen-wrap">
    <div class="mb-3"><?= $this->include('Layout/msgStatus') ?></div>

    <section class="dk-hero dk-reveal" id="genHero">
        <div class="dk-scangrid"></div>
        <div>
            <div class="dk-kick">ARMORY &middot; LICENSE FORGE</div>
            <div class="dk-hero-title">
                <?= view('Layout/HexBadge', ['hbSize' => 56]) ?>
                <h1>GENERATE <span>LICENSE</span></h1>
            </div>
            <p class="dk-type"><span id="genTyped"></span><span class="caret">&nbsp;</span></p>
            <div class="dk-clocks">
                <div><small>SALDO</small><strong>$<?= esc($user->saldo) ?></strong></div>
                <div><small>OPERATOR</small><strong><?= esc($user->username) ?></strong></div>
                <div><small>GAMES</small><strong><?= esc(count($game)) ?></strong></div>
            </div>
            <div class="dk-hero-cta">
                <a class="dk-btn" href="<?= site_url('keys') ?>">BACK TO VAULT</a>
            </div>
        </div>
        <div class="dk-orbit" id="genOrbit" aria-hidden="true">
            <span class="ring r1"></span>
            <span class="ring r2"></span>
            <span class="ring r3"></span>
            <span class="sonar"></span>
            <span class="sweep"></span>
            <span class="core"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg></span>
            <small>FORGE CORE</small>
        </div>
    </section>

    <?php if (session()->getFlashdata('user_key')) : ?>
        <?php
            $dropKeys = preg_split('/\s+/', trim((string) (session()->getFlashdata('generated_keys') ?: session()->getFlashdata('user_key'))));
            $dropKeys = array_values(array_filter($dropKeys));
            $dropCount = (int) (session()->getFlashdata('bulk_count') ?: count($dropKeys));
            $dropDur = (int) session()->getFlashdata('duration');
            $dropDev = (int) session()->getFlashdata('max_devices');
            $dropGame = (string) session()->getFlashdata('game');
        ?>
        <div class="gen-drop dk-reveal d1" id="genDrop" data-bb-success="1">
            <h2>KEY DROP COMPLETE</h2>
            <div class="drop-grid">
                <div><small>GAME</small><b><?= esc($dropGame) ?></b></div>
                <div><small>DURATION</small><b><?= esc($dropDur) ?> Hours</b></div>
                <div><small>MAX DEVICES</small><b><?= esc($dropDev) ?> Devices</b></div>
            </div>
            <p class="gen-hint" style="text-align:left">License Key<?= $dropCount > 1 ? 's ('.$dropCount.')' : '' ?> &middot; tap a code to copy</p>
            <div class="key-mono-list">
                <?php foreach ($dropKeys as $k) : ?>
                    <code class="key-mono" data-key="<?= esc($k, 'attr') ?>"><?= esc($k) ?></code>
                <?php endforeach; ?>
            </div>
            <textarea id="mytext" hidden readonly><?= esc(implode("\n", $dropKeys)) ?></textarea>
            <div class="shop-cta">
                <button type="button" class="dk-btn fill" onclick="copyOnlyKey()"><span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span>COPY KEY</button>
                <button type="button" class="dk-btn" onclick="copyDetails()"><span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span>COPY DETAILS</button>
                <button type="button" class="dk-btn" onclick="shareText()"><span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span>SHARE</button>
            </div>
            <script>
            window.bbDrop = {
                keys: <?= json_encode($dropKeys) ?>,
                count: <?= (int) $dropCount ?>,
                duration: <?= (int) $dropDur ?>,
                devices: <?= (int) $dropDev ?>,
                game: <?= json_encode($dropGame) ?>
            };
            </script>
        </div>
    <?php endif; ?>

    <section class="dk-panel dk-reveal d2" id="genPanel">
        <header>
            <span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>CREATE LICENSE</h2><em>FORGE PARAMETERS</em></span>
            <em>FEE AUTO-CALC</em>
        </header>

        <?= form_open('', ['class' => 'gen-form', 'id' => 'genForm']) ?>
            <div class="gen-grid">
                <div class="gen-field">
                    <label for="game">Game</label>
                    <?= form_dropdown(['class' => 'gen-input', 'name' => 'game', 'id' => 'game'], $game, old('game') ?: '') ?>
                    <?php if ($validation->hasError('game')) : ?>
                        <small class="gen-error"><?= $validation->getError('game') ?></small>
                    <?php endif; ?>
                </div>
                <div class="gen-field">
                    <label for="max_devices">Max Devices</label>
                    <input type="number" name="max_devices" id="max_devices" class="gen-input" value="<?= old('max_devices') ?: 1 ?>" placeholder="1">
                    <?php if ($validation->hasError('max_devices')) : ?>
                        <small class="gen-error"><?= $validation->getError('max_devices') ?></small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="gen-field">
                <label for="duration">Duration</label>
                <?= form_dropdown(['class' => 'gen-input', 'name' => 'duration', 'id' => 'duration'], $duration, old('duration') ?: '') ?>
                <?php if ($validation->hasError('duration')) : ?>
                    <small class="gen-error"><?= $validation->getError('duration') ?></small>
                <?php endif; ?>
            </div>

            <div class="gen-check">
                <input type="checkbox" name="check" id="check" onchange="fupi(this)">
                <label for="check">Custom Key</label>
                <small>MANUAL LICENSE STRING</small>
            </div>

            <div id="custom-key-section" class="gen-field" style="display:none">
                <label for="custom">Input Your Key</label>
                <input type="text" name="cuslicense" id="custom" minlength="4" maxlength="64" class="gen-input" placeholder="4-64 chars, letters / numbers / symbols">
                <p class="gen-hint" style="text-align:left;margin-top:6px">No spaces or quotes. Must be unique.</p>
            </div>

            <div id="bulk-section" class="gen-field">
                <label for="hulala">Bulk Keys</label>
                <select name="loopcount" id="hulala" class="gen-input">
                    <option value="1">1 Key</option>
                    <option value="5">5 Keys</option>
                    <option value="10">10 Keys</option>
                    <option value="25">25 Keys</option>
                    <option value="50">50 Keys</option>
                    <option value="100">100 Keys</option>
                </select>
            </div>

            <input type="text" id="textinput" name="custominput" hidden>

            <div class="gen-field">
                <label for="estimation">Estimation</label>
                <input type="text" id="estimation" class="gen-input gen-est" placeholder="Your order will total" readonly>
            </div>

            <button type="submit" id="genSubmit" class="dk-btn fill gen-submit">
                <span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span>
                FORGE LICENSE
            </button>
            <p class="gen-hint">Duration starts on first login. HWID locks to the first device.</p>
        <?= form_close() ?>
    </section>
</div>

<div class="gen-forge" id="genForge" aria-hidden="true">
    <div class="gen-forge-in">
        <span class="forge-ring"></span>
        <span class="forge-ring r2"></span>
        <div class="forge-hex"><?= view('Layout/HexBadge', ['hbSize' => 96]) ?></div>
        <div class="forge-txt">FORGING LICENSE</div>
        <div class="forge-pct" id="forgePct">0%</div>
        <div class="forge-bar"><i></i></div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
(function(){
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var forge = 0;

  /* ---------- torch ---------- */
  var torch=document.getElementById('genTorch');
  addEventListener('mousemove',function(e){
    if(!torch)return;
    torch.style.setProperty('--tx',e.clientX+'px');
    torch.style.setProperty('--ty',e.clientY+'px');
  });

  /* ---------- panel chrome + trace ---------- */
  document.querySelectorAll('.dk-panel').forEach(function(p){
    var g=document.createElement('div');g.className='dk-glare';p.appendChild(g);
    var c=document.createElement('div');c.className='dk-corners';c.innerHTML='<i></i><i></i><i></i><i></i>';p.appendChild(c);
  });
  (function(){
    var NS='http://www.w3.org/2000/svg';
    function addTrace(el,stroke){
      var svg=document.createElementNS(NS,'svg');svg.setAttribute('class','dk-trace');
      var r=document.createElementNS(NS,'rect');r.setAttribute('pathLength','100');
      if(stroke)r.style.stroke=stroke;
      svg.appendChild(r);el.appendChild(svg);
      function size(){r.setAttribute('x',1);r.setAttribute('y',1);r.setAttribute('width',Math.max(0,el.clientWidth-2));r.setAttribute('height',Math.max(0,el.clientHeight-2));}
      size();addEventListener('resize',size);
    }
    document.querySelectorAll('.dk-panel').forEach(function(p){addTrace(p)});
    [['genHero','#b6ff3c'],['genDrop','#b6ff3c']].forEach(function(pair){
      var el=document.getElementById(pair[0]);if(el)addTrace(el,pair[1]);
    });
  })();

  var gp=document.getElementById('genPanel');
  if(gp)gp.addEventListener('mousemove',function(e){
    var r=gp.getBoundingClientRect();
    gp.style.setProperty('--gx',((e.clientX-r.left)/r.width*100)+'%');
    gp.style.setProperty('--gy',((e.clientY-r.top)/r.height*100)+'%');
  });

  /* ---------- hero tilt ---------- */
  var hero=document.getElementById('genHero'),orbit=document.getElementById('genOrbit');
  if(hero)addEventListener('mousemove',function(e){
    if(reduce||innerWidth<980)return;
    var x=e.clientX/innerWidth-.5,y=e.clientY/innerHeight-.5;
    hero.style.transform='perspective(1200px) rotateY('+(x*4)+'deg) rotateX('+(-y*3)+'deg)';
    if(orbit)orbit.style.transform='translate('+(x*14)+'px,'+(y*9)+'px)';
  });

  /* ---------- typewriter ---------- */
  var phrases=['Forge a loader key. Duration starts on first login.','Custom or bulk. HWID locks to the first device.','Every license is signed by the vault.'];
  var typed=document.getElementById('genTyped'),pi=0,ci=0,del=false;
  (function type(){
    if(!typed)return;
    var cur=phrases[pi];
    typed.textContent=del?cur.slice(0,--ci):cur.slice(0,++ci);
    if(!del&&ci===cur.length){del=true;return setTimeout(type,2400)}
    if(del&&ci===0){del=false;pi=(pi+1)%phrases.length}
    setTimeout(type,del?22:46);
  })();

  /* ---------- reveal ---------- */
  var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target)}})},{threshold:.1});
  document.querySelectorAll('.dk-reveal').forEach(function(el){io.observe(el)});

  /* ---------- wave-circle tap ---------- */
  function shock(x,y){
    var s=document.createElement('span');s.className='dk-shock';
    s.style.left=x+'px';s.style.top=y+'px';
    document.body.appendChild(s);setTimeout(function(){s.remove()},620);
  }
  document.addEventListener('click',function(e){
    if(reduce)return;
    var t=e.target&&e.target.closest?e.target.closest('.dk-btn,.key-mono'):null;
    if(!t)return;
    shock(e.clientX,e.clientY);
    var r=t.getBoundingClientRect(),s=document.createElement('span');
    s.className='ripple';s.style.cssText+='width:'+Math.max(r.width,r.height)+'px;height:'+Math.max(r.width,r.height)+'px;left:'+(e.clientX-r.left)+'px;top:'+(e.clientY-r.top)+'px';
    t.style.position='relative';t.style.overflow='hidden';t.appendChild(s);setTimeout(function(){s.remove()},650);
  });

  /* ---------- random neon flicker ---------- */
  setInterval(function(){
    if(reduce)return;
    var ps=document.querySelectorAll('.dk-panel');if(!ps.length)return;
    var p=ps[(Math.random()*ps.length)|0];
    p.classList.add('flick');setTimeout(function(){p.classList.remove('flick')},680);
  },7000);

  /* ---------- three.js forge backdrop ---------- */
  window.__genForge=function(){forge=1;};
  (function(){
    var canvas=document.getElementById('gen3d');if(!canvas||!window.THREE)return;
    var renderer=new THREE.WebGLRenderer({canvas:canvas,alpha:true,antialias:true});
    renderer.setPixelRatio(Math.min(devicePixelRatio,2));renderer.setSize(innerWidth,innerHeight);
    var scene=new THREE.Scene();scene.fog=new THREE.FogExp2(0x04090c,0.045);
    var camera=new THREE.PerspectiveCamera(58,innerWidth/innerHeight,.1,100);camera.position.set(0,0,24);

    var N=900,pos=new Float32Array(N*3),col=new Float32Array(N*3);
    var pal=[[0,1,.82],[.71,1,.24],[.7,.3,1],[1,.72,.3]];
    for(var i=0;i<N;i++){
      pos[i*3]=(Math.random()-.5)*52;pos[i*3+1]=(Math.random()-.5)*30;pos[i*3+2]=(Math.random()-.5)*42-4;
      var c=pal[(Math.random()*pal.length)|0];col[i*3]=c[0];col[i*3+1]=c[1];col[i*3+2]=c[2];
    }
    var pg=new THREE.BufferGeometry();
    pg.setAttribute('position',new THREE.BufferAttribute(pos,3));
    pg.setAttribute('color',new THREE.BufferAttribute(col,3));
    var pts=new THREE.Points(pg,new THREE.PointsMaterial({size:.07,vertexColors:true,transparent:true,opacity:.8,blending:THREE.AdditiveBlending,depthWrite:false}));
    scene.add(pts);

    function keyGroup(color,op){
      var mat=new THREE.MeshBasicMaterial({color:color,wireframe:true,transparent:true,opacity:op});
      var g=new THREE.Group();
      var ring=new THREE.Mesh(new THREE.TorusGeometry(.9,.24,8,20),mat);ring.position.x=-1.5;
      var shaft=new THREE.Mesh(new THREE.CylinderGeometry(.2,.2,2.9,6),mat);shaft.rotation.z=Math.PI/2;shaft.position.x=.7;
      var t1=new THREE.Mesh(new THREE.BoxGeometry(.55,.52,.3),mat);t1.position.set(1.7,-.55,0);
      var t2=new THREE.Mesh(new THREE.BoxGeometry(.4,.7,.3),mat);t2.position.set(.95,-.65,0);
      g.add(ring);g.add(shaft);g.add(t1);g.add(t2);
      return g;
    }

    var key=keyGroup(0x00ffd0,.7);key.scale.setScalar(.8);scene.add(key);
    var halo=new THREE.Mesh(new THREE.TorusGeometry(3.4,.05,8,72),new THREE.MeshBasicMaterial({color:0xb6ff3c,wireframe:true,transparent:true,opacity:.28}));
    halo.position.set(0,0,-3);scene.add(halo);
    var knot=new THREE.Mesh(new THREE.TorusKnotGeometry(1.1,.24,64,8),new THREE.MeshBasicMaterial({color:0xb44bff,wireframe:true,transparent:true,opacity:.22}));
    knot.position.set(7.5,3,-9);scene.add(knot);
    var octa=new THREE.Mesh(new THREE.OctahedronGeometry(1.4,0),new THREE.MeshBasicMaterial({color:0xff2d6a,wireframe:true,transparent:true,opacity:.2}));
    octa.position.set(-8,-3,-8);scene.add(octa);
    var grid=new THREE.GridHelper(80,50,0x00ffd0,0x0a2a22);grid.material.transparent=true;grid.material.opacity=.28;grid.position.y=-7;scene.add(grid);

    var mx=0,my=0;
    addEventListener('mousemove',function(e){mx=(e.clientX/innerWidth-.5)*2;my=(e.clientY/innerHeight-.5)*2});
    addEventListener('resize',function(){camera.aspect=innerWidth/innerHeight;camera.updateProjectionMatrix();renderer.setSize(innerWidth,innerHeight)});

    if(reduce){renderer.render(scene,camera);return;}
    var clock=new THREE.Clock();
    (function loop(){
      requestAnimationFrame(loop);
      var t=clock.getElapsedTime();
      var boost=forge?2.6:0;
      key.rotation.y=t*(.55+boost);
      key.rotation.x=Math.sin(t*.8)*(.22+boost*.08);
      key.rotation.z=Math.cos(t*.6)*.12;
      key.position.y=Math.sin(t*.9)*.32;
      key.scale.setScalar(.8+Math.sin(t*2.2)*.03+(forge?.16:0));
      halo.rotation.z=t*(.4+boost*.5);
      halo.rotation.x=Math.sin(t*.5)*.3;
      knot.rotation.x=t*.35; knot.rotation.y=t*.45;
      octa.rotation.x=t*.24; octa.rotation.y=t*.3;
      glowPulse(t);
      pts.rotation.y=t*.02;
      grid.position.z=(t*.55)%1.6;
      camera.position.x+=(mx*2.4-camera.position.x)*.045;
      camera.position.y+=(-my*1.6-camera.position.y)*.045;
      camera.position.z+=(((forge?13:24))-camera.position.z)*.03;
      camera.lookAt(0,0,0);
      renderer.render(scene,camera);
    })();
    function glowPulse(t){
      var m=key.children[0].material;
      m.opacity=.6+Math.sin(t*3)*.15+(forge?.2:0);
    }
  })();

  /* ---------- forge overlay on submit ---------- */
  var form=document.getElementById('genForm');
  var overlay=document.getElementById('genForge');
  var pct=document.getElementById('forgePct');
  var submitting=false;
  if(form){
    form.addEventListener('submit',function(e){
      if(submitting)return;
      e.preventDefault();
      submitting=true;
      if(window.__genForge)window.__genForge();
      if(overlay){
        overlay.classList.add('on');
        overlay.setAttribute('aria-hidden','false');
      }
      var p=0;
      var pi=setInterval(function(){
        p=Math.min(100,p+6+Math.random()*9);
        if(pct)pct.textContent=Math.round(p)+'%';
        if(p>=100)clearInterval(pi);
      },70);
      setTimeout(function(){ form.submit(); },1180);
    });
  }

  /* ---------- price / custom key ---------- */
  jQuery(function($){
    var price = JSON.parse('<?= $price ?>');
    function getPrice(price){
      var device=$('#max_devices').val();
      var durate=$('#duration').val();
      var bulk=parseInt($('#hulala').val()||'1',10);
      var gprice=price[durate];
      if(!isNaN(gprice)){
        $('#estimation').val(device*gprice*bulk);
      }else{
        $('#estimation').val('Estimation error');
      }
    }
    getPrice(price);
    $('#max_devices, #duration, #game, #hulala').change(function(){ getPrice(price); });
  });

  window.fupi=function(obj){
    var custom=document.getElementById('custom-key-section');
    var bulk=document.getElementById('bulk-section');
    var input=document.getElementById('textinput');
    if(jQuery(obj).is(':checked')){
      if(custom)custom.style.display='block';
      if(bulk)bulk.style.display='none';
      if(input)input.value='custom';
    }else{
      if(custom)custom.style.display='none';
      if(bulk)bulk.style.display='block';
      if(input)input.value='auto';
    }
  };

  /* ---------- copy / share ---------- */
  function dropKeys(){
    var d=window.bbDrop||{};
    return d.keys&&d.keys.length?d.keys:String((document.getElementById('mytext')||{}).value||'').split(/\s+/).filter(Boolean);
  }
  window.copyOnlyKey=function(){
    var keys=dropKeys();
    if(window.bbCopyRawKey)window.bbCopyRawKey(keys.join('\n'));
    if(window.bbBurst)window.bbBurst('KEY COPIED');
  };
  window.copyDetails=function(){
    var d=window.bbDrop||{},keys=dropKeys();
    if(window.bbCopyKeyPack){
      window.bbCopyKeyPack({keys:keys,count:d.count||keys.length,duration:d.duration,devices:d.devices});
      if(window.bbBurst)window.bbBurst('COPIED');
    }
  };
  window.copyText=function(){ window.copyDetails(); };
  window.shareText=function(){
    var d=window.bbDrop||{};
    var keys=d.keys&&d.keys.length?d.keys:String((document.getElementById('mytext')||{}).value||'').split(/\s+/).filter(Boolean);
    var pack=window.bbCopyKeyPack;
    if(navigator.share){
      var dur=window.bbHoursLabel?window.bbHoursLabel(d.duration):(d.duration||'-');
      var lines=['Number of Keys: '+(d.count||keys.length),'Maximum Devices: '+(d.devices||'-'),'Duration: '+dur,''];
      keys.forEach(function(k){lines.push('Key: `'+k+'`');});
      lines.push('','Thanks for purchase.','Trust Black Bunny.');
      navigator.share({title:'BLACK BUNNY KEY',text:lines.join('\n')});
    }else if(pack){
      pack({keys:keys,count:d.count||keys.length,duration:d.duration,devices:d.devices});
    }
  };
})();
</script>
<?= $this->endSection() ?>
