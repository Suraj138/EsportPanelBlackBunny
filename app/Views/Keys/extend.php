<?= $this->extend('Layout/Starter') ?>

<?= $this->section('css') ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<style>
@property --dkAng{syntax:'<angle>';initial-value:0deg;inherits:false}
:root{--dk-cyan:#00ffd0;--dk-lime:#b6ff3c;--dk-rose:#ff2d6a;--dk-purple:#b44bff;--dk-gold:#ffb84d;--dk-ink:#e8f6ff;--dk-dim:#8aa3c2;--dk-line:rgba(0,255,208,.18)}
::selection{background:rgba(0,255,208,.35);color:#03110c}

#ext3d{position:fixed;inset:0;z-index:0;pointer-events:none}
.ext-torch{position:fixed;inset:0;z-index:1;pointer-events:none;opacity:.5;
  background:radial-gradient(340px circle at var(--tx,50%) var(--ty,30%),rgba(0,255,208,.08),transparent 70%)}
.ext-wrap{position:relative;z-index:3;padding:18px 22px 56px;perspective:1600px}

.dk-reveal{opacity:0;transform:translateY(46px) rotateX(10deg) scale(.985);transform-origin:50% 0;transition:opacity .8s cubic-bezier(.2,.7,.3,1),transform .8s cubic-bezier(.2,.7,.3,1)}
.dk-reveal.in{opacity:1;transform:none}
.dk-reveal.d1{transition-delay:.08s}.dk-reveal.d2{transition-delay:.16s}

.dk-hero{position:relative;overflow:hidden;min-height:230px;margin:0 0 16px;padding:28px 32px;display:grid;grid-template-columns:1.45fr .55fr;align-items:center;gap:22px;
  border:1px solid rgba(0,255,208,.32);
  background:radial-gradient(460px 200px at 10% 0%,rgba(0,255,208,.16),transparent 60%),radial-gradient(420px 220px at 96% 100%,rgba(255,45,106,.14),transparent 62%),linear-gradient(135deg,rgba(4,12,24,.96),rgba(6,14,30,.92));
  transform-style:preserve-3d;transition:transform .18s ease-out;will-change:transform}
.dk-hero:after{content:'';position:absolute;left:-30%;top:0;width:28%;height:100%;background:linear-gradient(90deg,transparent,rgba(0,255,208,.12),transparent);animation:dkSweep 5.4s ease-in-out infinite;pointer-events:none}
@keyframes dkSweep{0%{left:-30%}55%,100%{left:130%}}
.dk-hero .dk-scangrid{position:absolute;inset:0;pointer-events:none;background:repeating-linear-gradient(180deg,transparent 0 12px,rgba(0,255,208,.035) 13px);animation:gridDrift 9s linear infinite}
.dk-kick{font-family:Orbitron,sans-serif;letter-spacing:.28em;font-size:11px;color:var(--dk-rose);margin-bottom:10px}
.dk-hero-title{display:flex;align-items:center;gap:16px;margin-bottom:8px}
.dk-hero h1{margin:0;font-family:Orbitron,sans-serif;font-size:clamp(1.7rem,4vw,2.9rem);letter-spacing:.09em;line-height:1.04;color:var(--dk-ink)}
.dk-hero h1 span{position:relative;display:inline-block;background:linear-gradient(90deg,var(--dk-rose),var(--dk-gold));-webkit-background-clip:text;background-clip:text;color:transparent;background-size:200%;animation:dkGrad 4s linear infinite}
@keyframes dkGrad{to{background-position:200%}}
.dk-type{max-width:560px;color:var(--dk-dim);min-height:26px;font-size:15px;margin:6px 0}
.dk-type .caret{display:inline-block;width:9px;background:var(--dk-cyan);margin-left:2px;animation:dkBlink .8s infinite}
@keyframes dkBlink{50%{opacity:0}}
.dk-clocks{display:flex;gap:28px;flex-wrap:wrap;margin-top:14px}
.dk-clocks small{display:block;letter-spacing:.2em;color:var(--dk-lime);font-size:10px;font-family:Orbitron,sans-serif}
.dk-clocks strong{display:block;font-family:Orbitron,sans-serif;font-size:17px;color:var(--dk-cyan);text-shadow:0 0 14px rgba(0,255,208,.4);transition:transform .25s,text-shadow .25s}
.dk-clocks div:hover strong{transform:translateY(-3px);text-shadow:0 0 22px rgba(0,255,208,.75)}
.dk-clocks strong.rose{color:var(--dk-rose);text-shadow:0 0 14px rgba(255,45,106,.4)}
.dk-clocks strong.gold{color:var(--dk-gold);text-shadow:0 0 14px rgba(255,184,77,.4)}
.dk-hero-cta{display:flex;gap:12px;flex-wrap:wrap;margin-top:18px}

.dk-orbit{position:relative;width:200px;height:200px;justify-self:end;display:grid;place-items:center;will-change:transform}
.dk-orbit .ring{position:absolute;border-radius:50%;border:1px solid rgba(0,255,208,.22);border-top-color:rgba(0,255,208,.85)}
.dk-orbit .r1{inset:6%;animation:dkGyroX1 9s linear infinite}
.dk-orbit .r2{inset:20%;border-color:rgba(255,45,106,.25);border-top-color:rgba(255,45,106,.85);animation:dkGyroX2 6s linear infinite reverse}
.dk-orbit .r3{inset:34%;border-color:rgba(255,184,77,.25);border-top-color:rgba(255,184,77,.85);animation:dkGyroY1 4.5s linear infinite}
@keyframes dkGyroX1{from{transform:rotateX(68deg) rotateZ(0)}to{transform:rotateX(68deg) rotateZ(360deg)}}
@keyframes dkGyroX2{from{transform:rotateX(76deg) rotateZ(0)}to{transform:rotateX(76deg) rotateZ(360deg)}}
@keyframes dkGyroY1{from{transform:rotateY(74deg) rotateZ(0)}to{transform:rotateY(74deg) rotateZ(360deg)}}
.dk-orbit .sonar{position:absolute;inset:26%;border-radius:50%;border:1px solid rgba(0,255,208,.55);opacity:0;animation:dkSonar 3.2s ease-out infinite}
@keyframes dkSonar{0%{transform:scale(.35);opacity:.9}100%{transform:scale(1.55);opacity:0}}
.dk-orbit .sweep{position:absolute;inset:6%;border-radius:50%;background:conic-gradient(from 0deg,transparent 0 78%,rgba(255,45,106,.3) 88%,transparent 100%);animation:dkSpin 2.4s linear infinite;filter:blur(.4px)}
@keyframes dkSpin{to{transform:rotate(360deg)}}
.dk-orbit .core{width:70px;height:70px;display:grid;place-items:center;color:#12030a;
  background:linear-gradient(135deg,var(--dk-rose),var(--dk-gold));clip-path:polygon(50% 0,95% 25%,95% 75%,50% 100%,5% 75%,5% 25%);box-shadow:0 0 40px rgba(255,45,106,.4);
  animation:dkCoreWob 6s ease-in-out infinite,dkPulse 3s ease-in-out infinite}
.dk-orbit .core svg{width:30px;height:30px}
@keyframes dkCoreWob{0%,100%{transform:rotateY(-18deg) rotateX(6deg)}50%{transform:rotateY(18deg) rotateX(-6deg)}}
@keyframes dkPulse{50%{box-shadow:0 0 70px rgba(255,45,106,.7)}}
.dk-orbit small{position:absolute;bottom:14px;letter-spacing:.16em;font-size:9px;color:var(--dk-dim);font-family:Orbitron,sans-serif}

.dk-btn{font-family:Orbitron,sans-serif;font-size:11px;letter-spacing:.1em;padding:12px 20px;text-decoration:none;position:relative;overflow:hidden;border:1px solid rgba(0,255,208,.25);color:var(--dk-ink);background:rgba(3,10,20,.5);display:inline-flex;align-items:center;justify-content:center;gap:8px;
  transition:transform .18s cubic-bezier(.2,.7,.3,1),box-shadow .25s,border-color .2s,filter .2s,text-shadow .2s;cursor:pointer;will-change:transform}
.dk-btn.fill{background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));color:#03110c;font-weight:700;border-color:transparent;
  box-shadow:0 6px 0 rgba(11,94,74,.65),0 12px 28px rgba(0,255,208,.22)}
.dk-btn.fill.rose{background:linear-gradient(90deg,var(--dk-rose),var(--dk-gold));box-shadow:0 6px 0 rgba(120,20,50,.65),0 12px 28px rgba(255,45,106,.22)}
.dk-btn:hover{transform:translateY(-3px) rotateX(9deg);box-shadow:0 16px 36px rgba(0,255,208,.32);border-color:var(--dk-cyan)}
.dk-btn.fill:hover{box-shadow:0 9px 0 rgba(11,94,74,.55),0 20px 42px rgba(0,255,208,.38)}
.dk-btn.fill.rose:hover{box-shadow:0 9px 0 rgba(120,20,50,.55),0 20px 42px rgba(255,45,106,.38)}
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

.gen-form{display:flex;flex-direction:column;gap:18px}
.gen-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.gen-field label{display:block;font-family:Orbitron,sans-serif;font-size:10px;letter-spacing:.18em;color:var(--dk-lime);margin-bottom:8px;text-transform:uppercase}
.gen-input,.gen-form select,.gen-form input[type=number],.gen-form input[type=text],.gen-form input[type=datetime-local]{
  width:100%!important;background:rgba(4,12,24,.92)!important;border:1px solid rgba(0,255,208,.25)!important;color:var(--dk-ink)!important;
  font-family:'Share Tech Mono',monospace;font-size:14px;padding:12px 14px;border-radius:2px;outline:none;
  transition:border-color .25s,box-shadow .25s,background .25s;height:auto}
.gen-input:focus,.gen-form select:focus,.gen-form input:focus{border-color:var(--dk-cyan)!important;box-shadow:0 0 16px rgba(0,255,208,.3)!important;background:rgba(5,16,30,.98)!important}
.gen-form select option{background:#04101c;color:var(--dk-ink)}
.gen-error{display:block;color:var(--dk-rose);font-family:'Share Tech Mono',monospace;font-size:11px;margin-top:6px}
.gen-submit{width:100%;padding:16px 22px;font-size:12px;letter-spacing:.2em}
.gen-submit.is-firing:after{content:'PATCHING';background:rgba(3,10,18,.82);letter-spacing:.24em}
.gen-hint{color:var(--dk-dim);font-family:'Share Tech Mono',monospace;font-size:10px;letter-spacing:.12em;text-align:center;margin:0}

/* switches */
.ext-switch{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:8px;perspective:600px}
.ext-switch.two{grid-template-columns:repeat(2,minmax(0,1fr))}
.ext-switch button{position:relative;overflow:hidden;font-family:Orbitron,sans-serif;font-size:10px;letter-spacing:.14em;padding:12px 10px;border:1px solid rgba(0,255,208,.25);background:rgba(3,10,20,.85);color:var(--dk-dim);cursor:pointer;transition:transform .2s cubic-bezier(.2,.7,.3,1),box-shadow .25s,color .2s,border-color .2s}
.ext-switch button:hover{color:var(--dk-ink);border-color:var(--dk-cyan);transform:translateY(-2px) rotateX(8deg);text-shadow:-1px 0 rgba(255,45,106,.7),1px 0 rgba(0,255,208,.7)}
.ext-switch button.is-on{background:linear-gradient(90deg,var(--dk-cyan),var(--dk-lime));color:#03110c;border-color:transparent;font-weight:700;box-shadow:0 4px 0 rgba(11,94,74,.6),0 8px 22px rgba(0,255,208,.28);text-shadow:none}
.ext-switch button.is-on.rose{background:linear-gradient(90deg,var(--dk-rose),var(--dk-gold));box-shadow:0 4px 0 rgba(120,20,50,.6),0 8px 22px rgba(255,45,106,.28)}
.ext-switch button.is-on:after{content:'';position:absolute;top:0;left:-80%;width:55%;height:100%;background:linear-gradient(100deg,transparent,rgba(255,255,255,.55),transparent);transform:skewX(-20deg);animation:dkLaser 2.2s ease-in-out infinite;pointer-events:none}
@keyframes dkLaser{0%{left:-80%}60%,100%{left:130%}}
.ext-switch-label{font-family:Orbitron,sans-serif;font-size:10px;letter-spacing:.2em;color:var(--dk-dim);margin:0 0 8px}

/* key card */
.ext-keycard{position:relative;border:1px solid rgba(0,255,208,.28);background:linear-gradient(160deg,rgba(5,18,26,.95),rgba(4,10,20,.95));padding:16px;overflow:hidden}
.ext-keycard:before{content:'';position:absolute;left:-30%;top:0;width:24%;height:100%;background:linear-gradient(90deg,transparent,rgba(0,255,208,.12),transparent);animation:dkSweep 4.8s ease-in-out infinite}
.ext-keycard .kc-top{display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:12px}
.ext-keycard .kc-key{font-family:'Share Tech Mono',monospace;font-size:16px;letter-spacing:.08em;color:var(--dk-lime);word-break:break-all}
.ext-keycard .hud-chip{font-size:9px;letter-spacing:.14em;padding:4px 9px}
.ext-keycard .kc-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px}
.ext-keycard .kc-grid small{display:block;color:var(--dk-dim);font-family:Orbitron,sans-serif;font-size:9px;letter-spacing:.16em}
.ext-keycard .kc-grid b{display:block;color:var(--dk-ink);font-family:'Share Tech Mono',monospace;font-size:14px;word-break:break-word}
.ext-keycard .kc-grid b.cyan{color:var(--dk-cyan)}
.ext-keycard .kc-grid b.rose{color:var(--dk-rose)}
.ext-keycard .kc-grid b.gold{color:var(--dk-gold)}

.ext-allcard{position:relative;border:1px solid rgba(255,45,106,.35);background:linear-gradient(160deg,rgba(26,8,18,.94),rgba(6,10,20,.95));padding:18px;overflow:hidden}
.ext-allcard h3{margin:0 0 6px;font-family:Orbitron,sans-serif;font-size:13px;letter-spacing:.16em;color:var(--dk-rose)}
.ext-allcard p{margin:0;color:var(--dk-dim);font-family:'Share Tech Mono',monospace;font-size:11px;letter-spacing:.06em;line-height:1.7}
.ext-allcard .all-stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;margin-top:14px}
.ext-allcard .all-stats small{display:block;color:var(--dk-dim);font-family:Orbitron,sans-serif;font-size:9px;letter-spacing:.16em}
.ext-allcard .all-stats b{display:block;font-family:'Share Tech Mono',monospace;font-size:16px;color:var(--dk-gold)}

.ext-preview{border:1px solid rgba(182,255,60,.4);background:linear-gradient(90deg,rgba(182,255,60,.1),rgba(0,255,208,.04));padding:14px 16px;display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap}
.ext-preview .pv-side small{display:block;font-family:Orbitron,sans-serif;font-size:9px;letter-spacing:.16em;color:var(--dk-dim)}
.ext-preview .pv-side b{display:block;font-family:'Share Tech Mono',monospace;font-size:14px;color:var(--dk-ink)}
.ext-preview .pv-side.next b{color:var(--dk-lime)}
.ext-preview .pv-arrow{font-family:Orbitron,sans-serif;font-size:18px;color:var(--dk-cyan);text-shadow:0 0 12px rgba(0,255,208,.6)}

.gen-drop{position:relative;margin-bottom:16px;border:1px solid rgba(182,255,60,.4);background:linear-gradient(160deg,rgba(6,20,16,.96),rgba(4,12,20,.96));box-shadow:0 0 44px rgba(182,255,60,.1);padding:22px;overflow:hidden}
.gen-drop:before{content:'';position:absolute;left:-20%;top:0;width:24%;height:100%;background:linear-gradient(90deg,transparent,rgba(182,255,60,.14),transparent);animation:dkSweep 4.6s ease-in-out infinite}
.gen-drop h2{font-family:Orbitron,sans-serif;font-size:16px;letter-spacing:.16em;color:var(--dk-lime);margin:0}
.gen-drop .drop-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;margin:16px 0 0}
.gen-drop .drop-grid small{display:block;color:var(--dk-dim);font-family:Orbitron,sans-serif;font-size:9px;letter-spacing:.16em}
.gen-drop .drop-grid b{display:block;color:var(--dk-ink);font-family:'Share Tech Mono',monospace;font-size:15px}

.dk-shock{position:fixed;width:10px;height:10px;border:2px solid rgba(0,255,208,.75);border-radius:50%;pointer-events:none;z-index:9997;transform:translate(-50%,-50%);box-shadow:0 0 18px rgba(0,255,208,.5);animation:dkShock .55s cubic-bezier(.2,.7,.3,1) forwards}
@keyframes dkShock{0%{width:10px;height:10px;opacity:1;border-width:2px}100%{width:150px;height:150px;opacity:0;border-width:1px}}
.ripple{position:absolute;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.5),rgba(0,255,208,.25) 40%,transparent 70%);pointer-events:none;transform:translate(-50%,-50%) scale(0);animation:dkRip .6s ease-out forwards;z-index:5}
@keyframes dkRip{from{transform:translate(-50%,-50%) scale(0);opacity:.7}to{transform:translate(-50%,-50%) scale(1);opacity:0}}

.ext-forge{position:fixed;inset:0;z-index:9998;display:grid;place-items:center;background:radial-gradient(circle at 50% 45%,rgba(255,45,106,.1),rgba(2,8,14,.9) 55%,rgba(2,6,10,.96));backdrop-filter:blur(8px);opacity:0;visibility:hidden;transition:opacity .3s,visibility .3s}
.ext-forge.on{opacity:1;visibility:visible}
.ext-forge-in{position:relative;text-align:center;width:min(360px,80vw)}
.ext-forge-in .forge-hex{animation:forgeFloat 1.4s ease-in-out infinite}
@keyframes forgeFloat{50%{transform:translateY(-10px) scale(1.06)}}
.ext-forge-in .forge-ring{position:absolute;left:50%;top:44px;width:150px;height:150px;margin:-75px 0 0 -75px;border-radius:50%;border:1px solid rgba(255,45,106,.35);animation:forgeRing 1.2s linear infinite}
.ext-forge-in .forge-ring.r2{animation-duration:1.8s;animation-direction:reverse;border-color:rgba(255,184,77,.3)}
@keyframes forgeRing{from{transform:rotateX(70deg) rotateZ(0)}to{transform:rotateX(70deg) rotateZ(360deg)}}
.ext-forge-in .forge-txt{margin-top:18px;font-family:Orbitron,sans-serif;font-size:12px;letter-spacing:.3em;color:var(--dk-rose);text-shadow:0 0 14px rgba(255,45,106,.6)}
.ext-forge-in .forge-pct{margin-top:8px;font-family:Orbitron,sans-serif;font-size:22px;color:var(--dk-gold);text-shadow:0 0 16px rgba(255,184,77,.5)}
.ext-forge-in .forge-bar{margin-top:16px;height:3px;background:rgba(255,45,106,.14);overflow:hidden}
.ext-forge-in .forge-bar i{display:block;height:100%;width:0;background:linear-gradient(90deg,var(--dk-rose),var(--dk-gold));box-shadow:0 0 14px rgba(255,45,106,.8)}
.ext-forge.on .forge-bar i{animation:forgeFill 1.05s linear forwards}
@keyframes forgeFill{to{width:100%}}

@media (max-width:980px){
  .dk-hero{grid-template-columns:1fr;padding:24px}
  .dk-orbit{justify-self:center;margin-top:8px}
  .gen-grid,.ext-switch,.ext-keycard .kc-grid,.ext-allcard .all-stats,.gen-drop .drop-grid{grid-template-columns:1fr}
  .ext-switch.two{grid-template-columns:1fr}
}
@media (prefers-reduced-motion:reduce){*{animation-duration:.001ms!important;animation-iteration-count:1!important;transition-duration:.001ms!important}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
    $keyMap = [];
    foreach ($keys as $k) {
        $keyMap[(int) $k->id_keys] = [
            'key' => (string) $k->user_key,
            'game' => (string) $k->game,
            'duration' => (int) $k->duration,
            'expired' => $k->expired_date ? (string) $k->expired_date : '',
            'max' => (int) $k->max_devices,
            'devices' => $k->devices ? count(array_filter(array_map('trim', explode(',', (string) $k->devices)))) : 0,
            'status' => (int) $k->status === 1 ? 'ACTIVE' : 'BLOCKED',
            'registrator' => (string) $k->registrator,
        ];
    }
    $initialId = $selected ? (int) $selected->id_keys : (int) ($keys[0]->id_keys ?? 0);
?>
<canvas id="ext3d"></canvas>
<div class="ext-torch" id="extTorch"></div>

<div class="ext-wrap">
    <div class="mb-3"><?= $this->include('Layout/msgStatus') ?></div>

    <section class="dk-hero dk-reveal" id="extHero">
        <div class="dk-scangrid"></div>
        <div>
            <div class="dk-kick">OWNER VAULT &middot; TIME CONTROL</div>
            <div class="dk-hero-title">
                <?= view('Layout/HexBadge', ['hbSize' => 56]) ?>
                <h1>EXTEND <span>KEYS</span></h1>
            </div>
            <p class="dk-type"><span id="extTyped"></span><span class="caret">&nbsp;</span></p>
            <div class="dk-clocks">
                <div><small>TOTAL</small><strong><?= (int) $stats['total'] ?></strong></div>
                <div><small>LIVE</small><strong><?= (int) $stats['live'] ?></strong></div>
                <div><small>EXPIRED</small><strong class="rose"><?= (int) $stats['expired'] ?></strong></div>
                <div><small>UNSTARTED</small><strong class="gold"><?= (int) $stats['unstarted'] ?></strong></div>
            </div>
            <div class="dk-hero-cta">
                <a class="dk-btn" href="<?= site_url('keys') ?>">BACK TO VAULT</a>
            </div>
        </div>
        <div class="dk-orbit" id="extOrbit" aria-hidden="true">
            <span class="ring r1"></span>
            <span class="ring r2"></span>
            <span class="ring r3"></span>
            <span class="sonar"></span>
            <span class="sweep"></span>
            <span class="core"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg></span>
            <small>TIME CORE</small>
        </div>
    </section>

    <?php if (session()->getFlashdata('extend_count') !== null) : ?>
        <div class="gen-drop dk-reveal d1" id="extDrop">
            <h2>TIME PATCH APPLIED</h2>
            <div class="drop-grid">
                <div><small>LICENSES</small><b><?= (int) session()->getFlashdata('extend_count') ?></b></div>
                <div><small>SCOPE</small><b><?= esc(ucfirst((string) session()->getFlashdata('extend_scope'))) ?></b></div>
                <div><small>CHANGE</small><b><?= esc((string) session()->getFlashdata('extend_label')) ?></b></div>
            </div>
            <p class="gen-hint" style="text-align:left;margin-top:12px">Target: <?= esc((string) session()->getFlashdata('extend_target')) ?></p>
        </div>
    <?php endif; ?>

    <?php if (empty($keys)) : ?>
        <section class="dk-panel dk-reveal d2">
            <header><span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>NO LICENSES</h2></span></header>
            <p class="gen-hint" style="text-align:left">There are no keys in the vault yet. Generate a license first.</p>
            <div class="dk-hero-cta"><a class="dk-btn fill" href="<?= site_url('keys/generate') ?>">GENERATE KEY</a></div>
        </section>
    <?php else : ?>
        <section class="dk-panel dk-reveal d2" id="extPanel">
            <header>
                <span class="dk-h"><?= view('Layout/HexBadge', ['hbSize' => 26]) ?><h2>TIME PATCH</h2><em>OWNER ONLY</em></span>
                <em>APPLIES INSTANTLY</em>
            </header>

            <?= form_open('keys/extend', ['class' => 'gen-form', 'id' => 'extForm']) ?>
                <input type="hidden" name="scope" id="scopeInput" value="single">
                <input type="hidden" name="mode" id="modeInput" value="add">

                <div>
                    <p class="ext-switch-label">SCOPE</p>
                    <div class="ext-switch two" id="scopeSwitch">
                        <button type="button" data-scope="single" class="is-on">SINGLE KEY</button>
                        <button type="button" data-scope="all">ALL KEYS</button>
                    </div>
                </div>

                <div id="singleWrap">
                    <div class="gen-field">
                        <label for="targetSelect">Target License</label>
                        <select name="target_id" id="targetSelect" class="gen-input">
                            <?php foreach ($keys as $k) : ?>
                                <option value="<?= (int) $k->id_keys ?>" <?= (int) $k->id_keys === $initialId ? 'selected' : '' ?>><?= esc($k->user_key) ?> | <?= esc($k->game) ?> | <?= $k->expired_date ? esc($k->expired_date) : 'NOT STARTED' ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="ext-keycard" id="keyCard" style="margin-top:12px">
                        <div class="kc-top">
                            <code class="kc-key" id="kcKey">-</code>
                            <span class="hud-chip" id="kcStatus">-</span>
                            <span class="hud-chip" id="kcGame">-</span>
                        </div>
                        <div class="kc-grid">
                            <div><small>REGISTRATOR</small><b id="kcReg">-</b></div>
                            <div><small>DURATION</small><b class="cyan" id="kcDuration">-</b></div>
                            <div><small>DEVICES</small><b id="kcDevices">-</b></div>
                            <div><small>EXPIRES</small><b id="kcExpired">-</b></div>
                            <div><small>REMAINING</small><b id="kcRemaining">-</b></div>
                            <div><small>LAST PING</small><b id="kcPing">-</b></div>
                        </div>
                    </div>
                </div>

                <div id="allWrap" style="display:none">
                    <div class="ext-allcard">
                        <h3>ALL KEYS SELECTED</h3>
                        <p>This patch rewrites the clock on every license in the vault. Expired keys can be revived and live keys can be cut short. Review the preview before firing.</p>
                        <div class="all-stats">
                            <div><small>LICENSES</small><b><?= (int) $stats['total'] ?></b></div>
                            <div><small>LIVE</small><b><?= (int) $stats['live'] ?></b></div>
                            <div><small>EXPIRED</small><b><?= (int) $stats['expired'] ?></b></div>
                        </div>
                    </div>
                </div>

                <div>
                    <p class="ext-switch-label">OPERATION</p>
                    <div class="ext-switch" id="modeSwitch">
                        <button type="button" data-mode="add" class="is-on">+ EXTEND</button>
                        <button type="button" data-mode="subtract">- REDUCE</button>
                        <button type="button" data-mode="set">= SET EXACT</button>
                    </div>
                </div>

                <div class="gen-grid" id="amountGrid">
                    <div class="gen-field">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="gen-input" value="<?= esc(old('amount') ?: 1, 'attr') ?>" min="1" step="1">
                    </div>
                    <div class="gen-field">
                        <label for="unit">Unit</label>
                        <select name="unit" id="unit" class="gen-input">
                            <option value="hours" <?= old('unit') === 'days' ? '' : 'selected' ?>>Hours</option>
                            <option value="days" <?= old('unit') === 'days' ? 'selected' : '' ?>>Days</option>
                        </select>
                    </div>
                </div>

                <div class="gen-field" id="exactGrid" style="display:none">
                    <label for="exactDate">Exact Expiry</label>
                    <input type="datetime-local" name="exact_date" id="exactDate" class="gen-input">
                </div>

                <div class="ext-preview" id="extPreview">
                    <div class="pv-side"><small>CURRENT</small><b id="pvCurrent">-</b></div>
                    <div class="pv-arrow">&#10230;</div>
                    <div class="pv-side next"><small>AFTER PATCH</small><b id="pvNext">-</b></div>
                </div>

                <button type="submit" id="extSubmit" class="dk-btn fill rose gen-submit">
                    <span class="dk-btn-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span>
                    APPLY TIME PATCH
                </button>
                <p class="gen-hint">Extend or reduce any license. Unstarted keys adjust their duration instead.</p>
            </form>
        </section>
    <?php endif; ?>
</div>

<div class="ext-forge" id="extForge" aria-hidden="true">
    <div class="ext-forge-in">
        <?= view('Layout/HexBadge', ['hbSize' => 84]) ?>
        <span class="forge-ring"></span>
        <span class="forge-ring r2"></span>
        <div class="forge-txt">PATCHING TIME</div>
        <div class="forge-pct" id="forgePct">0%</div>
        <div class="forge-bar"><i></i></div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>window.extKeys = <?= json_encode($keyMap, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?: '{}' ?>;</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  'use strict';
  var reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  var forge = 0;
  window.__extForge = function () { forge = 1; };

  /* ---------- torch ---------- */
  var torch = document.getElementById('extTorch');
  if (torch) addEventListener('mousemove', function (e) {
    torch.style.setProperty('--tx', e.clientX + 'px');
    torch.style.setProperty('--ty', e.clientY + 'px');
  });

  /* ---------- panel glare ---------- */
  document.querySelectorAll('.dk-panel').forEach(function (p) {
    p.addEventListener('mousemove', function (e) {
      var r = p.getBoundingClientRect();
      p.style.setProperty('--gx', ((e.clientX - r.left) / r.width * 100) + '%');
      p.style.setProperty('--gy', ((e.clientY - r.top) / r.height * 100) + '%');
    });
  });

  /* ---------- hero tilt ---------- */
  var hero = document.getElementById('extHero'), orbit = document.getElementById('extOrbit');
  if (hero) addEventListener('mousemove', function (e) {
    if (reduce || innerWidth < 980) return;
    var x = e.clientX / innerWidth - .5, y = e.clientY / innerHeight - .5;
    hero.style.transform = 'perspective(1200px) rotateY(' + (x * 4) + 'deg) rotateX(' + (-y * 3) + 'deg)';
    if (orbit) orbit.style.transform = 'translate(' + (x * 14) + 'px,' + (y * 9) + 'px)';
  });

  /* ---------- typewriter ---------- */
  var phrases = ['Move a license clock up or down. Owner override.','Single key or the whole vault. Live, expired or unstarted.','Reducing past zero expires the key immediately.'];
  var typed = document.getElementById('extTyped'), pi = 0, ci = 0, del = false;
  (function type() {
    if (!typed) return;
    var cur = phrases[pi];
    typed.textContent = del ? cur.slice(0, --ci) : cur.slice(0, ++ci);
    if (!del && ci === cur.length) { del = true; return setTimeout(type, 2400); }
    if (del && ci === 0) { del = false; pi = (pi + 1) % phrases.length; }
    setTimeout(type, del ? 22 : 46);
  })();

  /* ---------- reveal ---------- */
  var io = new IntersectionObserver(function (es) { es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } }) }, { threshold: .1 });
  document.querySelectorAll('.dk-reveal').forEach(function (el) { io.observe(el); });

  /* ---------- wave-circle tap ---------- */
  function shock(x, y) {
    var s = document.createElement('span'); s.className = 'dk-shock';
    s.style.left = x + 'px'; s.style.top = y + 'px';
    document.body.appendChild(s); setTimeout(function () { s.remove(); }, 620);
  }
  document.addEventListener('click', function (e) {
    if (reduce) return;
    var t = e.target && e.target.closest ? e.target.closest('.dk-btn') : null;
    if (!t) return;
    shock(e.clientX, e.clientY);
    var r = t.getBoundingClientRect(), s = document.createElement('span');
    s.className = 'ripple';
    s.style.cssText += 'width:' + Math.max(r.width, r.height) + 'px;height:' + Math.max(r.width, r.height) + 'px;left:' + (e.clientX - r.left) + 'px;top:' + (e.clientY - r.top) + 'px';
    t.style.position = 'relative'; t.style.overflow = 'hidden'; t.appendChild(s); setTimeout(function () { s.remove(); }, 650);
  });

  /* ---------- flicker ---------- */
  setInterval(function () {
    if (reduce) return;
    var ps = document.querySelectorAll('.dk-panel'); if (!ps.length) return;
    var p = ps[(Math.random() * ps.length) | 0];
    p.classList.add('flick'); setTimeout(function () { p.classList.remove('flick'); }, 680);
  }, 7000);

  /* ---------- three.js time core ---------- */
  (function () {
    var canvas = document.getElementById('ext3d'); if (!canvas || !window.THREE) return;
    var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
    renderer.setPixelRatio(Math.min(devicePixelRatio, 2)); renderer.setSize(innerWidth, innerHeight);
    var scene = new THREE.Scene(); scene.fog = new THREE.FogExp2(0x04090c, 0.045);
    var camera = new THREE.PerspectiveCamera(58, innerWidth / innerHeight, .1, 100); camera.position.set(0, 0, 24);

    var N = 800, pos = new Float32Array(N * 3), col = new Float32Array(N * 3);
    var pal = [[0, 1, .82], [1, .18, .42], [1, .72, .3], [.71, 1, .24]];
    for (var i = 0; i < N; i++) {
      pos[i * 3] = (Math.random() - .5) * 52; pos[i * 3 + 1] = (Math.random() - .5) * 30; pos[i * 3 + 2] = (Math.random() - .5) * 42 - 4;
      var c = pal[(Math.random() * pal.length) | 0]; col[i * 3] = c[0]; col[i * 3 + 1] = c[1]; col[i * 3 + 2] = c[2];
    }
    var pg = new THREE.BufferGeometry();
    pg.setAttribute('position', new THREE.BufferAttribute(pos, 3));
    pg.setAttribute('color', new THREE.BufferAttribute(col, 3));
    var pts = new THREE.Points(pg, new THREE.PointsMaterial({ size: .07, vertexColors: true, transparent: true, opacity: .8, blending: THREE.AdditiveBlending, depthWrite: false }));
    scene.add(pts);

    var core = new THREE.Group();
    var glass = new THREE.MeshBasicMaterial({ color: 0x00ffd0, wireframe: true, transparent: true, opacity: .6 });
    var sandMat = new THREE.MeshBasicMaterial({ color: 0xffb84d, wireframe: true, transparent: true, opacity: .5 });
    var top = new THREE.Mesh(new THREE.ConeGeometry(1.5, 2.4, 6, 1, true), glass);
    top.position.y = 1.3; top.rotation.z = Math.PI;
    var bottom = new THREE.Mesh(new THREE.ConeGeometry(1.5, 2.4, 6, 1, true), sandMat);
    bottom.position.y = -1.3;
    var band = new THREE.Mesh(new THREE.TorusGeometry(1.15, .07, 8, 48), new THREE.MeshBasicMaterial({ color: 0xff2d6a, transparent: true, opacity: .8 }));
    band.rotation.x = Math.PI / 2;
    core.add(top); core.add(bottom); core.add(band);
    core.position.z = -1;
    scene.add(core);

    var hand1 = new THREE.Mesh(new THREE.BoxGeometry(.08, 1.1, .08), new THREE.MeshBasicMaterial({ color: 0xb6ff3c, transparent: true, opacity: .8 }));
    hand1.position.y = .55;
    var handPivot = new THREE.Group(); handPivot.add(hand1); handPivot.position.set(0, 0, -1);
    scene.add(handPivot);
    var hand2 = new THREE.Mesh(new THREE.BoxGeometry(1.5, .08, .08), new THREE.MeshBasicMaterial({ color: 0x00ffd0, transparent: true, opacity: .6 }));
    hand2.position.x = .75;
    var handPivot2 = new THREE.Group(); handPivot2.add(hand2); handPivot2.position.set(0, 0, -1);
    scene.add(handPivot2);

    var ringA = new THREE.Mesh(new THREE.TorusGeometry(3.6, .05, 8, 80), new THREE.MeshBasicMaterial({ color: 0x00ffd0, wireframe: true, transparent: true, opacity: .26 }));
    ringA.position.z = -4; scene.add(ringA);
    var knot = new THREE.Mesh(new THREE.TorusKnotGeometry(1, .22, 64, 8), new THREE.MeshBasicMaterial({ color: 0xb44bff, wireframe: true, transparent: true, opacity: .2 }));
    knot.position.set(7.5, 3, -9); scene.add(knot);
    var octa = new THREE.Mesh(new THREE.OctahedronGeometry(1.4, 0), new THREE.MeshBasicMaterial({ color: 0xff2d6a, wireframe: true, transparent: true, opacity: .2 }));
    octa.position.set(-8, -3, -8); scene.add(octa);
    var grid = new THREE.GridHelper(80, 50, 0x00ffd0, 0x0a2a22); grid.material.transparent = true; grid.material.opacity = .28; grid.position.y = -7; scene.add(grid);

    var mx = 0, my = 0;
    addEventListener('mousemove', function (e) { mx = (e.clientX / innerWidth - .5) * 2; my = (e.clientY / innerHeight - .5) * 2; });
    addEventListener('resize', function () { camera.aspect = innerWidth / innerHeight; camera.updateProjectionMatrix(); renderer.setSize(innerWidth, innerHeight); });

    if (reduce) { renderer.render(scene, camera); return; }
    var clock = new THREE.Clock();
    (function loop() {
      requestAnimationFrame(loop);
      var t = clock.getElapsedTime();
      var boost = forge ? 2.4 : 0;
      core.rotation.y = t * (.5 + boost);
      core.rotation.x = Math.sin(t * .9) * .12;
      core.position.y = Math.sin(t * .9) * .3;
      band.rotation.z = t * (1.1 + boost);
      top.rotation.y = t * .4; bottom.rotation.y = -t * .4;
      handPivot.rotation.z = -t * (1.4 + boost);
      handPivot2.rotation.z = -t * (.24 + boost * .2);
      ringA.rotation.z = t * .3; ringA.rotation.x = Math.sin(t * .4) * .4;
      knot.rotation.x = t * .3; knot.rotation.y = t * .4;
      octa.rotation.x = t * .24; octa.rotation.y = t * .3;
      pts.rotation.y = t * .02;
      grid.position.z = (t * .5) % 1.6;
      camera.position.x += (mx * 2.4 - camera.position.x) * .045;
      camera.position.y += (-my * 1.6 - camera.position.y) * .045;
      camera.position.z += ((forge ? 13 : 24) - camera.position.z) * .03;
      camera.lookAt(0, 0, 0);
      renderer.render(scene, camera);
    })();
  })();

  /* ---------- form logic ---------- */
  var form = document.getElementById('extForm');
  if (!form) return;

  var scopeInput = document.getElementById('scopeInput');
  var modeInput = document.getElementById('modeInput');
  var scopeSwitch = document.getElementById('scopeSwitch');
  var modeSwitch = document.getElementById('modeSwitch');
  var singleWrap = document.getElementById('singleWrap');
  var allWrap = document.getElementById('allWrap');
  var amountGrid = document.getElementById('amountGrid');
  var exactGrid = document.getElementById('exactGrid');
  var targetSelect = document.getElementById('targetSelect');
  var amount = document.getElementById('amount');
  var unit = document.getElementById('unit');
  var exactDate = document.getElementById('exactDate');
  var extKeys = window.extKeys || {};

  function pad(n) { return (n < 10 ? '0' : '') + n; }
  function fmt(d) {
    if (!d || isNaN(d.getTime())) return 'UNSTARTED';
    return pad(d.getDate()) + ' ' + ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'][d.getMonth()] + ' ' + d.getFullYear() + ' · ' + pad(d.getHours()) + ':' + pad(d.getMinutes());
  }
  function parseDb(s) { return s ? new Date(String(s).replace(' ', 'T')) : null; }
  function hoursOf(amountVal, unitVal) { return Math.max(1, Math.round((parseFloat(amountVal) || 0) * (unitVal === 'days' ? 24 : 1))); }

  function currentKey() {
    return targetSelect ? extKeys[targetSelect.value] || null : null;
  }

  function paintCard() {
    var k = currentKey();
    if (!k) return;
    document.getElementById('kcKey').textContent = k.key;
    document.getElementById('kcStatus').textContent = k.status;
    document.getElementById('kcGame').textContent = k.game;
    document.getElementById('kcReg').textContent = k.registrator || '-';
    document.getElementById('kcDuration').textContent = k.duration + ' h';
    document.getElementById('kcDevices').textContent = k.devices + '/' + k.max;
    var exp = parseDb(k.expired);
    document.getElementById('kcExpired').textContent = exp ? fmt(exp) : 'NOT STARTED';
    var rem = exp ? (exp.getTime() - Date.now()) / 3600000 : null;
    var remEl = document.getElementById('kcRemaining');
    if (rem === null) { remEl.textContent = 'UNSTARTED'; remEl.className = 'gold'; }
    else if (rem <= 0) { remEl.textContent = 'EXPIRED'; remEl.className = 'rose'; }
    else { remEl.textContent = (rem >= 48 ? Math.floor(rem / 24) + 'd ' + Math.round(rem % 24) + 'h' : Math.round(rem) + 'h'); remEl.className = 'cyan'; }
  }

  function updatePreview() {
    var scope = scopeInput.value, mode = modeInput.value;
    var pvC = document.getElementById('pvCurrent'), pvN = document.getElementById('pvNext');
    if (mode === 'set') {
      var d = exactDate && exactDate.value ? new Date(exactDate.value) : null;
      pvC.textContent = scope === 'all' ? extKeys && Object.keys(extKeys).length + ' KEYS' : fmt(parseDb((currentKey() || {}).expired));
      pvN.textContent = d ? fmt(d) : 'PICK A DATE';
      return;
    }
    var h = hoursOf(amount && amount.value, unit && unit.value);
    if (scope === 'all') {
      pvC.textContent = Object.keys(extKeys).length + ' KEYS';
      pvN.textContent = (mode === 'add' ? '+' : '-') + h + ' HOURS · EACH';
      return;
    }
    var k = currentKey(); if (!k) return;
    var base = parseDb(k.expired);
    var next;
    if (mode === 'add') {
      next = new Date((base ? base.getTime() : Date.now()) + h * 3600000);
    } else {
      next = base ? new Date(Math.max(Date.now(), base.getTime() - h * 3600000)) : null;
    }
    pvC.textContent = base ? fmt(base) : 'UNSTARTED (' + k.duration + 'h)';
    pvN.textContent = next ? fmt(next) : 'DURATION ' + Math.max(1, k.duration - h) + 'h';
  }

  function setScope(scope) {
    scopeInput.value = scope;
    scopeSwitch.querySelectorAll('button').forEach(function (b) { b.classList.toggle('is-on', b.dataset.scope === scope); });
    singleWrap.style.display = scope === 'single' ? '' : 'none';
    allWrap.style.display = scope === 'all' ? '' : 'none';
    updatePreview();
  }

  function setMode(mode) {
    modeInput.value = mode;
    modeSwitch.querySelectorAll('button').forEach(function (b) {
      var on = b.dataset.mode === mode;
      b.classList.toggle('is-on', on);
      b.classList.toggle('rose', on && mode !== 'add');
    });
    amountGrid.style.display = mode === 'set' ? 'none' : '';
    exactGrid.style.display = mode === 'set' ? '' : 'none';
    updatePreview();
  }

  scopeSwitch.addEventListener('click', function (e) {
    var b = e.target.closest('button[data-scope]'); if (!b) return;
    setScope(b.dataset.scope);
  });
  modeSwitch.addEventListener('click', function (e) {
    var b = e.target.closest('button[data-mode]'); if (!b) return;
    setMode(b.dataset.mode);
  });
  [targetSelect, amount, unit, exactDate].forEach(function (el) {
    if (!el) return;
    el.addEventListener('change', function () { paintCard(); updatePreview(); });
    el.addEventListener('input', updatePreview);
  });
  if (targetSelect) targetSelect.addEventListener('change', paintCard);

  paintCard();
  updatePreview();

  /* ---------- overlay on submit ---------- */
  var overlay = document.getElementById('extForge');
  var pct = document.getElementById('forgePct');
  var submitting = false;

  form.addEventListener('submit', function (e) {
    if (submitting) return;
    e.preventDefault();
    if (scopeInput.value === 'all' && !window.confirm('Apply this time change to ALL ' + Object.keys(extKeys).length + ' keys? This cannot be undone.')) return;
    submitting = true;
    if (window.__extForge) window.__extForge();
    if (overlay) { overlay.classList.add('on'); overlay.setAttribute('aria-hidden', 'false'); }
    var p = 0;
    var t = setInterval(function () {
      p = Math.min(100, p + 6 + Math.random() * 9);
      if (pct) pct.textContent = Math.round(p) + '%';
      if (p >= 100) clearInterval(t);
    }, 70);
    setTimeout(function () { form.submit(); }, 1080);
  });
});
</script>
<?= $this->endSection() ?>
