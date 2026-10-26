<?= $this->extend('Layout/Starter') ?>

<?= $this->section('css') ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<style>
@property --dkAng{syntax:'<angle>';initial-value:0deg;inherits:false}
:root{--dk-cyan:#00ffd0;--dk-lime:#b6ff3c;--dk-rose:#ff2d6a;--dk-purple:#b44bff;--dk-gold:#ffb84d;--dk-ink:#e8f6ff;--dk-dim:#8aa3c2;--dk-line:rgba(0,255,208,.18)}
::selection{background:rgba(0,255,208,.35);color:#03110c}

#edit3d{position:fixed;inset:0;z-index:0;pointer-events:none}
.edit-torch{position:fixed;inset:0;z-index:1;pointer-events:none;opacity:.5;
  background:radial-gradient(340px circle at var(--tx,50%) var(--ty,30%),rgba(0,255,208,.08),transparent 70%)}
.edit-wrap{position:relative;z-index:3;padding:18px 22px 56px;perspective:1600px}

.dk-reveal{opacity:0;transform:translateY(46px) rotateX(10deg) scale(.985);transform-origin:50% 0;transition:opacity .8s cubic-bezier(.2,.7,.3,1),transform .8s cubic-bezier(.2,.7,.3,1)}
.dk-reveal.in{opacity:1;transform:none}
.dk-reveal.d1{transition-delay:.08s}.dk-reveal.d2{transition-delay:.16s}

/* hero */
.dk-hero{position:relative;overflow:hidden;min-height:230px;margin:0 0 16px;padding:28px 32px;display:grid;grid-template-columns:1.45fr .55fr;align-items:center;gap:22px;
  border:1px solid rgba(0,255,208,.32);
  background:radial-gradient(460px 200px at 10% 0%,rgba(0,255,208,.16),transparent 60%),radial-gradient(420px 220px at 96% 100%,rgba(255,45,106,.12),transparent 62%),linear-gradient(135deg,rgba(4,12,24,.96),rgba(6,14,30,.92));
  transform-style:preserve-3d;transition:transform .18s ease-out;will-change:transform}
.dk-hero:after{content:'';position:absolute;left:-30%;top:0;width:28%;height:100%;background:linear-gradient(90deg,transparent,rgba(0,255,208,.12),transparent);animation:dkSweep 5.4s ease-in-out infinite;pointer-events:none}
@keyframes dkSweep{0%{left:-30%}55%,100%{left:130%}}
.dk-hero .dk-scangrid{position:absolute;inset:0;pointer-events:none;background:repeating-linear-gradient(180deg,transparent 0 12px,rgba(0,255,208,.035) 13px);animation:gridDrift 9s linear infinite}
.dk-kick{font-family:Orbitron,sans-serif;letter-spacing:.28em;font-size:11px;color:var(--dk-lime);margin-bottom:10px}
.dk-hero-title{display:flex;align-items:center;gap:16px;margin-bottom:8px}
.dk-hero h1{margin:0;font-family:Orbitron,sans-serif;font-size:clamp(1.7rem,4vw,2.9rem);letter-spacing:.09em;line-height:1.04;color:var(--dk-ink)}
.dk-hero h1 span{position:relative;display:inline-block;background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));-webkit-background-clip:text;background-clip:text;color:transparent;background-size:200%;animation:dkGrad 4s linear infinite}
@keyframes dkGrad{to{background-position:200%}}
.dk-type{max-width:560px;color:var(--dk-dim);min-height:24px;font-size:15px;margin:6px 0}
.dk-type .caret{display:inline-block;width:9px;background:var(--dk-cyan);margin-left:2px;animation:dkBlink .8s infinite}
@keyframes dkBlink{50%{opacity:0}}
.dk-clocks{display:flex;gap:28px;flex-wrap:wrap;margin-top:14px}
.dk-clocks small{display:block;letter-spacing:.2em;color:var(--dk-lime);font-size:10px;font-family:Orbitron,sans-serif}
.dk-clocks strong{display:block;font-family:Orbitron,sans-serif;font-size:17px;color:var(--dk-cyan);text-shadow:0 0 14px rgba(0,255,208,.4);transition:transform .25s,text-shadow .25s}
.dk-clocks div:hover strong{transform:translateY(-3px);text-shadow:0 0 22px rgba(0,255,208,.75)}
.edit-keyline{display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-top:12px}
.edit-keyline small{font-family:Orbitron,sans-serif;font-size:9px;letter-spacing:.18em;color:var(--dk-dim)}
.edit-keyline code{font-family:'Share Tech Mono',monospace;font-size:13px;padding:5px 10px;border:1px solid rgba(0,255,208,.3);background:rgba(0,255,208,.06);color:var(--dk-lime);border-radius:2px;letter-spacing:.06em;cursor:pointer;transition:box-shadow .25s,border-color .25s}
.edit-keyline code:hover{box-shadow:0 0 16px rgba(0,255,208,.35);border-color:var(--dk-cyan)}
.dk-hero-cta{display:flex;gap:12px;flex-wrap:wrap;margin-top:16px}

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
.dk-btn:disabled{opacity:.4;cursor:not-allowed;filter:grayscale(.35);box-shadow:none;transform:none}
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
.gen-field label small{display:inline-block;margin-left:6px;color:var(--dk-dim);font-family:'Share Tech Mono',monospace;font-size:9px;letter-spacing:.08em;text-transform:none}
.gen-input,.gen-form select,.gen-form input[type=number],.gen-form input[type=text],.gen-form textarea{
  width:100%!important;background:rgba(4,12,24,.92)!important;border:1px solid rgba(0,255,208,.25)!important;color:var(--dk-ink)!important;
  font-family:'Share Tech Mono',monospace;font-size:14px;padding:12px 14px;border-radius:2px;outline:none;
  transition:border-color .25s,box-shadow .25s,background .25s;height:auto}
.gen-form textarea{resize:vertical;min-height:96px;line-height:1.6}
.gen-input:focus,.gen-form select:focus,.gen-form input:focus,.gen-form textarea:focus{border-color:var(--dk-cyan)!important;box-shadow:0 0 16px rgba(0,255,208,.3)!important;background:rgba(5,16,30,.98)!important}
.gen-form select option{background:#04101c;color:var(--dk-ink)}
.gen-form input:disabled,.gen-form textarea:disabled,.gen-form select:disabled{opacity:.5;cursor:not-allowed;border-color:rgba(0,255,208,.12)!important}
.gen-error{display:block;color:var(--dk-rose);font-family:'Share Tech Mono',monospace;font-size:11px;margin-top:6px}
.gen-submit{width:100%;padding:16px 22px;font-size:12px;letter-spacing:.2em}
.gen-submit.is-firing:after{content:'PATCHING';background:rgba(3,10,18,.82);letter-spacing:.24em}
.gen-hint{color:var(--dk-dim);font-family:'Share Tech Mono',monospace;font-size:10px;letter-spacing:.12em;text-align:center;margin:0}
.maxDev{display:inline-block;margin-left:6px;padding:2px 8px;border:1px solid rgba(0,255,208,.35);background:rgba(0,255,208,.07);color:var(--dk-cyan);border-radius:2px;font-family:'Share Tech Mono',monospace;font-size:10px}

/* shock + ripple */
.dk-shock{position:fixed;width:10px;height:10px;border:2px solid rgba(0,255,208,.75);border-radius:50%;pointer-events:none;z-index:9997;transform:translate(-50%,-50%);box-shadow:0 0 18px rgba(0,255,208,.5);animation:dkShock .55s cubic-bezier(.2,.7,.3,1) forwards}
@keyframes dkShock{0%{width:10px;height:10px;opacity:1;border-width:2px}100%{width:150px;height:150px;opacity:0;border-width:1px}}
.ripple{position:absolute;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.5),rgba(0,255,208,.25) 40%,transparent 70%);pointer-events:none;transform:translate(-50%,-50%) scale(0);animation:dkRip .6s ease-out forwards;z-index:5}
@keyframes dkRip{from{transform:translate(-50%,-50%) scale(0);opacity:.7}to{transform:translate(-50%,-50%) scale(1);opacity:0}}

/* forge overlay */
.edit-forge{position:fixed;inset:0;z-index:9998;display:grid;place-items:center;background:radial-gradient(circle at 50% 45%,rgba(0,255,208,.1),rgba(2,8,14,.9) 55%,rgba(2,6,10,.96));backdrop-filter:blur(8px);opacity:0;visibility:hidden;transition:opacity .3s,visibility .3s}
.edit-forge.on{opacity:1;visibility:visible}
.edit-forge-in{position:relative;text-align:center;width:min(360px,80vw)}
.edit-forge-in .forge-hex{animation:forgeFloat 1.4s ease-in-out infinite}
@keyframes forgeFloat{50%{transform:translateY(-10px) scale(1.06)}}
.edit-forge-in .forge-ring{position:absolute;left:50%;top:44px;width:150px;height:150px;margin:-75px 0 0 -75px;border-radius:50%;border:1px solid rgba(0,255,208,.35);animation:forgeRing 1.2s linear infinite}
.edit-forge-in .forge-ring.r2{animation-duration:1.8s;animation-direction:reverse;border-color:rgba(255,45,106,.3)}
@keyframes forgeRing{from{transform:rotateX(70deg) rotateZ(0)}to{transform:rotateX(70deg) rotateZ(360deg)}}
.edit-forge-in .forge-txt{margin-top:18px;font-family:Orbitron,sans-serif;font-size:12px;letter-spacing:.3em;color:var(--dk-cyan);text-shadow:0 0 14px rgba(0,255,208,.6)}
.edit-forge-in .forge-pct{margin-top:8px;font-family:Orbitron,sans-serif;font-size:22px;color:var(--dk-lime);text-shadow:0 0 16px rgba(182,255,60,.5)}
.edit-forge-in .forge-bar{margin-top:16px;height:3px;background:rgba(0,255,208,.14);overflow:hidden}
.edit-forge-in .forge-bar i{display:block;height:100%;width:0;background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));box-shadow:0 0 14px rgba(0,255,208,.8)}
.edit-forge.on .forge-bar i{animation:forgeFill 1.1s linear forwards}
@keyframes forgeFill{to{width:100%}}

@media (max-width:980px){
  .dk-hero{grid-template-columns:1fr;padding:24px}
  .dk-orbit{justify-self:center;margin-top:8px}
  .gen-grid{grid-template-columns:1fr}
}
@media (prefers-reduced-motion:reduce){*{animation-duration:.001ms!important;animation-iteration-count:1!important;transition-duration:.001ms!important}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<canvas id="edit3d"></canvas>
<div class="edit-torch" id="editTorch"></div>

<div class="edit-wrap">
    <div class="mb-3"><?= $this->include('Layout/msgStatus') ?></div>

    <section class="dk-hero dk-reveal" id="editHero">
        <div class="dk-scangrid"></div>
        <div>
            <div class="dk-kick">PATCH &middot; LICENSE OVERRIDE</div>
            <div class="dk-hero-title">
                <?= view('Layout/HexBadge', ['hbSize' => 56]) ?>
                <h1>EDIT <span>KEY</span></h1>
            </div>
            <p class="dk-type"><span id="editTyped"></span><span class="caret">&nbsp;</span></p>
            <div class="edit-keyline">
                <small>LICENSE</small>
                <code class="key-mono" data-key="<?= esc($key->user_key, 'attr') ?>"><?= esc($key->user_key) ?></code>
            </div>
            <div class="dk-clocks">
                <div><small>GAME</small><strong><?= esc($key->game) ?></strong></div>
                <div><small>DEVICES</small><strong><?= (int) $key_info->total ?>/<?= (int) $key->max_devices ?></strong></div>
                <div><small>STATUS</small><strong style="color:<?= $key->status == 1 ? 'var(--dk-lime)' : 'var(--dk-rose)' ?>"><?= $key->status == 1 ? 'ACTIVE' : 'BANNED' ?></strong></div>
            </div>
            <div class="dk-hero-cta">
                <a class="dk-btn" href="<?= site_url('keys') ?>">BACK TO VAULT</a>
                <a class="dk-btn" href="<?= site_url('keys/generate') ?>">GENERATE KEY</a>
            </div>
        </div>
        <div class="dk-orbit" id="editOrbit" aria-hidden="true">
            <span class="ring r1"></span>
            <span class="ring r2"></span>
            <span class="ring r3"></span>
            <span class="sonar"></span>
            <span class="sweep"></span>
            <span class="core"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></span>
            <small>PATCH CORE</small>
        </div>
    </section>

    <section class="dk-panel dk-reveal d1" id="editPanel">
        <header>
            <span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>KEY INFORMATION</h2><em>PATCH CHANNEL</em></span>
            <em>CHANGES UNLOCK SUBMIT</em>
        </header>

        <?= form_open('keys/edit', ['class' => 'gen-form', 'id' => 'editForm']) ?>
            <input type="hidden" name="id_keys" value="<?= (int) $key->id_keys ?>">

            <?php if (($user->level == 1) || ($user->level == 2)) : ?>
                <div class="gen-grid">
                    <div class="gen-field">
                        <label for="game">Game</label>
                        <input type="text" name="game" id="game" value="<?= esc(old('game') ?: $key->game, 'attr') ?>" class="gen-input" placeholder="Game name">
                        <?php if ($validation->hasError('game')) : ?>
                            <small class="gen-error"><?= $validation->getError('game') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="gen-field">
                        <label for="user_key">User Key <small>4-64 chars, no spaces</small></label>
                        <input type="text" name="user_key" id="user_key" maxlength="64" value="<?= esc(old('user_key') ?: $key->user_key, 'attr') ?>" class="gen-input" placeholder="e.g. OWNER-5H-AB12_@X#1">
                        <?php if ($validation->hasError('user_key')) : ?>
                            <small class="gen-error"><?= $validation->getError('user_key') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="gen-field">
                        <label for="duration">Duration <small>in hours</small></label>
                        <input type="number" name="duration" id="duration" value="<?= esc(old('duration') ?: $key->duration, 'attr') ?>" class="gen-input" placeholder="3">
                        <?php if ($validation->hasError('duration')) : ?>
                            <small class="gen-error"><?= $validation->getError('duration') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="gen-field">
                        <label for="max_devices">Max Devices</label>
                        <input type="number" name="max_devices" id="max_devices" value="<?= esc(old('max_devices') ?: $key->max_devices, 'attr') ?>" class="gen-input" placeholder="3">
                        <?php if ($validation->hasError('max_devices')) : ?>
                            <small class="gen-error"><?= $validation->getError('max_devices') ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else : ?>
                <input type="hidden" name="game" value="<?= esc($key->game, 'attr') ?>">
                <input type="hidden" name="user_key" value="<?= esc($key->user_key, 'attr') ?>">
                <input type="hidden" name="duration" value="<?= esc($key->duration, 'attr') ?>">
                <input type="hidden" name="max_devices" value="<?= esc($key->max_devices, 'attr') ?>">
            <?php endif; ?>

            <div class="gen-grid">
                <div class="gen-field">
                    <label for="status">Status</label>
                    <?php $sel_status = ['' => '— Select Status —', '0' => 'Banned/Block', '1' => 'Active']; ?>
                    <?= form_dropdown(['class' => 'gen-input', 'name' => 'status', 'id' => 'status'], $sel_status, $key->status) ?>
                    <?php if ($validation->hasError('status')) : ?>
                        <small class="gen-error"><?= $validation->getError('status') ?></small>
                    <?php endif; ?>
                </div>
                <div class="gen-field">
                    <label for="registrator">Registrator</label>
                    <input type="text" name="registrator" id="registrator" value="<?= esc(old('registrator') ?: $key->registrator, 'attr') ?>" class="gen-input" placeholder="Username">
                    <?php if ($validation->hasError('registrator')) : ?>
                        <small class="gen-error"><?= $validation->getError('registrator') ?></small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="gen-field">
                <label for="expired_date">Expired <?= !$key->expired_date ? '<small>not started yet</small>' : '' ?></label>
                <input type="text" name="expired_date" id="expired_date" value="<?= esc(old('expired_date') ?: $key->expired_date, 'attr') ?>" class="gen-input" placeholder="<?= esc($time::now(), 'attr') ?>">
                <?php if ($validation->hasError('expired_date')) : ?>
                    <small class="gen-error"><?= $validation->getError('expired_date') ?></small>
                <?php endif; ?>
            </div>

            <div class="gen-field">
                <label for="devices">
                    Devices
                    <span class="maxDev"><?= (int) $key_info->total ?>/<?= (int) $key->max_devices ?></span>
                    <small>separate with enter</small>
                </label>
                <textarea name="devices" id="devices" rows="<?= max(2, ($key_info->total > $key->max_devices) ? 3 : (int) $key_info->total) ?>" class="gen-input"><?= esc(old('devices') ?: ($key_info->total ? $key_info->devices : '')) ?></textarea>
                <?php if ($validation->hasError('devices')) : ?>
                    <small class="gen-error"><?= $validation->getError('devices') ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" id="editSubmit" class="dk-btn fill gen-submit btnUpdate" disabled>
                <span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span>
                LOCK KEY PATCH
            </button>
            <p class="gen-hint">Any change unlocks the patch. Registrator, expiry and devices are owner-only fields.</p>
        <?= form_close() ?>
    </section>
</div>

<div class="edit-forge" id="editForge" aria-hidden="true">
    <div class="edit-forge-in">
        <span class="forge-ring"></span>
        <span class="forge-ring r2"></span>
        <div class="forge-hex"><?= view('Layout/HexBadge', ['hbSize' => 96]) ?></div>
        <div class="forge-txt">PATCHING LICENSE</div>
        <div class="forge-pct" id="editPct">0%</div>
        <div class="forge-bar"><i></i></div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
(function(){
  var reduce=window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var forge=0;

  /* torch */
  var torch=document.getElementById('editTorch');
  addEventListener('mousemove',function(e){
    if(!torch)return;
    torch.style.setProperty('--tx',e.clientX+'px');
    torch.style.setProperty('--ty',e.clientY+'px');
  });

  /* panel chrome + trace */
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
    var hEl=document.getElementById('editHero');if(hEl)addTrace(hEl,'#b6ff3c');
  })();

  var ep=document.getElementById('editPanel');
  if(ep)ep.addEventListener('mousemove',function(e){
    var r=ep.getBoundingClientRect();
    ep.style.setProperty('--gx',((e.clientX-r.left)/r.width*100)+'%');
    ep.style.setProperty('--gy',((e.clientY-r.top)/r.height*100)+'%');
  });

  /* hero tilt */
  var hero=document.getElementById('editHero'),orbit=document.getElementById('editOrbit');
  if(hero)addEventListener('mousemove',function(e){
    if(reduce||innerWidth<980)return;
    var x=e.clientX/innerWidth-.5,y=e.clientY/innerHeight-.5;
    hero.style.transform='perspective(1200px) rotateY('+(x*4)+'deg) rotateX('+(-y*3)+'deg)';
    if(orbit)orbit.style.transform='translate('+(x*14)+'px,'+(y*9)+'px)';
  });

  /* typewriter */
  var phrases=['Rewrite duration, devices and status for this license.','Patch the key without touching the vault order.','Owner fields unlock registrator, expiry and device list.'];
  var typed=document.getElementById('editTyped'),pi=0,ci=0,del=false;
  (function type(){
    if(!typed)return;
    var cur=phrases[pi];
    typed.textContent=del?cur.slice(0,--ci):cur.slice(0,++ci);
    if(!del&&ci===cur.length){del=true;return setTimeout(type,2400)}
    if(del&&ci===0){del=false;pi=(pi+1)%phrases.length}
    setTimeout(type,del?22:46);
  })();

  /* reveal */
  var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target)}})},{threshold:.1});
  document.querySelectorAll('.dk-reveal').forEach(function(el){io.observe(el)});

  /* wave-circle tap */
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

  /* random flicker */
  setInterval(function(){
    if(reduce)return;
    var ps=document.querySelectorAll('.dk-panel');if(!ps.length)return;
    var p=ps[(Math.random()*ps.length)|0];
    p.classList.add('flick');setTimeout(function(){p.classList.remove('flick')},680);
  },7000);

  /* three.js patch backdrop */
  window.__editForge=function(){forge=1;};
  (function(){
    var canvas=document.getElementById('edit3d');if(!canvas||!window.THREE)return;
    var renderer=new THREE.WebGLRenderer({canvas:canvas,alpha:true,antialias:true});
    renderer.setPixelRatio(Math.min(devicePixelRatio,2));renderer.setSize(innerWidth,innerHeight);
    var scene=new THREE.Scene();scene.fog=new THREE.FogExp2(0x04090c,0.045);
    var camera=new THREE.PerspectiveCamera(58,innerWidth/innerHeight,.1,100);camera.position.set(0,0,24);

    var N=900,pos=new Float32Array(N*3),col=new Float32Array(N*3);
    var pal=[[0,1,.82],[.71,1,.24],[.7,.3,1],[1,.18,.42]];
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

    var key=keyGroup(0x00ffd0,.68);key.scale.setScalar(.78);scene.add(key);
    var shield=new THREE.Mesh(new THREE.IcosahedronGeometry(3.1,1),new THREE.MeshBasicMaterial({color:0xff2d6a,wireframe:true,transparent:true,opacity:.18}));
    shield.position.set(0,0,-4);scene.add(shield);
    var halo=new THREE.Mesh(new THREE.TorusGeometry(3.5,.05,8,72),new THREE.MeshBasicMaterial({color:0xb6ff3c,wireframe:true,transparent:true,opacity:.25}));
    halo.position.set(0,0,-3);scene.add(halo);
    var knot=new THREE.Mesh(new THREE.TorusKnotGeometry(1.1,.24,64,8),new THREE.MeshBasicMaterial({color:0xb44bff,wireframe:true,transparent:true,opacity:.22}));
    knot.position.set(7.5,3,-9);scene.add(knot);
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
      key.rotation.y=t*(.5+boost);
      key.rotation.x=Math.sin(t*.8)*(.22+boost*.08);
      key.rotation.z=Math.cos(t*.6)*.12;
      key.position.y=Math.sin(t*.9)*.32;
      key.scale.setScalar(.78+Math.sin(t*2.2)*.03+(forge?.16:0));
      shield.rotation.x=t*.18;shield.rotation.y=t*.24;
      halo.rotation.z=t*(.4+boost*.5);
      halo.rotation.x=Math.sin(t*.5)*.3;
      knot.rotation.x=t*.35;knot.rotation.y=t*.45;
      pts.rotation.y=t*.02;
      grid.position.z=(t*.55)%1.6;
      camera.position.x+=(mx*2.4-camera.position.x)*.045;
      camera.position.y+=(-my*1.6-camera.position.y)*.045;
      camera.position.z+=(((forge?13:24))-camera.position.z)*.03;
      camera.lookAt(0,0,0);
      renderer.render(scene,camera);
    })();
  })();

  /* submit -> patch animation -> real POST */
  var form=document.getElementById('editForm');
  var overlay=document.getElementById('editForge');
  var pct=document.getElementById('editPct');
  var submitting=false;
  if(form){
    form.addEventListener('submit',function(e){
      var btn=document.getElementById('editSubmit');
      if(btn&&btn.disabled){e.preventDefault();return;}
      if(submitting){e.preventDefault();return;}
      e.preventDefault();
      submitting=true;
      if(window.__editForge)window.__editForge();
      if(overlay){overlay.classList.add('on');overlay.setAttribute('aria-hidden','false');}
      var p=0;
      var pi=setInterval(function(){
        p=Math.min(100,p+6+Math.random()*9);
        if(pct)pct.textContent=Math.round(p)+'%';
        if(p>=100)clearInterval(pi);
      },70);
      setTimeout(function(){form.submit();},1100);
    });
  }

  /* level guards + enable submit on change */
  jQuery(function($){
    var level="<?= (int) $user->level ?>";
    if(level!=1)$('#registrator, #expired_date, #devices').attr('disabled',true);
    $(document).on('input change','#editForm input, #editForm select, #editForm textarea',function(){
      $('#editSubmit').prop('disabled',false);
    });
    var total="<?= (int) $key_info->total ?>";
    $('#max_devices').on('change',function(){
      var v=$(this).val();
      $('.maxDev').text(total+'/'+v);
      $('#devices').attr('rows',v);
    });
  });
})();
</script>
<?= $this->endSection() ?>
