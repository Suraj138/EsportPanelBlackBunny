<?= $this->extend('Layout/Starter') ?>

<?= $this->section('css') ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>
<style>
@property --dkAng{syntax:'<angle>';initial-value:0deg;inherits:false}
:root{--dk-cyan:#00ffd0;--dk-lime:#b6ff3c;--dk-rose:#ff2d6a;--dk-purple:#b44bff;--dk-gold:#ffb84d;--dk-ink:#e8f6ff;--dk-dim:#8aa3c2;--dk-line:rgba(0,255,208,.18)}
::selection{background:rgba(0,255,208,.35);color:#03110c}
body.dk-body{cursor:none}
@media(hover:none){body.dk-body{cursor:auto}}

/* boot overlay */
/* cursor */
#dkDot,#dkRing{position:fixed;top:0;left:0;pointer-events:none;z-index:9999;border-radius:50%;transform:translate(-50%,-50%)}
#dkDot{width:8px;height:8px;background:var(--dk-cyan);box-shadow:0 0 12px var(--dk-cyan)}
#dkRing{width:34px;height:34px;border:1px solid rgba(0,255,208,.5);transition:width .22s,height .22s,border-color .22s}
body.dk-hover #dkRing{width:54px;height:54px;border-color:var(--dk-lime)}
body.dk-down #dkRing{width:22px;height:22px;border-color:var(--dk-rose)}
@media(hover:none){#dkDot,#dkRing{display:none}}

#dk3d{position:fixed;inset:0;z-index:0;pointer-events:none}
.dk-wrap{position:relative;z-index:3;padding:18px 22px 56px!important;perspective:1600px}
.dk-torch{position:fixed;inset:0;z-index:2;pointer-events:none;opacity:.5;transition:opacity .3s;
  background:radial-gradient(340px circle at var(--tx,50%) var(--ty,30%),rgba(0,255,208,.08),transparent 70%)}

/* 3D reveal entrance */
.dk-reveal{opacity:0;transform:translateY(46px) rotateX(10deg) scale(.985);transform-origin:50% 0;transition:opacity .8s cubic-bezier(.2,.7,.3,1),transform .8s cubic-bezier(.2,.7,.3,1)}
.dk-reveal.in{opacity:1;transform:none}
.dk-reveal.d1{transition-delay:.08s}.dk-reveal.d2{transition-delay:.16s}

/* hero */
.dk-hero{position:relative;overflow:hidden;min-height:250px;margin:0 0 16px;padding:30px 34px;display:grid;grid-template-columns:1.42fr .58fr;align-items:center;gap:22px;
  border:1px solid rgba(0,255,208,.32);
  background:radial-gradient(460px 200px at 10% 0%,rgba(0,255,208,.16),transparent 60%),radial-gradient(420px 220px at 96% 100%,rgba(180,75,255,.14),transparent 62%),linear-gradient(135deg,rgba(4,12,24,.96),rgba(6,14,30,.92));
  transform-style:preserve-3d;transition:transform .18s ease-out;will-change:transform}
.dk-hero:after{content:'';position:absolute;left:-30%;top:0;width:28%;height:100%;background:linear-gradient(90deg,transparent,rgba(0,255,208,.12),transparent);animation:dkSweep 5.4s ease-in-out infinite;pointer-events:none}
@keyframes dkSweep{0%{left:-30%}55%,100%{left:130%}}
.dk-hero .dk-scangrid{position:absolute;inset:0;pointer-events:none;background:repeating-linear-gradient(180deg,transparent 0 12px,rgba(0,255,208,.035) 13px);animation:gridDrift 9s linear infinite}
.dk-wave{position:absolute;left:0;right:0;bottom:0;height:36px;display:flex;align-items:flex-end;gap:3px;opacity:.4;pointer-events:none;
  -webkit-mask-image:linear-gradient(90deg,transparent,#000 12%,#000 88%,transparent);mask-image:linear-gradient(90deg,transparent,#000 12%,#000 88%,transparent)}
.dk-wave span{flex:1;min-height:3px;background:linear-gradient(180deg,var(--dk-cyan),rgba(0,255,208,0));transform-origin:bottom;animation:dkWv 1s ease-in-out infinite alternate}
@keyframes dkWv{from{transform:scaleY(.12)}to{transform:scaleY(1)}}
.dk-kick{font-family:Orbitron,sans-serif;letter-spacing:.28em;font-size:11px;color:var(--dk-lime);margin-bottom:10px}
.dk-hero-title{display:flex;align-items:center;gap:16px;margin-bottom:8px}
.dk-hero h1{margin:0 0 10px;font-family:Orbitron,sans-serif;font-size:clamp(1.9rem,4.2vw,3.2rem);letter-spacing:.09em;line-height:1.04;color:var(--dk-ink)}
.dk-hero-title h1{margin:0}
.dk-hero h1 span{position:relative;display:inline-block;background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));-webkit-background-clip:text;background-clip:text;color:transparent;background-size:200%;animation:dkGrad 4s linear infinite;transition:text-shadow .2s}
.dk-hero h1:hover span{text-shadow:-2px 0 rgba(255,45,106,.8),2px 0 rgba(0,255,208,.8)}
.dk-hero h1 span:before,.dk-hero h1 span:after{content:attr(data-text);position:absolute;left:0;top:0;width:100%;background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));-webkit-background-clip:text;background-clip:text;color:transparent;background-size:200%;opacity:0;pointer-events:none}
.dk-hero h1 span:before{animation:dkGl1 3.6s infinite steps(1)}
.dk-hero h1 span:after{animation:dkGl2 3.6s infinite steps(1)}
@keyframes dkGl1{0%,91%,100%{opacity:0}92%{opacity:.85;transform:translate(-3px,-2px);clip-path:inset(0 0 55% 0)}95%{opacity:.85;transform:translate(3px,1px);clip-path:inset(45% 0 0 0)}97%{opacity:0}}
@keyframes dkGl2{0%,90%,100%{opacity:0}91%{opacity:.6;transform:translate(3px,2px);clip-path:inset(55% 0 0 0)}94%{opacity:.6;transform:translate(-2px,-1px);clip-path:inset(0 0 42% 0)}96%{opacity:0}}
@keyframes dkGrad{to{background-position:200%}}
.dk-type{max-width:560px;color:var(--dk-dim);min-height:26px;font-size:16px;margin:0 0 6px}
.dk-type .caret{display:inline-block;width:9px;background:var(--dk-cyan);margin-left:2px;animation:dkBlink .8s infinite}
@keyframes dkBlink{50%{opacity:0}}
.dk-clocks{display:flex;gap:30px;flex-wrap:wrap;margin-top:16px}
.dk-clocks small{display:block;letter-spacing:.2em;color:var(--dk-lime);font-size:10px;font-family:Orbitron,sans-serif}
.dk-clocks strong{display:block;font-family:Orbitron,sans-serif;font-size:18px;color:var(--dk-cyan);text-shadow:0 0 14px rgba(0,255,208,.4);transition:transform .25s,text-shadow .25s}
.dk-clocks div:hover strong{transform:translateY(-3px);text-shadow:0 0 22px rgba(0,255,208,.75)}
.dk-hero-cta{display:flex;gap:12px;flex-wrap:wrap;margin-top:20px}

/* ============ PLASMA / LASER BUTTONS ============ */
.dk-btn{font-family:Orbitron,sans-serif;font-size:11px;letter-spacing:.1em;padding:12px 20px;text-decoration:none;position:relative;overflow:hidden;border:1px solid rgba(0,255,208,.25);color:var(--dk-ink);background:rgba(3,10,20,.5);display:inline-flex;align-items:center;gap:8px;justify-content:center;
  transition:transform .18s cubic-bezier(.2,.7,.3,1),box-shadow .25s,border-color .2s,filter .2s,text-shadow .2s;cursor:none;will-change:transform}
@media(hover:none){.dk-btn{cursor:pointer}}
.dk-btn.fill{background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));color:#03110c;font-weight:700;border-color:transparent;
  box-shadow:0 6px 0 rgba(11,94,74,.65),0 12px 28px rgba(0,255,208,.22)}
.dk-btn:hover{transform:translateY(-3px) rotateX(9deg);box-shadow:0 16px 36px rgba(0,255,208,.32);border-color:var(--dk-cyan)}
.dk-btn.fill:hover{box-shadow:0 9px 0 rgba(11,94,74,.55),0 20px 42px rgba(0,255,208,.38)}
.dk-btn:active{transform:translateY(2px) scale(.97) rotateX(0)}
.dk-btn.fill:active{box-shadow:0 2px 0 rgba(11,94,74,.65),0 6px 16px rgba(0,255,208,.2)}
.dk-btn.pressing{transform:translateY(3px) scale(.96)!important}
.dk-btn:not(.fill):hover{text-shadow:-1.5px 0 rgba(255,45,106,.75),1.5px 0 rgba(0,255,208,.75)}
.dk-btn:not(.fill):before{content:'';position:absolute;inset:0;padding:1.5px;pointer-events:none;
  background:conic-gradient(from var(--dkAng),transparent 0 60%,rgba(0,255,208,.2) 70%,var(--dk-cyan) 78%,var(--dk-lime) 84%,transparent 92%);
  -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;
  mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);mask-composite:exclude;
  opacity:0;transition:opacity .25s}
.dk-btn:not(.fill):hover:before{opacity:1;animation:dkAngRot 1.9s linear infinite}
@keyframes dkAngRot{to{--dkAng:360deg}}
.dk-btn.fill:before{content:'';position:absolute;top:0;left:-80%;width:55%;height:100%;background:linear-gradient(100deg,transparent,rgba(255,255,255,.65),transparent);transform:skewX(-20deg);opacity:0;pointer-events:none}
.dk-btn.fill:hover:before{opacity:1;animation:dkLaser 1.5s ease-in-out infinite}
@keyframes dkLaser{0%{left:-80%}55%,100%{left:145%}}
.dk-btn.kv-mini{padding:9px 14px;font-size:10px}

/* orbit - 3D gyroscope + sonar */
.dk-orbit{position:relative;width:210px;height:210px;justify-self:end;display:grid;place-items:center;will-change:transform}
.dk-orbit .ring{position:absolute;border-radius:50%;border:1px solid rgba(0,255,208,.22);border-top-color:rgba(0,255,208,.85);border-bottom-color:rgba(0,255,208,.45)}
.dk-orbit .r1{inset:6%;animation:dkGyroX1 9s linear infinite}
.dk-orbit .r2{inset:20%;border-color:rgba(255,45,106,.25);border-top-color:rgba(255,45,106,.85);animation:dkGyroX2 6s linear infinite reverse}
.dk-orbit .r3{inset:34%;border-color:rgba(182,255,60,.25);border-top-color:rgba(182,255,60,.85);animation:dkGyroY1 4.5s linear infinite}
.dk-orbit .r4{inset:12%;border-color:rgba(180,75,255,.25);border-top-color:rgba(180,75,255,.85);animation:dkGyroY2 11s linear infinite reverse}
@keyframes dkGyroX1{from{transform:rotateX(68deg) rotateZ(0)}to{transform:rotateX(68deg) rotateZ(360deg)}}
@keyframes dkGyroX2{from{transform:rotateX(76deg) rotateZ(0)}to{transform:rotateX(76deg) rotateZ(360deg)}}
@keyframes dkGyroY1{from{transform:rotateY(74deg) rotateZ(0)}to{transform:rotateY(74deg) rotateZ(360deg)}}
@keyframes dkGyroY2{from{transform:rotateY(66deg) rotateZ(0)}to{transform:rotateY(66deg) rotateZ(360deg)}}
.dk-orbit .sonar{position:absolute;inset:26%;border-radius:50%;border:1px solid rgba(0,255,208,.55);opacity:0;animation:dkSonar 3.2s ease-out infinite;pointer-events:none}
.dk-orbit .sonar.s2{animation-delay:1.6s;border-color:rgba(182,255,60,.4)}
@keyframes dkSonar{0%{transform:scale(.35);opacity:.9}100%{transform:scale(1.55);opacity:0}}
.dk-orbit .sweep{position:absolute;inset:6%;border-radius:50%;background:conic-gradient(from 0deg,transparent 0 78%,rgba(0,255,208,.35) 88%,transparent 100%);animation:dkSpin 2.4s linear infinite;pointer-events:none;filter:blur(.4px)}
@keyframes dkSpin{to{transform:rotate(360deg)}}
.dk-orbit .core{width:74px;height:74px;display:grid;place-items:center;color:#031018;
  background:linear-gradient(135deg,var(--dk-cyan),var(--dk-lime));clip-path:polygon(50% 0,95% 25%,95% 75%,50% 100%,5% 75%,5% 25%);box-shadow:0 0 40px rgba(0,255,208,.4);
  animation:dkCoreWob 6s ease-in-out infinite,dkPulse 3s ease-in-out infinite}
.dk-orbit .core svg{width:32px;height:32px}
@keyframes dkCoreWob{0%,100%{transform:rotateY(-18deg) rotateX(6deg)}50%{transform:rotateY(18deg) rotateX(-6deg)}}
@keyframes dkPulse{50%{box-shadow:0 0 70px rgba(0,255,208,.7)}}
.dk-orbit small{position:absolute;bottom:16px;letter-spacing:.16em;font-size:9px;color:var(--dk-dim);font-family:Orbitron,sans-serif}

/* vault strip - 3D FLIP cards with sparkline back */
.dk-strip{display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:10px;margin:0 0 16px;perspective:1200px}
.dk-stat{position:relative;border:1px solid var(--dk-line);background:rgba(4,12,24,.92);transform-style:preserve-3d;transition:transform .65s cubic-bezier(.3,.7,.3,1),box-shadow .35s,border-color .3s}
.dk-stat:hover{transform:translateY(-5px) rotateY(180deg);border-color:rgba(0,255,208,.4);box-shadow:0 18px 44px rgba(0,255,208,.14)}
.dk-stat .ffront,.dk-stat .fback{display:flex;gap:11px;align-items:center;padding:15px 13px;backface-visibility:hidden;-webkit-backface-visibility:hidden}
.dk-stat .fback{position:absolute;inset:0;transform:rotateY(180deg);flex-direction:column;justify-content:center;gap:7px;background:linear-gradient(160deg,rgba(6,18,34,.99),rgba(4,12,26,.99));border:1px solid rgba(0,255,208,.45);box-shadow:inset 0 0 26px rgba(0,255,208,.09);overflow:hidden}
.dk-stat .fback small{font-size:8px;letter-spacing:.18em;color:var(--dk-dim);font-family:Orbitron,sans-serif}
.dk-stat .fback canvas{filter:drop-shadow(0 0 6px rgba(0,255,208,.45))}
.dk-stat i{display:block;width:8px;height:30px;background:var(--dk-cyan);box-shadow:0 0 10px var(--dk-cyan)}
.dk-stat i.lime{background:var(--dk-lime);box-shadow:0 0 10px var(--dk-lime)}
.dk-stat i.rose{background:var(--dk-rose);box-shadow:0 0 10px var(--dk-rose)}
.dk-stat i.gold{background:var(--dk-gold);box-shadow:0 0 10px var(--dk-gold)}
.dk-stat i.purple{background:var(--dk-purple);box-shadow:0 0 10px var(--dk-purple)}
.dk-stat small{display:block;font-size:9px;letter-spacing:.16em;color:var(--dk-dim);font-family:Orbitron,sans-serif;white-space:nowrap}
.dk-stat b{display:block;font-family:Orbitron,sans-serif;font-size:22px;color:var(--dk-cyan);text-shadow:0 0 14px rgba(0,255,208,.35);transition:color .3s,text-shadow .3s}
.dk-stat b.lime{color:var(--dk-lime);text-shadow:0 0 14px rgba(182,255,60,.35)}
.dk-stat b.rose{color:var(--dk-rose);text-shadow:0 0 14px rgba(255,45,106,.35)}
.dk-stat b.gold{color:var(--dk-gold);text-shadow:0 0 14px rgba(255,184,77,.35)}
.dk-stat b.purple{color:var(--dk-purple);text-shadow:0 0 14px rgba(180,75,255,.4)}

/* panel */
.dk-panel{position:relative;padding:18px;border:1px solid rgba(0,255,208,.22);background:linear-gradient(160deg,rgba(6,16,32,.96),rgba(4,10,20,.94));transition:box-shadow .3s,border-color .3s;will-change:transform}
.dk-panel:before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--dk-cyan),transparent);background-size:40% 100%;background-repeat:no-repeat;opacity:.75;animation:dkBeam 5s linear infinite}
@keyframes dkBeam{0%{background-position:-40% 0}100%{background-position:140% 0}}
.dk-panel:hover{box-shadow:0 22px 64px rgba(0,255,208,.12);border-color:rgba(0,255,208,.4)}
.dk-panel h2{margin:0;font-family:Orbitron,sans-serif;letter-spacing:.14em;font-size:12px;color:var(--dk-cyan)}
.dk-panel header{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin:0 0 14px;transition:transform .3s ease}
.dk-panel:hover header{transform:translateX(4px)}
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

/* vault panel scan layer (menu may overflow, so panel is visible) */
#kvPanel{overflow:visible}
#kvPanel:after{display:none}
.kv-clip{position:absolute;inset:0;overflow:hidden;pointer-events:none;z-index:1}
.kv-sweep{position:absolute;top:0;left:-45%;width:45%;height:100%;background:linear-gradient(90deg,transparent,rgba(0,255,208,.05),transparent);animation:dkSweep2 7s linear infinite}
@keyframes dkSweep2{to{left:120%}}
.kv-scan{position:absolute;left:0;right:0;top:0;height:110px;background:linear-gradient(180deg,transparent,rgba(0,255,208,.06) 42%,rgba(0,255,208,.15) 50%,rgba(0,255,208,.06) 58%,transparent);transform:translateY(-130px);animation:kvScan 6.5s cubic-bezier(.4,0,.6,1) infinite;mix-blend-mode:screen}
@keyframes kvScan{0%{transform:translateY(-130px)}72%,100%{transform:translateY(1400px)}}
.kv-tools{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.kv-tools .relative{position:relative}

/* ============ FILTER CHIPS - 3D ============ */
#key-filter-bar{display:flex;flex-wrap:wrap;gap:8px;margin:0 0 16px;perspective:600px}
#key-filter-bar .hud-chip{position:relative;overflow:hidden;font-family:Orbitron,sans-serif;font-size:10px;letter-spacing:.16em;padding:9px 16px;border:1px solid rgba(0,255,208,.25);background:rgba(3,10,20,.85);color:var(--dk-dim);cursor:none;transform-style:preserve-3d;transition:transform .2s cubic-bezier(.2,.7,.3,1),box-shadow .25s,color .2s,border-color .2s,text-shadow .2s}
@media(hover:none){#key-filter-bar .hud-chip{cursor:pointer}}
#key-filter-bar .hud-chip:before{content:'';position:absolute;inset:0;padding:1.5px;pointer-events:none;
  background:conic-gradient(from var(--dkAng),transparent 0 60%,rgba(0,255,208,.2) 70%,var(--dk-cyan) 78%,var(--dk-lime) 84%,transparent 92%);
  -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;
  mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);mask-composite:exclude;
  opacity:0;transition:opacity .25s}
#key-filter-bar .hud-chip:hover{color:var(--dk-ink);border-color:var(--dk-cyan);transform:translateY(-2px) rotateX(9deg);text-shadow:-1px 0 rgba(255,45,106,.7),1px 0 rgba(0,255,208,.7)}
#key-filter-bar .hud-chip:hover:before{opacity:1;animation:dkAngRot 1.9s linear infinite}
#key-filter-bar .hud-chip.is-on{background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));color:#03110c;border-color:transparent;font-weight:700;box-shadow:0 4px 0 rgba(11,94,74,.6),0 8px 22px rgba(0,255,208,.28);text-shadow:none}
#key-filter-bar .hud-chip.is-on:hover{transform:translateY(-2px)}
#key-filter-bar .hud-chip.is-on:after{content:'';position:absolute;top:0;left:-80%;width:55%;height:100%;background:linear-gradient(100deg,transparent,rgba(255,255,255,.55),transparent);transform:skewX(-20deg);animation:dkLaser 2.2s ease-in-out infinite;pointer-events:none}

#kvPanel header{position:relative;z-index:70}

/* ============ ACTIONS MENU - 3D flip-in ============ */
#actions-menu{position:absolute;right:0;margin-top:8px;width:264px;display:none;background:rgba(4,12,22,.97);border:1px solid rgba(0,255,208,.3);box-shadow:0 24px 60px rgba(0,0,0,.6),0 0 30px rgba(0,255,208,.08);z-index:60;backdrop-filter:blur(8px);transform-origin:top right}
#actions-menu.bb-open{display:block;animation:kvMenuIn .38s cubic-bezier(.2,.7,.3,1)}
@keyframes kvMenuIn{from{opacity:0;transform:perspective(600px) rotateX(-14deg) translateY(-10px) scale(.96)}to{opacity:1;transform:none}}
#actions-menu a{display:flex;align-items:center;gap:12px;padding:11px 16px;color:var(--dk-dim);font-family:Orbitron,sans-serif;font-size:10.5px;letter-spacing:.08em;text-decoration:none;position:relative;transition:transform .22s ease,background .22s,color .22s,border-color .22s;border-left:2px solid transparent}
#actions-menu a span{font-weight:500}
#actions-menu a svg{width:18px;height:18px;flex-shrink:0;transition:transform .25s,color .25s}
#actions-menu a:hover{color:var(--dk-ink);background:linear-gradient(90deg,rgba(0,255,208,.09),transparent);border-left-color:var(--dk-cyan);transform:translateX(4px)}
#actions-menu a:hover svg{transform:translateX(2px) scale(1.12);color:var(--dk-cyan)}
#actions-menu a.action-warn:hover{border-left-color:var(--dk-gold)}
#actions-menu a.action-warn:hover svg{color:var(--dk-gold)}
#actions-menu a.action-danger:hover{color:var(--dk-rose);border-left-color:var(--dk-rose)}
#actions-menu a.action-danger:hover svg{color:var(--dk-rose);filter:drop-shadow(0 0 6px rgba(255,45,106,.7))}
#actions-menu .border-t{border-color:rgba(0,255,208,.14)!important}

/* ============ TABLE - tactical grid ============ */
.keys-table-wrap{position:relative;overflow-x:auto;overflow-y:visible;z-index:2}
#datatable{width:100%!important;border-collapse:collapse;margin-bottom:0!important}
#datatable thead th{position:relative;padding:12px 14px;font-family:Orbitron,sans-serif;font-size:10px;letter-spacing:.18em;color:var(--dk-cyan)!important;text-transform:uppercase;background:rgba(0,255,208,.04);border-bottom:1px solid rgba(0,255,208,.35)!important;vertical-align:middle;white-space:nowrap}
#datatable thead th:before,#datatable thead th:after{display:none!important;background-image:none!important}
#datatable thead th.sorting:after{display:inline!important;content:'\21C5';font-size:9px;margin-left:6px;color:rgba(138,163,194,.5)}
#datatable thead th.sorting_asc:after{display:inline!important;content:'\25B2';font-size:8px;margin-left:6px;color:var(--dk-lime)}
#datatable thead th.sorting_desc:after{display:inline!important;content:'\25BC';font-size:8px;margin-left:6px;color:var(--dk-lime)}
#datatable tbody td{padding:11px 14px;border-bottom:1px solid rgba(0,255,208,.08);color:var(--dk-ink);font-size:13px;vertical-align:middle}
#datatable tbody tr{transition:background .25s,box-shadow .25s,transform .25s}
#datatable tbody tr:hover{background:linear-gradient(90deg,rgba(0,255,208,.07),rgba(0,255,208,.01) 65%,transparent);box-shadow:inset 3px 0 0 var(--dk-cyan),inset 0 0 24px rgba(0,255,208,.05);transform:translateX(5px)}
#datatable tbody tr.row-in{animation:dkRowIn .5s cubic-bezier(.2,.7,.3,1) both;animation-delay:calc(var(--ri,0)*.045s)}
@keyframes dkRowIn{from{opacity:0;transform:perspective(700px) rotateX(-14deg) translateY(12px)}to{opacity:1;transform:none}}
#datatable tbody tr.ping{animation:dkPing .9s ease-out}
@keyframes dkPing{0%{background:rgba(0,255,208,.16);box-shadow:inset 0 0 30px rgba(0,255,208,.2)}100%{background:transparent}}
table.dataTable.no-footer{border-bottom:1px solid rgba(0,255,208,.2)!important}

/* key codes */
.keys-table-wrap code.keyBlur{font-family:'Share Tech Mono',monospace;font-size:12px;white-space:nowrap;padding:3px 8px;border:1px solid rgba(0,255,208,.22);background:rgba(0,255,208,.05);border-radius:3px;letter-spacing:.06em;transition:filter .35s,box-shadow .25s,border-color .25s;display:inline-block}
.keys-table-wrap code.keyBlur.text-success{color:var(--dk-lime);border-color:rgba(182,255,60,.3)}
.keys-table-wrap code.keyBlur.text-danger{color:var(--dk-rose);border-color:rgba(255,45,106,.3)}
.keys-table-wrap code.keyBlur:hover{box-shadow:0 0 12px rgba(0,255,208,.25)}
.key-sensi{filter:blur(6px);user-select:none}

/* chips + badges inside table */
.keys-table-wrap .hud-chip{font-family:'Share Tech Mono',monospace;font-size:10px;letter-spacing:.1em;padding:2px 8px;border:1px solid rgba(0,255,208,.25);background:rgba(0,255,208,.05);color:var(--dk-dim);border-radius:2px;display:inline-block}
.keys-table-wrap .badge{font-family:Orbitron,sans-serif;font-size:9.5px;letter-spacing:.1em;padding:4px 9px;background:rgba(255,184,77,.12);color:var(--dk-gold);border:1px solid rgba(255,184,77,.4);border-radius:2px}
.keys-table-wrap .muted{color:var(--dk-dim)}
.dk-panel p.muted{color:var(--dk-dim);font-family:'Share Tech Mono',monospace;letter-spacing:.14em}

/* row action buttons - cyber override */
.keys-table-wrap .btn-sm{font-family:Orbitron,sans-serif;font-size:9px;letter-spacing:.08em;padding:4px 9px;border-width:1px;border-radius:2px;background:transparent;position:relative;overflow:hidden;transition:transform .18s cubic-bezier(.2,.7,.3,1),box-shadow .25s,background .2s,color .2s,border-color .2s;cursor:pointer}
.keys-table-wrap .btn-sm:active{transform:translateY(1px) scale(.96)}
.keys-table-wrap .btn-sm:hover{transform:translateY(-2px)}
.keys-table-wrap .btn-outline-danger{color:var(--dk-rose);border-color:rgba(255,45,106,.55)}
.keys-table-wrap .btn-outline-danger:hover{background:var(--dk-rose);border-color:var(--dk-rose);color:#160309;box-shadow:0 6px 18px rgba(255,45,106,.45)}
.keys-table-wrap .btn-outline-warning{color:var(--dk-gold);border-color:rgba(255,184,77,.55)}
.keys-table-wrap .btn-outline-warning:hover{background:var(--dk-gold);border-color:var(--dk-gold);color:#1c1103;box-shadow:0 6px 18px rgba(255,184,77,.45)}
.keys-table-wrap .btn-outline-info{color:var(--dk-cyan);border-color:rgba(0,255,208,.5)}
.keys-table-wrap .btn-outline-info:hover{background:var(--dk-cyan);border-color:var(--dk-cyan);color:#03110c;box-shadow:0 6px 18px rgba(0,255,208,.45)}
.keys-table-wrap .btn-outline-success{color:var(--dk-lime);border-color:rgba(182,255,60,.5)}
.keys-table-wrap .btn-outline-success:hover{background:var(--dk-lime);border-color:var(--dk-lime);color:#0c1301;box-shadow:0 6px 18px rgba(182,255,60,.45)}
.keys-table-wrap .btn-outline-primary{color:var(--dk-purple);border-color:rgba(180,75,255,.55)}
.keys-table-wrap .btn-outline-primary:hover{background:var(--dk-purple);border-color:var(--dk-purple);color:#0f0418;box-shadow:0 6px 18px rgba(180,75,255,.45)}
.keys-table-wrap .btn-sm:focus{box-shadow:0 0 0 2px rgba(0,255,208,.25)!important;outline:none}

/* ============ DATATABLES CONTROLS ============ */
.dataTables_wrapper{padding-top:6px}
.dataTables_wrapper label{color:var(--dk-dim);font-family:'Share Tech Mono',monospace;font-size:11px;letter-spacing:.08em}
.dataTables_wrapper .dataTables_length select,.dataTables_wrapper .dataTables_filter input{background:rgba(4,12,24,.9)!important;border:1px solid rgba(0,255,208,.25)!important;color:var(--dk-ink)!important;font-family:'Share Tech Mono',monospace;font-size:12px;padding:6px 10px;transition:border-color .25s,box-shadow .25s;height:auto}
.dataTables_wrapper .dataTables_filter input{margin-left:8px}
.dataTables_wrapper .dataTables_length select:focus,.dataTables_wrapper .dataTables_filter input:focus{border-color:var(--dk-cyan)!important;box-shadow:0 0 14px rgba(0,255,208,.3)!important;outline:none}
.dataTables_wrapper .dataTables_filter{padding-top:2px}
.dataTables_wrapper .dataTables_info{color:var(--dk-dim)!important;font-family:'Share Tech Mono',monospace;font-size:11px;letter-spacing:.1em;padding-top:12px}
.dataTables_wrapper .dataTables_processing{background:rgba(3,10,18,.94)!important;border:1px solid rgba(0,255,208,.4)!important;color:var(--dk-cyan)!important;font-family:'Share Tech Mono',monospace;letter-spacing:.2em;font-size:11px;box-shadow:0 0 30px rgba(0,255,208,.25)!important;z-index:40;top:52%}
.dk-proc:after{content:'';display:inline-block;width:1.6em;text-align:left;animation:dkDots 1.2s steps(1) infinite;color:var(--dk-lime)}
@keyframes dkDots{0%{content:''}25%{content:'.'}50%{content:'..'}75%{content:'...'}}
.dataTables_wrapper .pagination{margin:0;flex-wrap:wrap}
.dataTables_wrapper .page-link{background:rgba(4,12,24,.9)!important;border:1px solid rgba(0,255,208,.25)!important;color:var(--dk-dim)!important;font-family:'Share Tech Mono',monospace;font-size:11px;padding:6px 12px;transition:all .2s}
.dataTables_wrapper .page-link:hover{color:var(--dk-cyan)!important;border-color:var(--dk-cyan)!important}
.dataTables_wrapper .page-item.active .page-link{background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime))!important;color:#03110c!important;border-color:transparent!important;box-shadow:0 0 14px rgba(0,255,208,.4)}
.dataTables_wrapper .page-item.disabled .page-link{opacity:.35;background:transparent!important}
.dataTables_wrapper .dataTables_paginate{padding-top:12px}

/* wave-circle: shockwave + ripple */
.dk-shock{position:fixed;width:10px;height:10px;border:2px solid rgba(0,255,208,.75);border-radius:50%;pointer-events:none;z-index:9997;transform:translate(-50%,-50%);box-shadow:0 0 18px rgba(0,255,208,.5);animation:dkShock .55s cubic-bezier(.2,.7,.3,1) forwards}
@keyframes dkShock{0%{width:10px;height:10px;opacity:1;border-width:2px}100%{width:150px;height:150px;opacity:0;border-width:1px}}
.ripple{position:absolute;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.5),rgba(0,255,208,.25) 40%,transparent 70%);pointer-events:none;transform:translate(-50%,-50%) scale(0);animation:dkRip .6s ease-out forwards;z-index:5}
@keyframes dkRip{from{transform:translate(-50%,-50%) scale(0);opacity:.7}to{transform:translate(-50%,-50%) scale(1);opacity:0}}

@media (max-width:1100px){.dk-strip{grid-template-columns:repeat(3,minmax(0,1fr))}}
@media (max-width:980px){
  .dk-hero{grid-template-columns:1fr;padding:24px}
  .dk-orbit{justify-self:center;margin-top:10px}
  .dk-strip{grid-template-columns:repeat(2,minmax(0,1fr))}
  #datatable tbody tr:hover{transform:none}
  .dk-panel:hover header{transform:none}
}
@media (prefers-reduced-motion:reduce){*{animation-duration:.001ms!important;animation-iteration-count:1!important;transition-duration:.001ms!important}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= view('Layout/WelcomeSplash', ['spKey' => 'bb_splash_keys', 'spSub' => 'T A C T I C A L   V A U L T']) ?>
<canvas id="dk3d"></canvas>
<div class="dk-torch" id="dkTorch"></div>
<div id="dkDot"></div><div id="dkRing"></div>


<div class="dk-wrap">
    <div class="mb-3"><?= $this->include('Layout/msgStatus') ?></div>

    <section class="dk-hero dk-reveal" id="dkHero">
        <div class="dk-scangrid"></div>
        <div class="dk-wave" id="dkWave" aria-hidden="true"></div>
        <div id="dkHeroCopy">
            <div class="dk-kick">LOCKER &middot; TACTICAL VAULT</div>
            <div class="dk-hero-title">
                <?= view('Layout/HexBadge', ['hbSize' => 58]) ?>
                <h1>REGISTERED <span data-text="KEYS">KEYS</span></h1>
            </div>
            <p class="dk-type"><span id="dkTyped"></span><span class="caret">&nbsp;</span></p>
            <div class="dk-clocks">
                <div><small>VAULT CLOCK</small><strong id="lobbyClock">--</strong></div>
                <div><small>SYNC DRAWS</small><strong id="dkDraw">000</strong></div>
                <div><small>EYE SHIELD</small><strong id="dkShieldHero" style="color:var(--dk-lime)">ON</strong></div>
            </div>
            <div class="dk-hero-cta">
                <a class="dk-btn fill" href="<?= site_url('keys/generate') ?>">GENERATE KEY</a>
                <a class="dk-btn" href="<?= site_url('keys/download') ?>">DOWNLOAD ALL</a>
            </div>
        </div>
        <div class="dk-orbit" id="dkOrbit" aria-hidden="true">
            <span class="ring r1"></span>
            <span class="ring r2"></span>
            <span class="ring r3"></span>
            <span class="ring r4"></span>
            <span class="sonar"></span>
            <span class="sonar s2"></span>
            <span class="sweep"></span>
            <span class="core"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg></span>
            <small>VAULT CORE</small>
        </div>
    </section>

    <div class="dk-strip dk-reveal d1">
        <article class="dk-stat"><div class="ffront"><i></i><div><small>TOTAL KEYS</small><b id="vtTotal">&mdash;</b></div></div><div class="fback"><canvas width="86" height="30" data-c="cyan"></canvas><small>VAULT &middot; LIVE</small></div></article>
        <article class="dk-stat"><div class="ffront"><i class="lime"></i><div><small>MATCHED</small><b class="lime" id="vtMatch">&mdash;</b></div></div><div class="fback"><canvas width="86" height="30" data-c="lime"></canvas><small>FILTER HIT &middot; LIVE</small></div></article>
        <article class="dk-stat"><div class="ffront"><i class="gold"></i><div><small>PAGE BOUND</small><b class="gold" id="vtPage">&mdash;</b></div></div><div class="fback"><canvas width="86" height="30" data-c="gold"></canvas><small>HWID LOCKED &middot; PAGE</small></div></article>
        <article class="dk-stat"><div class="ffront"><i class="rose"></i><div><small>EYE SHIELD</small><b id="vtShield" style="color:var(--dk-lime)">ON</b></div></div><div class="fback"><canvas width="86" height="30" data-c="rose"></canvas><small>KEY BLUR STATE</small></div></article>
        <article class="dk-stat"><div class="ffront"><i class="purple"></i><div><small>FILTER</small><b class="purple" id="vtFilter">ALL</b></div></div><div class="fback"><canvas width="86" height="30" data-c="purple"></canvas><small>ACTIVE LANE</small></div></article>
    </div>

    <section class="dk-panel dk-reveal d2" id="kvPanel">
        <div class="kv-clip"><span class="kv-sweep"></span><span class="kv-scan"></span></div>
        <header>
            <span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>KEYS REGISTERED</h2><em id="kvMeta">SYNCING VAULT&hellip;</em></span>
            <div class="kv-tools">
                <button id="blur-out" class="dk-btn kv-mini">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    </svg>
                    Eye Protect
                </button>
                <div class="relative">
                    <button id="actions-menu-btn" class="dk-btn kv-mini">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                        <span>Actions</span>
                    </button>

                    <div id="actions-menu" class="hidden absolute right-0 mt-2 w-64 rounded-xl shadow-2xl z-50">
                        <div class="py-2">
                            <a href="<?= site_url('keys/download') ?>" class="flex items-center space-x-3 px-4 py-3">
                                <span class="font-medium">Download All Keys .txt</span>
                            </a>
                            <a href="<?= site_url('keys/download/unused') ?>" class="flex items-center space-x-3 px-4 py-3">
                                <span class="font-medium">Download Unused .txt</span>
                            </a>
                            <a href="javascript:void(0)" onclick="copyUnusedKeys()" class="flex items-center space-x-3 px-4 py-3">
                                <span class="font-medium">Copy Unused Keys</span>
                            </a>
                            <a href="<?= site_url('keys/generate') ?>" class="flex items-center space-x-3 px-4 py-3">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="font-medium">Generate Key</span>
                            </a>
                            <a href="javascript:void(0)" onclick="confirmResetAllKeys()" class="flex items-center space-x-3 px-4 py-3 action-warn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                <span class="font-medium">Reset All Keys</span>
                            </a>

                            <div class="border-t my-2"></div>

                            <a href="<?= site_url('keys/deleteExp') ?>" class="flex items-center space-x-3 px-4 py-3 action-danger">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                <span class="font-medium">Delete Expired Keys</span>
                            </a>

                            <a href="<?= site_url('keys/deleteUnused') ?>" class="flex items-center space-x-3 px-4 py-3 action-warn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <span class="font-medium">Delete Unused Keys</span>
                            </a>

                            <a href="javascript:void(0)" onclick="confirmDeleteAllKeys()" class="flex items-center space-x-3 px-4 py-3 action-danger">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16M10 11v6m4-6v6"></path>
                                </svg>
                                <span class="font-medium">Delete All Keys</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="key-filter-bar" id="key-filter-bar">
            <button type="button" class="hud-chip is-on" data-filter="">ALL</button>
            <button type="button" class="hud-chip" data-filter="used">USED</button>
            <button type="button" class="hud-chip" data-filter="unused">UNUSED</button>
            <button type="button" class="hud-chip" data-filter="live">LIVE</button>
            <button type="button" class="hud-chip" data-filter="expired">EXPIRED</button>
        </div>

        <?php if (!empty($keylist)) : ?>
            <div class="overflow-x-auto keys-table-wrap">
                <table id="datatable" class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Game</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">User Keys</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Operator</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Devices</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Duration</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Expired</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php else : ?>
            <p class="text-center muted py-8">No keys to show.</p>
        <?php endif; ?>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>
<script>
(function(){
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  document.body.classList.add('dk-body');

  /* ---------- custom cursor + torch ---------- */
  var dot=document.getElementById('dkDot'),ring=document.getElementById('dkRing'),torch=document.getElementById('dkTorch');
  var cx=innerWidth/2,cy=innerHeight/2,rx=cx,ry=cy;
  addEventListener('mousemove',function(e){cx=e.clientX;cy=e.clientY;dot.style.left=cx+'px';dot.style.top=cy+'px';
    torch.style.setProperty('--tx',cx+'px');torch.style.setProperty('--ty',cy+'px');});
  addEventListener('mousedown',function(){document.body.classList.add('dk-down')});
  addEventListener('mouseup',function(){document.body.classList.remove('dk-down')});
  (function cur(){rx+=(cx-rx)*.16;ry+=(cy-ry)*.16;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(cur);})();
  document.addEventListener('mouseover',function(e){
    var t=e.target&&e.target.closest?e.target.closest('a,button,input,select,label,code'):null;
    document.body.classList.toggle('dk-hover',!!t);
  });

  /* ---------- inject glare + corner brackets + circuit trace ---------- */
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
    var hEl=document.getElementById('dkHero');if(hEl)addTrace(hEl,'#b6ff3c');
  })();

  /* ---------- glare tracker on vault panel ---------- */
  var kvP=document.getElementById('kvPanel');
  if(kvP)kvP.addEventListener('mousemove',function(e){
    var r=kvP.getBoundingClientRect();
    kvP.style.setProperty('--gx',((e.clientX-r.left)/r.width*100)+'%');
    kvP.style.setProperty('--gy',((e.clientY-r.top)/r.height*100)+'%');
  });

  /* ---------- hacker decode ---------- */
  var chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789#$%&@';
  function decode(el){
    if(reduce)return;
    var orig=el.dataset.orig||(el.dataset.orig=el.textContent);
    var frame=0,len=orig.length,total=Math.max(14,len*2);
    clearInterval(el._dkDec);
    el._dkDec=setInterval(function(){
      frame++;
      var done=Math.floor((frame/total)*len),out=orig.slice(0,done);
      for(var i=done;i<len;i++)out+=orig[i]===' '?' ':chars[(Math.random()*chars.length)|0];
      el.textContent=out;
      if(done>=len){el.textContent=orig;clearInterval(el._dkDec)}
    },28);
  }
  window.dkDecode=function(el){decode(el)};
  window.dkDecodeKeys=function(){
    document.querySelectorAll('#datatable tbody .keyBlur').forEach(function(c,i){
      setTimeout(function(){decode(c)},i*45);
    });
  };
  document.querySelectorAll('.dk-panel h2,.dk-kick').forEach(function(h){setTimeout(function(){decode(h)},400+Math.random()*600)});
  if(kvP)kvP.addEventListener('mouseenter',function(){var h=kvP.querySelector('h2');if(h)decode(h)});

  /* ---------- hero audio wave ---------- */
  (function(){
    var wave=document.getElementById('dkWave');if(!wave||reduce)return;
    for(var i=0;i<44;i++){
      var s=document.createElement('span');
      s.style.animationDuration=(.45+Math.random()*.95).toFixed(2)+'s';
      s.style.animationDelay=(-Math.random()).toFixed(2)+'s';
      s.style.height=(6+Math.random()*26)+'px';
      if(i%7===0)s.style.background='linear-gradient(180deg,var(--dk-lime),rgba(182,255,60,0))';
      wave.appendChild(s);
    }
  })();

  /* ---------- vault strip sparklines ---------- */
  (function(){
    var cols={cyan:'#00ffd0',lime:'#b6ff3c',rose:'#ff2d6a',gold:'#ffb84d',purple:'#b44bff'};
    document.querySelectorAll('.dk-stat').forEach(function(card){
      var cv=card.querySelector('.fback canvas');if(!cv)return;
      var bar=card.querySelector('.ffront i');
      var cls=bar&&bar.className?bar.className:'cyan';
      var color=cols[cls]||cols.cyan;
      var ctx=cv.getContext('2d'),N=26,pts=[],i;
      for(i=0;i<N;i++)pts.push(.2+Math.random()*.6);
      setInterval(function(){
        pts.push(Math.max(.08,Math.min(.95,pts[pts.length-1]+(Math.random()-.5)*.3)));
        pts.shift();
        var w=cv.width,h=cv.height;
        ctx.clearRect(0,0,w,h);
        ctx.beginPath();
        pts.forEach(function(p,j){var x=j/(N-1)*w,y=h-p*.92*h;j?ctx.lineTo(x,y):ctx.moveTo(x,y)});
        ctx.strokeStyle=color;ctx.lineWidth=1.6;ctx.shadowColor=color;ctx.shadowBlur=6;ctx.stroke();
        ctx.fillStyle='#fff';ctx.shadowBlur=9;
        ctx.beginPath();ctx.arc(w-1.5,h-pts[N-1]*.92*h,1.9,0,7);ctx.fill();
      },150);
    });
  })();

  /* ---------- hero tilt + layered parallax ---------- */
  var hero=document.getElementById('dkHero'),heroCopy=document.getElementById('dkHeroCopy'),orbit=document.getElementById('dkOrbit');
  if(hero)addEventListener('mousemove',function(e){
    if(reduce||innerWidth<980)return;
    var x=e.clientX/innerWidth-.5,y=e.clientY/innerHeight-.5;
    hero.style.transform='perspective(1200px) rotateY('+(x*4)+'deg) rotateX('+(-y*3)+'deg)';
    if(heroCopy)heroCopy.style.transform='translate('+(x*-9)+'px,'+(y*-6)+'px)';
    if(orbit)orbit.style.transform='translate('+(x*14)+'px,'+(y*9)+'px)';
  });

  /* ---------- magnetic buttons + 3D press ---------- */
  document.querySelectorAll('.dk-btn').forEach(function(b){
    b.addEventListener('mousemove',function(e){
      if(reduce||innerWidth<980)return;
      var r=b.getBoundingClientRect(),x=e.clientX-r.left-r.width/2,y=e.clientY-r.top-r.height/2;
      b.style.transform='translate('+(x*.18)+'px,'+(y*.24-2)+'px)';
    });
    b.addEventListener('mouseleave',function(){b.style.transform='';b.classList.remove('pressing')});
    b.addEventListener('mousedown',function(){b.classList.add('pressing')});
    b.addEventListener('mouseup',function(){b.classList.remove('pressing')});
  });

  /* ---------- wave-circle tap: shockwave + ripple (no fire burst) ---------- */
  function shock(x,y){
    var s=document.createElement('span');s.className='dk-shock';
    s.style.left=x+'px';s.style.top=y+'px';
    document.body.appendChild(s);setTimeout(function(){s.remove()},620);
  }
  window.dkShockAt=function(el){
    if(reduce||!el)return;
    var r=el.getBoundingClientRect();
    shock(r.left+r.width/2,r.top+r.height/2);
  };
  document.addEventListener('click',function(e){
    if(reduce)return;
    var t=e.target&&e.target.closest?e.target.closest('.dk-btn,.keys-table-wrap .btn,.hud-chip,#actions-menu a'):null;
    if(!t)return;
    shock(e.clientX,e.clientY);
    var r=t.getBoundingClientRect(),s=document.createElement('span');
    s.className='ripple';s.style.cssText+='width:'+Math.max(r.width,r.height)+'px;height:'+Math.max(r.width,r.height)+'px;left:'+(e.clientX-r.left)+'px;top:'+(e.clientY-r.top)+'px';
    t.style.position='relative';t.style.overflow='hidden';t.appendChild(s);setTimeout(function(){s.remove()},650);
  });

  /* ---------- cyan spark burst on wrap clicks ---------- */
  var wrapEl=document.querySelector('.dk-wrap');
  if(wrapEl)wrapEl.addEventListener('click',function(e){
    if(reduce)return;
    for(var i=0;i<10;i++){
      var s=document.createElement('span'),sz=2+Math.random()*4,cl=Math.random()>.5?'#00ffd0':'#b6ff3c';
      s.style.cssText='position:fixed;z-index:9998;border-radius:50%;pointer-events:none;width:'+sz+'px;height:'+sz+'px;left:'+e.clientX+'px;top:'+e.clientY+'px;background:'+cl+';box-shadow:0 0 6px '+cl;
      document.body.appendChild(s);
      var a=Math.random()*Math.PI*2,d=22+Math.random()*48,el=s;
      el.animate([{transform:'translate(0,0) scale(1)',opacity:1},{transform:'translate('+(Math.cos(a)*d)+'px,'+(Math.sin(a)*d)+'px) scale(.2)',opacity:0}],{duration:420+Math.random()*280,easing:'cubic-bezier(.2,.7,.3,1)'}).onfinish=function(){el.remove()};
    }
  });

  /* ---------- random neon flicker ---------- */
  setInterval(function(){
    if(reduce)return;
    var ps=document.querySelectorAll('.dk-panel');if(!ps.length)return;
    var p=ps[(Math.random()*ps.length)|0];
    p.classList.add('flick');setTimeout(function(){p.classList.remove('flick')},680);
  },7000);

  /* ---------- three.js 3D backdrop - KEY FLEET ---------- */
  (function(){
    var canvas=document.getElementById('dk3d');if(!canvas||!window.THREE)return;
    var renderer=new THREE.WebGLRenderer({canvas:canvas,alpha:true,antialias:true});
    renderer.setPixelRatio(Math.min(devicePixelRatio,2));renderer.setSize(innerWidth,innerHeight);
    var scene=new THREE.Scene();scene.fog=new THREE.FogExp2(0x04090c,0.05);
    var camera=new THREE.PerspectiveCamera(60,innerWidth/innerHeight,.1,100);camera.position.set(0,0,34);

    /* particle starfield */
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

    /* wireframe key builders */
    function makeKey(color,op){
      var mat=new THREE.MeshBasicMaterial({color:color,wireframe:true,transparent:true,opacity:op});
      var g=new THREE.Group();
      var ring=new THREE.Mesh(new THREE.TorusGeometry(.72,.2,8,18),mat);ring.position.x=-1.15;
      var shaft=new THREE.Mesh(new THREE.CylinderGeometry(.16,.16,2.2,6),mat);shaft.rotation.z=Math.PI/2;shaft.position.x=.55;
      var t1=new THREE.Mesh(new THREE.BoxGeometry(.42,.4,.26),mat);t1.position.set(1.25,-.4,0);
      var t2=new THREE.Mesh(new THREE.BoxGeometry(.3,.52,.26),mat);t2.position.set(.7,-.5,0);
      g.add(ring);g.add(shaft);g.add(t1);g.add(t2);
      return g;
    }

    var m1=new THREE.MeshBasicMaterial({color:0x00ffd0,wireframe:true,transparent:true,opacity:.22});
    var m2=new THREE.MeshBasicMaterial({color:0xb44bff,wireframe:true,transparent:true,opacity:.16});
    var m3=new THREE.MeshBasicMaterial({color:0xffb84d,wireframe:true,transparent:true,opacity:.14});
    var m4=new THREE.MeshBasicMaterial({color:0xff2d6a,wireframe:true,transparent:true,opacity:.16});
    var fleet=[
      {m:makeKey(0x00ffd0,.5),p:[-6.5,2.2,-5],k:1},
      {m:makeKey(0xb6ff3c,.42),p:[6.2,-2.2,-7],k:1},
      {m:makeKey(0xb44bff,.42),p:[.5,3.6,-10],k:1},
      {m:new THREE.Mesh(new THREE.IcosahedronGeometry(2.4,1),m1),p:[-9.5,0,-8]},
      {m:new THREE.Mesh(new THREE.TorusKnotGeometry(1.3,.32,60,8),m2),p:[9,3,-9]},
      {m:new THREE.Mesh(new THREE.OctahedronGeometry(1.5,0),m4),p:[8.8,-3.4,-5]},
      {m:new THREE.Mesh(new THREE.TorusGeometry(5.8,.14,8,64),m3),p:[0,-1,-17]}
    ];
    fleet.forEach(function(o,i){o.m.position.set(o.p[0],o.p[1],o.p[2]);o.m.scale.setScalar(.0001);scene.add(o.m)});

    /* holo globe + grid */
    var globe=new THREE.Mesh(new THREE.IcosahedronGeometry(4.2,2),new THREE.MeshBasicMaterial({color:0x00ffd0,wireframe:true,transparent:true,opacity:.08}));
    globe.position.set(0,0,-20);scene.add(globe);
    var grid=new THREE.GridHelper(72,46,0x00ffd0,0x0a2a22);grid.material.transparent=true;grid.material.opacity=.32;grid.position.y=-8;scene.add(grid);

    var mx=0,my=0;
    addEventListener('mousemove',function(e){mx=(e.clientX/innerWidth-.5)*2;my=(e.clientY/innerHeight-.5)*2});
    addEventListener('resize',function(){camera.aspect=innerWidth/innerHeight;camera.updateProjectionMatrix();renderer.setSize(innerWidth,innerHeight)});
    function ez(x){var c4=(2*Math.PI)/3;return x<=0?0:x>=1?1:Math.pow(2,-10*x)*Math.sin((x*10-.75)*c4)+1}
    if(reduce){fleet.forEach(function(o){o.m.scale.setScalar(1)});camera.position.z=15;renderer.render(scene,camera);return;}
    var clock=new THREE.Clock();
    (function loop(){
      requestAnimationFrame(loop);
      var t=clock.getElapsedTime();
      var warp=Math.min(1,t/1.8),we=1-Math.pow(1-warp,3);
      camera.position.z=34-19*we;
      pts.rotation.y=t*.02;
      pts.material.opacity=.68+Math.sin(t*2.1)*.18;
      fleet.forEach(function(o,i){
        var s=ez((t-i*.14)/1.5);o.m.scale.setScalar(Math.max(.0001,s));
        if(o.k){o.m.rotation.y=t*.5+i;o.m.rotation.z=Math.sin(t*.7+i*1.3)*.35;}
        else{o.m.rotation.x=t*(.2+i*.07);o.m.rotation.y=t*(.25+i*.05);o.m.rotation.z=t*(.06+i*.015);}
        o.m.position.y=o.p[1]+Math.sin(t*.8+i*1.7)*.55;
      });
      globe.rotation.y=t*.06;globe.rotation.x=Math.sin(t*.12)*.16;
      grid.position.z=(t*.6)%1.57;
      camera.position.x+=(mx*1.6-camera.position.x)*.04;
      camera.position.y+=(-my*1.2-camera.position.y)*.04;
      camera.lookAt(0,0,0);
      camera.rotation.z+=Math.sin(t*.12)*.012;
      renderer.render(scene,camera);
    })();
  })();

  /* ---------- typewriter ---------- */
  var phrases=['Every license in the arena. Blur, reset, share.','HWID-locked keys. One owner per device.','Filter the vault. Drop, copy or wipe in seconds.'];
  var typed=document.getElementById('dkTyped'),pi=0,ci=0,del=false;
  (function type(){
    if(!typed)return;
    var cur=phrases[pi];
    typed.textContent=del?cur.slice(0,--ci):cur.slice(0,++ci);
    if(!del&&ci===cur.length){del=true;return setTimeout(type,2400)}
    if(del&&ci===0){del=false;pi=(pi+1)%phrases.length}
    setTimeout(type,del?24:48);
  })();

  /* ---------- 3D reveal ---------- */
  var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target)}})},{threshold:.1});
  document.querySelectorAll('.dk-reveal').forEach(function(el){io.observe(el)});

  /* ---------- vault clock ---------- */
  function lobby(){var n=new Date(),p=function(v){return(v<10?'0':'')+v},el=document.getElementById('lobbyClock');if(el)el.textContent=p(n.getHours())+':'+p(n.getMinutes())+':'+p(n.getSeconds());}
  lobby();setInterval(lobby,1000);

})();
</script>
<script>
(function(){
  var actionsBtn=document.getElementById('actions-menu-btn');
  var actionsMenu=document.getElementById('actions-menu');
  if(actionsBtn&&actionsMenu){
    actionsBtn.addEventListener('click',function(){
      actionsMenu.classList.toggle('hidden');
      actionsMenu.classList.toggle('bb-open');
    });
    document.addEventListener('click',function(e){
      if(!actionsBtn.contains(e.target)&&!actionsMenu.contains(e.target)){
        actionsMenu.classList.add('hidden');
        actionsMenu.classList.remove('bb-open');
      }
    });
  }

  var shieldOff=false;
  function kvSet(id,v){var el=document.getElementById(id);if(el)el.textContent=v;}
  function setShield(on){
    ['vtShield','dkShieldHero'].forEach(function(id){
      var el=document.getElementById(id);if(!el)return;
      el.textContent=on?'ON':'OFF';
      el.style.color=on?'var(--dk-lime)':'var(--dk-gold)';
      el.style.textShadow=on?'0 0 14px rgba(182,255,60,.35)':'0 0 14px rgba(255,184,77,.35)';
    });
  }
  function kvSync(json){
    if(!json)return;
    kvSync.n=(kvSync.n||0)+1;
    kvSet('dkDraw',('00'+kvSync.n).slice(-3));
    if(json.recordsTotal!=null)kvSet('vtTotal',json.recordsTotal);
    if(json.recordsFiltered!=null){
      kvSet('vtMatch',json.recordsFiltered);
      kvSet('kvMeta',json.recordsFiltered+' LICENSES IN VIEW');
    }
    var used=0;
    (json.data||[]).forEach(function(r){if(parseInt(r.devices,10)>0)used++;});
    kvSet('vtPage',used);
  }

  jQuery(function($){
    var keyFilter='';
    var table=null;

    if($('#datatable').length){
      table=$('#datatable').DataTable({
        processing:true,
        serverSide:true,
        order:[[0,'desc']],
        language:{processing:'<span class="dk-proc">DECRYPTING KEY STREAM</span>'},
        drawCallback:function(){
          var api=this.api(),info=api.page.info();
          kvSync({recordsTotal:info.recordsTotal,recordsFiltered:info.recordsDisplay,data:api.rows({page:'current'}).data().toArray()});
          if(shieldOff)$('#datatable tbody .keyBlur').removeClass('key-sensi');
          $('#datatable tbody tr').each(function(i,tr){
            if(i>40)return;
            tr.style.setProperty('--ri',i%14);
            tr.classList.remove('row-in');
            void tr.offsetWidth;
            tr.classList.add('row-in');
            tr.addEventListener('animationend',function(){tr.classList.remove('row-in')},{once:true});
          });
        },
        ajax:{url:"<?= site_url('keys/api') ?>",data:function(d){d.filter=keyFilter;}},
        columns:[
          {data:'id',name:'id_keys'},
          {data:'game'},
          {
            data:'user_key',
            render:function(data,type,row){
              var is_valid=(row.status=='Active')?'text-success':'text-danger';
              return '<code class="'+is_valid+' keyBlur key-sensi key-mono" data-key="'+(row.user_key||'')+'">'+(row.user_key?row.user_key:'&mdash;')+'</code>';
            }
          },
          {
            data:'registrator',
            render:function(data,type,row){
              return row.registrator?'<span class="hud-chip">'+row.registrator+'</span>':'<span class="muted">&mdash;</span>';
            }
          },
          {
            data:'devices',
            render:function(data,type,row){
              var totalDevice=(row.devices?row.devices:0);
              var used=parseInt(totalDevice,10)>0;
              var raw=row.devices_raw?String(row.devices_raw).replace(/,/g,' \u00b7 '):'';
              var ids=(used&&raw)?'<small class="muted d-block">'+raw+'</small>':'';
              var ping=row.last_ping?'<small class="muted d-block">PING '+row.last_ping+'</small>':'';
              var state=used?'<span class="hud-chip">USED</span>':'<span class="muted">UNUSED</span>';
              return '<span id="devMax-'+row.user_key+'">'+totalDevice+'/'+row.max_devices+'</span> '+state+ids+ping;
            }
          },
          {data:'duration',render:function(data){return data;}},
          {
            data:'expired',
            name:'expired_date',
            render:function(data,type,row){
              return row.expired?'<span class="badge text-dark">'+row.expired+'</span>':'(not started yet)';
            }
          },
          {
            data:null,
            render:function(data,type,row){
              var btnReset='<button class="btn btn-outline-danger btn-sm" onclick="resetUserKey(\''+row.user_key+'\')" title="Reset HWID">HWID</button>';
              var btnalterOne='<button class="btn btn-outline-warning btn-sm" onclick="resetUserKey1(\''+row.user_key+'\')" title="Delete key">DEL</button>';
              var btnEdits='<a href="'+window.location.origin+'/keys/'+row.id+'" class="btn btn-outline-info btn-sm" title="Edit">EDIT</a>';
              var btnCopy='<button class="btn btn-outline-success btn-sm" onclick="copyKey(\''+row.user_key+'\')" title="Copy key only">KEY</button> <button class="btn btn-outline-info btn-sm" onclick="copyKeyDetails(\''+row.user_key+'\',\''+row.game+'\',\''+row.duration+'\',\''+row.max_devices+'\')" title="Copy">PACK</button>';
              var btnShare='<button class="btn btn-outline-primary btn-sm" onclick="shareKey(\''+row.user_key+'\',\''+row.game+'\',\''+row.duration+'\')" title="Share">SHARE</button>';
              return '<div class="d-flex flex-wrap gap-1">'+btnReset+' '+btnalterOne+' '+btnEdits+' '+btnCopy+' '+btnShare+'</div>';
            }
          }
        ]
      });
    }else{
      kvSync({recordsTotal:0,recordsFiltered:0,data:[]});
    }

    $('#key-filter-bar').on('click','button[data-filter]',function(){
      keyFilter=$(this).data('filter')||'';
      $('#key-filter-bar button').removeClass('is-on');
      $(this).addClass('is-on');
      kvSet('vtFilter',(this.textContent||'ALL').trim());
      if(window.dkShockAt)window.dkShockAt(this);
      if(table)table.ajax.reload();
    });

    $('#blur-out').click(function(){
      if($('.keyBlur').hasClass('key-sensi')){
        $('.keyBlur').removeClass('key-sensi');
        $('#blur-out').html('<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Eye Protect');
      }else{
        $('.keyBlur').addClass('key-sensi');
        $('#blur-out').html('<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg> Eye Protect');
      }
      shieldOff=!$('.keyBlur').hasClass('key-sensi');
      setShield(!shieldOff);
      if(shieldOff&&window.dkDecodeKeys&&!window.matchMedia('(prefers-reduced-motion: reduce)').matches)window.dkDecodeKeys();
    });
  });

  /* random row ping flash */
  setInterval(function(){
    if(window.matchMedia('(prefers-reduced-motion: reduce)').matches)return;
    var rows=document.querySelectorAll('#datatable tbody tr');
    if(!rows.length)return;
    var tr=rows[(Math.random()*rows.length)|0];
    tr.classList.add('ping');
    setTimeout(function(){tr.classList.remove('ping')},900);
  },4500);
})();
</script>
<script>
    function copyUnusedKeys() {
        if (window.bbToast) window.bbToast('LOADING UNUSED', 'ok');
        fetch("<?= site_url('keys/copyUnused') ?>", { headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.ok ? r.json() : null; })
            .then(function(d) {
                if (!d || !d.ok) { Swal.fire('Failed', 'Could not load unused keys.', 'error'); return; }
                if (!d.count) { Swal.fire('Empty', 'No unused keys to copy.', 'info'); return; }
                if (window.bbCopyKeyPack) window.bbCopyKeyPack({ keys: d.keys, count: d.count, duration: d.duration, devices: d.devices, toast: 'UNUSED COPIED \u00b7 ' + d.count });
            })
            .catch(function() { Swal.fire('Failed', 'Copy unused request failed.', 'error'); });
    }

    function confirmResetAllKeys() {
        Swal.fire({
            title: 'Reset ALL Keys?',
            text: 'This clears HWID / devices on every key you can access. Keys stay. You cannot undo this.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#b6ff3b',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, Reset All'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('keys/resetHwids') ?>";
            }
        });
    }

    function confirmDeleteAllKeys() {
        Swal.fire({
            title: 'Delete ALL Keys?',
            text: "This will permanently delete every single registered key. You cannot undo this!",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, Delete All!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('keys/deleteAll') ?>";
            }
        });
    }

    function resetUserKey1(keys) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({ icon: 'info', title: 'Please wait...' });
                var api_url = "<?= site_url('keys/resetAll') ?>";
                $.getJSON(api_url, { userkey: keys, reset: 1 }, function(data, textStatus, jqXHR) {
                    if (textStatus == 'success') {
                        if (data.registered) {
                            if (data.reset) {
                                $('#datatable').DataTable().ajax.reload(null, false);
                                Swal.fire('Deleted!', 'User key has been deleted.', 'success');
                            } else {
                                Swal.fire('Failed!', "You don't have any access to this user.", 'error');
                            }
                        } else {
                            Swal.fire('Failed!', "User key no longer exists.", 'error');
                        }
                    }
                }).fail(function() {
                    Swal.fire('Failed!', 'Delete request failed.', 'error');
                });
            }
        });
    }

    function copyKey(key) {
        if (window.bbCopyRawKey) window.bbCopyRawKey(key);
    }
    function copyKeyDetails(key, game, duration, devices) {
        if (window.bbCopyKeyPack) window.bbCopyKeyPack({ key: key, count: 1, duration: duration, devices: devices });
    }
    function shareKey(key, game, duration) {
        if (window.bbCopyKeyPack) window.bbCopyKeyPack({ key: key, count: 1, duration: duration });
    }
    function resetUserKey(keys) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset'
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({ icon: 'info', title: 'Please wait...' });
                var base_url = window.location.origin;
                var api_url = `${base_url}/keys/reset`;
                $.getJSON(api_url, { userkey: keys, reset: 1 }, function(data, textStatus, jqXHR) {
                    if (textStatus == 'success') {
                        if (data.registered) {
                            if (data.reset) {
                                $(`#devMax-${keys}`).html(`0/${data.devices_max}`);
                                Swal.fire('Reset!', 'Your device key has been reset.', 'success');
                            } else {
                                Swal.fire('Failed!', data.devices_total ? "You don't have any access to this user." : "User key devices already reset.", data.devices_total ? 'error' : 'warning');
                            }
                        } else {
                            Swal.fire('Failed!', "User key no longer exists.", 'error');
                        }
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
