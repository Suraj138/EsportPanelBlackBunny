<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<style>
@property --dkAng{syntax:'<angle>';initial-value:0deg;inherits:false}
:root{--dk-cyan:#00ffd0;--dk-lime:#b6ff3b;--dk-rose:#ff2d6a;--dk-purple:#b44bff;--dk-gold:#ffb84d;--dk-ink:#e8f6ff;--dk-dim:#8aa3c2;--dk-line:rgba(0,255,208,.18)}
body.dk-body{cursor:none}
@media(hover:none){body.dk-body{cursor:auto}}

/* cursor */
#dkDot,#dkRing{position:fixed;top:0;left:0;pointer-events:none;z-index:9999;border-radius:50%;transform:translate(-50%,-50%)}
#dkDot{width:8px;height:8px;background:var(--dk-cyan);box-shadow:0 0 12px var(--dk-cyan)}
#dkRing{width:34px;height:34px;border:1px solid rgba(0,255,208,.5);transition:width .22s,height .22s,border-color .22s}
body.dk-hover #dkRing{width:54px;height:54px;border-color:var(--dk-lime)}
body.dk-down #dkRing{width:22px;height:22px;border-color:var(--dk-rose)}
@media(hover:none){#dkDot,#dkRing{display:none}}

#dk3d{position:fixed;inset:0;z-index:0;pointer-events:none}
.dk-wrap{position:relative;z-index:3;padding:18px 22px 56px!important;perspective:1600px}
.dk-reveal{opacity:0;transform:translateY(46px) rotateX(10deg) scale(.985);transform-origin:50% 0;transition:opacity .8s cubic-bezier(.2,.7,.3,1),transform .8s cubic-bezier(.2,.7,.3,1)}
.dk-reveal.in{opacity:1;transform:none}
.dk-reveal.d1{transition-delay:.08s}.dk-reveal.d2{transition-delay:.16s}.dk-reveal.d3{transition-delay:.24s}

/* ticker */
.dk-ticker{position:relative;overflow:hidden;margin:0 0 16px;border:1px solid var(--dk-line);background:rgba(0,255,208,.03);transform:perspective(900px) rotateX(2.5deg);transform-origin:50% 100%;box-shadow:0 12px 30px rgba(0,0,0,.35)}
.dk-tk{display:flex;width:max-content;animation:dkTick 30s linear infinite}
.dk-ticker:hover .dk-tk{animation-play-state:paused}
.dk-tk span{font-family:'Share Tech Mono',monospace;letter-spacing:.2em;font-size:11px;color:var(--dk-dim);padding:11px 26px;white-space:nowrap}
.dk-tk span b{color:var(--dk-cyan);font-weight:400}
.dk-tk span i{color:var(--dk-lime);font-style:normal}
@keyframes dkTick{to{transform:translateX(-50%)}}

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
.dk-hero h1{margin:0 0 10px;font-family:Orbitron,sans-serif;font-size:clamp(1.9rem,4.2vw,3.3rem);letter-spacing:.09em;line-height:1.04;color:var(--dk-ink)}
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
.dk-btn{font-family:Orbitron,sans-serif;font-size:11px;letter-spacing:.1em;padding:12px 20px;text-decoration:none;position:relative;overflow:hidden;border:1px solid rgba(0,255,208,.25);color:var(--dk-ink);
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
.dk-btn .ripple{position:absolute;border-radius:50%;background:rgba(0,255,208,.35);transform:scale(0);animation:dkRip .6s ease-out;pointer-events:none}
@keyframes dkRip{to{transform:scale(4);opacity:0}}
.dk-btn-wave{position:absolute;left:0;right:0;bottom:0;height:10px;display:flex;align-items:flex-end;gap:2px;pointer-events:none;opacity:.55}
.dk-btn-wave i{flex:1;height:3px;background:currentColor;transform-origin:bottom;animation:dkBtnWv .7s ease-in-out infinite alternate}
.dk-btn-wave i:nth-child(2){animation-delay:.08s}.dk-btn-wave i:nth-child(3){animation-delay:.16s}.dk-btn-wave i:nth-child(4){animation-delay:.24s}
.dk-btn-wave i:nth-child(5){animation-delay:.32s}.dk-btn-wave i:nth-child(6){animation-delay:.4s}.dk-btn-wave i:nth-child(7){animation-delay:.48s}.dk-btn-wave i:nth-child(8){animation-delay:.56s}
@keyframes dkBtnWv{from{transform:scaleY(.2)}to{transform:scaleY(1)}}
.dk-btn.fill .dk-btn-wave{color:#03110c;opacity:.35}
.dk-btn:not(.fill) .dk-btn-wave{color:var(--dk-cyan)}

/* orbit */
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
.dk-orbit .core{width:74px;height:74px;display:grid;place-items:center;font-family:Orbitron,sans-serif;font-size:23px;color:#031018;
  background:linear-gradient(135deg,var(--dk-cyan),var(--dk-lime));clip-path:polygon(50% 0,95% 25%,95% 75%,50% 100%,5% 75%,5% 25%);box-shadow:0 0 40px rgba(0,255,208,.4);
  animation:dkCoreWob 6s ease-in-out infinite,dkPulse 3s ease-in-out infinite}
@keyframes dkSpin{to{transform:rotate(360deg)}}
@keyframes dkCoreWob{0%,100%{transform:rotateY(-18deg) rotateX(6deg)}50%{transform:rotateY(18deg) rotateX(-6deg)}}
@keyframes dkPulse{50%{box-shadow:0 0 70px rgba(0,255,208,.7)}}
.dk-orbit small{position:absolute;bottom:16px;letter-spacing:.16em;font-size:9px;color:var(--dk-dim);font-family:Orbitron,sans-serif}

/* stat strip */
.dk-strip{display:grid;grid-template-columns:repeat(6,minmax(0,1fr));gap:10px;margin:0 0 16px;perspective:1200px}
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
.dk-stat b{display:block;font-family:Orbitron,sans-serif;font-size:23px;color:var(--dk-cyan);text-shadow:0 0 14px rgba(0,255,208,.35)}
.dk-stat b.lime{color:var(--dk-lime);text-shadow:0 0 14px rgba(182,255,60,.35)}
.dk-stat b.rose{color:var(--dk-rose);text-shadow:0 0 14px rgba(255,45,106,.35)}
.dk-stat b.gold{color:var(--dk-gold);text-shadow:0 0 14px rgba(255,184,77,.35)}
.dk-stat b.purple{color:var(--dk-purple);text-shadow:0 0 14px rgba(180,75,255,.4)}

/* grid + panels */
.dk-grid{display:grid;grid-template-columns:1.35fr .65fr;gap:14px}
.dk-panel{position:relative;overflow:hidden;padding:18px;border:1px solid rgba(0,255,208,.22);background:linear-gradient(160deg,rgba(6,16,32,.96),rgba(4,10,20,.94));transition:box-shadow .3s,border-color .3s;will-change:transform}
.dk-panel:before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--dk-cyan),transparent);background-size:40% 100%;background-repeat:no-repeat;opacity:.75;animation:dkBeam 5s linear infinite}
@keyframes dkBeam{0%{background-position:-40% 0}100%{background-position:140% 0}}
.dk-panel:after{content:'';position:absolute;top:0;left:-45%;width:45%;height:100%;pointer-events:none;background:linear-gradient(90deg,transparent,rgba(0,255,208,.055),transparent);animation:dkSweep2 6.5s linear infinite}
@keyframes dkSweep2{to{left:120%}}
.dk-panel:hover{box-shadow:0 22px 64px rgba(0,255,208,.12);border-color:rgba(0,255,208,.4)}
.dk-panel h2{margin:0;font-family:Orbitron,sans-serif;letter-spacing:.14em;font-size:12px;color:var(--dk-cyan)}
.dk-panel header{display:flex;justify-content:space-between;align-items:center;margin:0 0 14px;transition:transform .3s ease}
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

/* flow */
.dk-flow-row{display:grid;grid-template-columns:74px 1fr 46px;gap:11px;align-items:center;margin:0 0 11px;font-size:11px;letter-spacing:.12em;font-family:Orbitron,sans-serif;color:var(--dk-dim);transition:transform .25s ease}
.dk-flow-row:hover{transform:translateX(5px)}
.dk-flow-row:hover span{color:var(--dk-cyan)}
.dk-flow-track{height:9px;background:rgba(0,255,208,.08);overflow:hidden}
.dk-flow-track b{display:block;height:9px;width:0;background:var(--dk-cyan);box-shadow:0 0 12px rgba(0,255,208,.5);transition:width 1s cubic-bezier(.2,.8,.3,1),filter .25s}
.dk-flow-row:hover .dk-flow-track b{filter:brightness(1.35)}
.dk-flow-track b.lime{background:var(--dk-lime);box-shadow:0 0 12px rgba(182,255,60,.5)}
.dk-flow-track b.rose{background:var(--dk-rose);box-shadow:0 0 12px rgba(255,45,106,.5)}
.dk-flow-track b.gold{background:var(--dk-gold);box-shadow:0 0 12px rgba(255,184,77,.5)}
.dk-flow-row strong{color:var(--dk-ink);font-family:Orbitron,sans-serif;text-align:right}

/* radial */
.dk-radial{display:flex;gap:22px;align-items:center;margin-top:16px;padding-top:16px;border-top:1px dashed rgba(0,255,208,.14)}
.dk-dial{--fill:0;position:relative;width:118px;height:118px;border-radius:50%;flex-shrink:0;
  background:conic-gradient(var(--dk-cyan) calc(var(--fill)*1%),rgba(0,255,208,.08) 0);transition:--fill 1s;animation:dkDialTilt 7s ease-in-out infinite}
@keyframes dkDialTilt{0%,100%{transform:rotateX(8deg) rotateY(-6deg)}50%{transform:rotateX(-8deg) rotateY(6deg)}}
.dk-dial:before{content:'';position:absolute;inset:11px;border-radius:50%;background:radial-gradient(circle,rgba(3,12,20,.98),rgba(4,12,24,.98))}
.dk-dial:after{content:'';position:absolute;inset:-8px;border-radius:50%;border:1px dashed rgba(0,255,208,.4);animation:dkSpin 16s linear infinite}
.dk-dial span{position:absolute;inset:0;display:grid;place-items:center;font-family:Orbitron,sans-serif;font-size:22px;color:var(--dk-lime);text-shadow:0 0 14px rgba(182,255,60,.4);z-index:1}
.dk-dial small{position:absolute;bottom:26px;left:0;right:0;text-align:center;font-family:Orbitron,sans-serif;font-size:8px;letter-spacing:.2em;color:var(--dk-dim);z-index:1}
.dk-radial-copy{font-size:13px;color:var(--dk-dim)}
.dk-radial-copy b{display:block;font-family:Orbitron,sans-serif;color:var(--dk-ink);font-size:14px;margin-bottom:4px;letter-spacing:.1em}

/* operator */
.dk-op{list-style:none;margin:0;padding:0;display:grid;gap:8px}
.dk-op li{display:flex;justify-content:space-between;gap:10px;padding:9px 6px;border-bottom:1px solid rgba(0,255,208,.1);font-size:13px;transition:transform .25s ease,background .25s,padding .25s}
.dk-op li:hover{transform:translateX(6px);background:linear-gradient(90deg,rgba(0,255,208,.07),transparent)}
.dk-op li span{color:var(--dk-dim)}
.dk-op li b{color:var(--dk-ink);font-family:Orbitron,sans-serif;font-size:12px;letter-spacing:.06em;transition:color .25s,text-shadow .25s}
.dk-op li:hover b{color:var(--dk-cyan);text-shadow:0 0 12px rgba(0,255,208,.5)}
.dk-actions{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:14px}
.dk-actions a{text-decoration:none;text-align:center;padding:10px;font-family:Orbitron,sans-serif;font-size:10.5px;letter-spacing:.08em;
  background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));color:#03110c;font-weight:700;position:relative;overflow:hidden;
  box-shadow:0 5px 0 rgba(11,94,74,.65),0 8px 20px rgba(0,255,208,.18);
  transition:transform .16s cubic-bezier(.2,.7,.3,1),box-shadow .16s,filter .2s;will-change:transform}
.dk-actions a:before{content:'';position:absolute;inset:0;padding:1.5px;pointer-events:none;
  background:conic-gradient(from var(--dkAng),transparent 0 55%,rgba(255,255,255,.85) 72%,transparent 88%);
  -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;
  mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);mask-composite:exclude;
  opacity:0;transition:opacity .25s}
.dk-actions a:hover:before{opacity:1;animation:dkAngRot 1.6s linear infinite}
.dk-actions a:hover{filter:brightness(1.13)}
.dk-actions a:active{transform:translateY(4px);box-shadow:0 1px 0 rgba(11,94,74,.65)}
.dk-actions a.pressing{transform:translateY(4px)!important;box-shadow:0 1px 0 rgba(11,94,74,.65)!important}
.dk-actions a:after{content:'';position:absolute;top:0;left:-70%;width:45%;height:100%;background:linear-gradient(100deg,transparent,rgba(255,255,255,.5),transparent);transform:skewX(-18deg);transition:left .5s ease}
.dk-actions a:hover:after{left:135%}
.dk-actions a .dk-btn-wave{position:absolute;left:0;right:0;bottom:0;height:8px;display:flex;align-items:flex-end;gap:2px;pointer-events:none;opacity:.4;color:#03110c}
.dk-actions a .dk-btn-wave i{flex:1;height:3px;background:currentColor;transform-origin:bottom;animation:dkBtnWv .7s ease-in-out infinite alternate}

/* feed */
.dk-feed{display:grid;gap:8px;max-height:300px;overflow-y:auto;padding-right:2px}
.dk-feed::-webkit-scrollbar{width:6px}
.dk-feed::-webkit-scrollbar-thumb{background:rgba(0,255,208,.3)}
.dk-drop{display:flex;gap:11px;align-items:center;padding:9px 6px;border-bottom:1px solid rgba(0,255,208,.1);transition:transform .25s ease,background .25s}
.dk-drop:hover{transform:translateX(6px);background:linear-gradient(90deg,rgba(0,255,208,.06),transparent)}
.dk-drop i{display:block;width:8px;height:8px;flex-shrink:0;background:var(--dk-lime);box-shadow:0 0 8px var(--dk-lime);animation:dkDotPulse 2s ease-in-out infinite}
@keyframes dkDotPulse{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.5);opacity:.6}}
.dk-drop strong{display:block;font-size:13px;color:var(--dk-ink);letter-spacing:.04em}
.dk-drop small{display:block;color:var(--dk-dim);font-size:11px}
.dk-empty{color:var(--dk-dim);font-size:13px}

/* lanes */
.dk-lanes{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.dk-lanes a{display:flex;gap:9px;align-items:center;text-decoration:none;padding:11px;border:1px solid rgba(0,255,208,.2);color:var(--dk-ink);
  font-family:Orbitron,sans-serif;font-size:10.5px;letter-spacing:.06em;position:relative;overflow:hidden;
  transition:transform .3s cubic-bezier(.2,.7,.3,1),border-color .25s,background .25s,box-shadow .3s;will-change:transform}
.dk-panel.js-lanes .dk-lanes a{opacity:0;animation:dkLaneIn .5s cubic-bezier(.2,.7,.3,1) both;animation-delay:calc(var(--i,0)*.045s)}
@keyframes dkLaneIn{from{opacity:0;transform:translateY(18px) rotateX(28deg)}to{opacity:1;transform:none}}
.dk-lanes a:hover{border-color:var(--dk-cyan);background:linear-gradient(120deg,rgba(0,255,208,.1),rgba(0,255,208,.02));
  transform:translateX(5px) rotateY(-5deg);box-shadow:-10px 12px 32px rgba(0,255,208,.14)}
.dk-lanes a:active{transform:translateX(5px) rotateY(-5deg) scale(.97)}
.dk-lanes a b{color:var(--dk-cyan);font-family:Orbitron,sans-serif;transition:color .25s,text-shadow .25s}
.dk-lanes a:hover b{color:var(--dk-lime);text-shadow:0 0 10px rgba(182,255,60,.6)}
.dk-span2{grid-column:1/-1}

/* console */
.dk-console{font-family:'Share Tech Mono',monospace;background:rgba(2,10,8,.7);border:1px solid rgba(0,255,208,.28);padding:14px;height:190px;overflow:hidden;display:flex;flex-direction:column;gap:5px;font-size:12px;
  transform:perspective(900px) rotateX(1.6deg);transform-origin:50% 100%;box-shadow:0 18px 44px rgba(0,0,0,.5),inset 0 0 44px rgba(0,255,208,.045)}
.dk-console.gl{animation:dkConsGl .3s steps(3)}
@keyframes dkConsGl{25%{transform:perspective(900px) rotateX(1.6deg) translateX(-5px);filter:hue-rotate(25deg) brightness(1.25)}60%{transform:perspective(900px) rotateX(1.6deg) translateX(4px)}100%{transform:perspective(900px) rotateX(1.6deg)}}
.dk-console .ln{color:var(--dk-dim);opacity:0;animation:dkLn .5s forwards}
.dk-console .ln:hover{color:var(--dk-ink)}
.dk-console .ln b{color:var(--dk-cyan);font-weight:400}
.dk-console .ln i{color:var(--dk-lime);font-style:normal}
@keyframes dkLn{to{opacity:1}}
.dk-console-head{display:flex;gap:7px;align-items:center;margin-bottom:10px;font-family:'Share Tech Mono',monospace;font-size:11px;color:var(--dk-dim);letter-spacing:.14em}
.dk-console-head .d{width:9px;height:9px;border-radius:50%}
.dk-console-head .dr{background:#ff5f56}.dk-console-head .dy{background:#ffbd2e}.dk-console-head .dg{background:#27c93f}
.dk-console-head .live{margin-left:auto;color:var(--dk-lime);animation:dkBlink 1.4s infinite}
.dk-eq{display:inline-flex;gap:2px;align-items:flex-end;height:12px;margin:0 4px 0 6px}
.dk-eq i{width:3px;height:4px;background:var(--dk-lime);animation:dkEq 1s ease-in-out infinite}
.dk-eq i:nth-child(2){animation-delay:.14s;background:var(--dk-cyan)}
.dk-eq i:nth-child(3){animation-delay:.28s;background:var(--dk-rose)}
.dk-eq i:nth-child(4){animation-delay:.42s;background:var(--dk-gold)}
.dk-eq i:nth-child(5){animation-delay:.56s;background:var(--dk-purple)}
@keyframes dkEq{0%,100%{height:3px}50%{height:12px}}

.dk-shock{position:fixed;width:10px;height:10px;border:2px solid rgba(0,255,208,.75);border-radius:50%;pointer-events:none;z-index:9997;transform:translate(-50%,-50%);box-shadow:0 0 18px rgba(0,255,208,.5);animation:dkShock .55s cubic-bezier(.2,.7,.3,1) forwards}
@keyframes dkShock{0%{width:10px;height:10px;opacity:1;border-width:2px}100%{width:150px;height:150px;opacity:0;border-width:1px}}

/* torch */
.dk-torch{position:fixed;inset:0;z-index:2;pointer-events:none;opacity:.5;transition:opacity .3s;
  background:radial-gradient(340px circle at var(--tx,50%) var(--ty,30%),rgba(0,255,208,.08),transparent 70%)}

@media (max-width:1100px){.dk-strip{grid-template-columns:repeat(3,minmax(0,1fr))}}
@media (max-width:980px){
  .dk-hero{grid-template-columns:1fr;padding:24px}
  .dk-grid{grid-template-columns:1fr}
  .dk-orbit{justify-self:center;margin-top:10px}
  .dk-strip{grid-template-columns:repeat(2,minmax(0,1fr))}
  .dk-ticker{transform:none}
  .dk-lanes a:hover{transform:translateX(4px)}
  .dk-console{transform:none}
  .dk-stat:hover{transform:translateY(-4px)}
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
        <div class="dk-wave" id="dkWave" aria-hidden="true"></div>
        <div id="dkHeroCopy">
            <div class="dk-hero-title">
                <?= view('Layout/HexBadge', ['hbSize' => 58]) ?>
                <div>
                    <div class="dk-kick">OPERATOR DECK &middot; <?= esc($roleLabel) ?></div>
                    <h1>NODE <span data-text="<?= esc(strtoupper(getName($user))) ?>"><?= esc(strtoupper(getName($user))) ?></span></h1>
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
                <a class="dk-btn fill" href="<?= site_url('keys/generate') ?>">GENERATE KEY<span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span></a>
                <a class="dk-btn" href="<?= site_url('keys') ?>">LICENSE VAULT<span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span></a>
                <?php if ((int) $user->level === 1) : ?>
                <a class="dk-btn" href="<?= site_url('public-control') ?>">PUBLIC CONTROL<span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span></a>
                <?php endif; ?>
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
            <span class="core" id="orbitOnline"><?= (int) $stats['online'] ?></span>
            <small>LIVE PINGS</small>
        </div>
    </section>

    <!-- stat strip -->
    <div class="dk-strip dk-reveal d2">
        <article class="dk-stat"><div class="ffront"><i></i><div><small>TOTAL KEYS</small><b id="stTotal">0</b></div></div><div class="fback"><canvas width="86" height="30"></canvas><small>TREND LIVE</small></div></article>
        <article class="dk-stat"><div class="ffront"><i class="lime"></i><div><small>USED / BOUND</small><b class="lime" id="stUsed">0</b></div></div><div class="fback"><canvas width="86" height="30"></canvas><small>TREND LIVE</small></div></article>
        <article class="dk-stat"><div class="ffront"><i class="rose"></i><div><small>UNUSED STOCK</small><b class="rose" id="stUnused">0</b></div></div><div class="fback"><canvas width="86" height="30"></canvas><small>TREND LIVE</small></div></article>
        <article class="dk-stat"><div class="ffront"><i class="gold"></i><div><small>FILL RATE</small><b class="gold" id="stFill">0%</b></div></div><div class="fback"><canvas width="86" height="30"></canvas><small>TREND LIVE</small></div></article>
        <article class="dk-stat"><div class="ffront"><i class="purple"></i><div><small>OPERATORS</small><b class="purple" id="stUsers">0</b></div></div><div class="fback"><canvas width="86" height="30"></canvas><small>TREND LIVE</small></div></article>
        <article class="dk-stat"><div class="ffront"><i class="rose"></i><div><small>STORE QUEUE</small><b class="rose" id="stPending">0</b></div></div><div class="fback"><canvas width="86" height="30"></canvas><small>TREND LIVE</small></div></article>
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
                <a href="<?= site_url('keys/generate') ?>">GENERATE<span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i></span></a>
                <a href="<?= site_url('keys') ?>">KEYS<span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i></span></a>
                <a href="<?= site_url('telegram') ?>">TELEGRAM<span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i></span></a>
                <a href="<?= site_url('wallet') ?>">WALLET<span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i></span></a>
            </div>
        </section>

        <!-- console -->
        <section class="dk-panel dk-reveal d3" data-tilt>
            <header><span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>LIVE CONSOLE</h2></span><em>realtime feed</em></header>
            <div class="dk-console-head"><span class="d dr"></span><span class="d dy"></span><span class="d dg"></span><span class="dk-eq" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></span> BB-DECK &mdash; SESSION LOG<span class="live">&bull; LIVE</span></div>
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
                <?php if ((int) $user->level <= 2) : ?>
                <a href="<?= site_url('telegram') ?>"><b><?= sprintf('%02d', $n++) ?></b> Telegram Bot</a>
                <?php endif; ?>
                <?php if ((int) $user->level === 1) : ?>
                <a href="<?= site_url('Server') ?>"><b><?= sprintf('%02d', $n++) ?></b> Online System</a>
                <?php endif; ?>
                <?php if ((int) $user->level <= 2) : ?>
                <a href="<?= site_url('shop') ?>" target="_blank" rel="noopener"><b><?= sprintf('%02d', $n++) ?></b> Public Shop</a>
                <a href="<?= site_url('admin/create-referral') ?>"><b><?= sprintf('%02d', $n++) ?></b> Create Referral</a>
                <?php endif; ?>
                <?php if ((int) $user->level == 1) : ?>
                <a href="<?= site_url('public-control') ?>"><b><?= sprintf('%02d', $n++) ?></b> Public Control</a>
                <a href="<?= site_url('store') ?>"><b><?= sprintf('%02d', $n++) ?></b> Loader Packages</a>
                <a href="<?= site_url('admin/manage-users') ?>"><b><?= sprintf('%02d', $n++) ?></b> Manage Users</a>
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
  addEventListener('mousedown',function(){document.body.classList.add('dk-down')});
  addEventListener('mouseup',function(){document.body.classList.remove('dk-down')});
  (function cur(){rx+=(cx-rx)*.16;ry+=(cy-ry)*.16;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(cur);})();
  document.querySelectorAll('a,button,input').forEach(function(el){
    el.addEventListener('mouseenter',function(){document.body.classList.add('dk-hover')});
    el.addEventListener('mouseleave',function(){document.body.classList.remove('dk-hover')});
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
    var hEl=document.getElementById('dkHero');if(hEl)addTrace(hEl,'#b6ff3b');
  })();

  /* ---------- hacker decode on headers ---------- */
  (function(){
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
    document.querySelectorAll('.dk-panel h2,.dk-kick').forEach(function(h){setTimeout(function(){decode(h)},400+Math.random()*600)});
    document.querySelectorAll('.dk-panel').forEach(function(p){
      p.addEventListener('mouseenter',function(){var h=p.querySelector('h2');if(h)decode(h)});
    });
  })();

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

  /* ---------- stat flip-card sparklines ---------- */
  (function(){
    var cols={cyan:'#00ffd0',lime:'#b6ff3b',rose:'#ff2d6a',gold:'#ffb84d',purple:'#b44bff'};
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

  /* ---------- quick lanes cascade entrance ---------- */
  (function(){
    document.querySelectorAll('.dk-panel .dk-lanes').forEach(function(lz){
      var panel=lz.closest('.dk-panel');if(!panel)return;
      panel.classList.add('js-lanes');
      lz.querySelectorAll('a').forEach(function(a,i){
        a.style.setProperty('--i',i);
        a.addEventListener('animationend',function(){a.style.animation='none';a.style.opacity='1'},{once:true});
      });
    });
  })();

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

  /* ---------- 3D tilt + glare tracking ---------- */
  document.querySelectorAll('[data-tilt]').forEach(function(c){
    c.addEventListener('mousemove',function(e){
      if(reduce||innerWidth<980)return;
      var r=c.getBoundingClientRect(),x=(e.clientX-r.left)/r.width-.5,y=(e.clientY-r.top)/r.height-.5;
      c.style.setProperty('--gx',(x*100+50)+'%');c.style.setProperty('--gy',(y*100+50)+'%');
      c.style.transform='perspective(1100px) rotateY('+(x*7)+'deg) rotateX('+(-y*7)+'deg) translateY(-3px)';
    });
    c.addEventListener('mouseleave',function(){c.style.transform=''});
  });

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
  document.querySelectorAll('.dk-btn,.dk-actions a').forEach(function(b){
    b.addEventListener('mousemove',function(e){
      if(reduce||innerWidth<980)return;
      var r=b.getBoundingClientRect(),x=e.clientX-r.left-r.width/2,y=e.clientY-r.top-r.height/2;
      b.style.transform='translate('+(x*.18)+'px,'+(y*.24-2)+'px)';
    });
    b.addEventListener('mouseleave',function(){b.style.transform='';b.classList.remove('pressing')});
    b.addEventListener('mousedown',function(){b.classList.add('pressing')});
    b.addEventListener('mouseup',function(){b.classList.remove('pressing')});
  });

  /* ---------- cyan shockwave + ripple (no fire burst) ---------- */
  function shock(x,y){
    var s=document.createElement('span');s.className='dk-shock';
    s.style.left=x+'px';s.style.top=y+'px';
    document.body.appendChild(s);setTimeout(function(){s.remove()},620);
  }
  document.querySelectorAll('.dk-btn,.dk-actions a').forEach(function(b){
    b.addEventListener('click',function(e){
      if(reduce)return;
      shock(e.clientX,e.clientY);
      var r=this.getBoundingClientRect(),s=document.createElement('span');
      s.className='ripple';s.style.cssText+='width:'+Math.max(r.width,r.height)+'px;height:'+Math.max(r.width,r.height)+'px;left:'+(e.clientX-r.left)+'px;top:'+(e.clientY-r.top)+'px';
      this.style.position='relative';this.style.overflow='hidden';this.appendChild(s);setTimeout(function(){s.remove()},650);
    });
  });

  /* ---------- cyan spark burst on any click ---------- */
  var wrapEl=document.querySelector('.dk-wrap');
  if(wrapEl)wrapEl.addEventListener('click',function(e){
    if(reduce)return;
    for(var i=0;i<10;i++){
      var s=document.createElement('span'),sz=2+Math.random()*4,cl=Math.random()>.5?'#00ffd0':'#b6ff3b';
      s.style.cssText='position:fixed;z-index:9998;border-radius:50%;pointer-events:none;width:'+sz+'px;height:'+sz+'px;left:'+e.clientX+'px;top:'+e.clientY+'px;background:'+cl+';box-shadow:0 0 6px '+cl;
      document.body.appendChild(s);
      var a=Math.random()*Math.PI*2,d=22+Math.random()*48,el=s;
      el.animate([{transform:'translate(0,0) scale(1)',opacity:1},{transform:'translate('+(Math.cos(a)*d)+'px,'+(Math.sin(a)*d)+'px) scale(.2)',opacity:0}],{duration:420+Math.random()*280,easing:'cubic-bezier(.2,.7,.3,1)'}).onfinish=function(){el.remove()};
    }
  });

  /* ---------- random neon flicker on panels ---------- */
  setInterval(function(){
    if(reduce)return;
    var ps=document.querySelectorAll('.dk-panel');if(!ps.length)return;
    var p=ps[(Math.random()*ps.length)|0];
    p.classList.add('flick');setTimeout(function(){p.classList.remove('flick')},680);
  },7000);

  /* ---------- console glitch shift ---------- */
  setInterval(function(){
    if(reduce)return;
    var c=document.getElementById('dkConsole');if(!c)return;
    c.classList.add('gl');setTimeout(function(){c.classList.remove('gl')},320);
  },9000);

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
