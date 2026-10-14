<?php
    $apkTarget   = shopApkHref($cfg);
    if ($apkTarget === '') {
        $apkTarget = site_url('shop/loader');
    }
    $loaderName  = $cfg['loader_name'] ?? 'BLACK BUNNY';
    $loaderSize  = $cfg['loader_size'] ?? '~12 MB';
    $loaderGame  = $cfg['loader_game'] ?? 'Android 8+';
    $waNum       = waDigits((string) ($cfg['owner_whatsapp'] ?? ($cfg['admin_whatsapp'] ?? '')));
    $waHref      = $waNum !== '' ? 'https://wa.me/' . $waNum : '';
    $tgHref      = trim((string) ($cfg['telegram_url'] ?? ''));
    $contactHref = $waHref !== '' ? $waHref : ($tgHref !== '' ? $tgHref : site_url('shop/legal/contact'));
    $lanes       = $plans ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BLACK BUNNY &mdash; Premium APK Licenses</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Rajdhani:wght@400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#04090c; --panel:rgba(8,18,22,.65); --line:rgba(0,255,200,.18);
  --neon:#00ffc8; --lime:#b6ff3c; --purple:#b44bff; --orange:#ffb84d; --red:#ff4d6b;
  --text:#d9ece7; --dim:#7fa39b;
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{background:var(--bg);color:var(--text);font-family:'Rajdhani',sans-serif;overflow-x:hidden;cursor:none}
@media(hover:none){body{cursor:auto}}
::selection{background:var(--neon);color:#000}
section{scroll-margin-top:80px}

/* ===== CUSTOM CURSOR ===== */
#curDot,#curRing{position:fixed;top:0;left:0;pointer-events:none;z-index:999;border-radius:50%;transform:translate(-50%,-50%)}
#curDot{width:8px;height:8px;background:var(--neon);box-shadow:0 0 12px var(--neon)}
#curRing{width:36px;height:36px;border:1px solid rgba(0,255,200,.5);transition:width .25s,height .25s,border-color .25s}
body.hovering #curRing{width:56px;height:56px;border-color:var(--lime)}
@media(hover:none){#curDot,#curRing{display:none}}

/* ===== SCROLL PROGRESS ===== */
#sProg{position:fixed;top:0;left:0;height:3px;width:0;z-index:200;
  background:linear-gradient(90deg,var(--neon),var(--lime),var(--purple));box-shadow:0 0 12px var(--neon)}

/* ===== BACK TO TOP ===== */
#toTop{position:fixed;bottom:24px;right:24px;width:52px;height:52px;z-index:90;cursor:none;
  background:rgba(4,9,12,.8);border-radius:50%;display:grid;place-items:center;border:1px solid var(--line);
  opacity:0;pointer-events:none;transition:.35s;backdrop-filter:blur(8px)}
#toTop.show{opacity:1;pointer-events:auto}
#toTop:hover{border-color:var(--neon)}
#toTop svg{position:absolute;inset:0;transform:rotate(-90deg)}
#toTop circle{fill:none;stroke:var(--neon);stroke-width:2;stroke-dasharray:151;stroke-dashoffset:151}
#toTop .arr{color:var(--neon);font-size:18px;font-family:'Orbitron'}
@media(hover:none){#toTop{cursor:pointer}}

/* ===== BG FX ===== */
#bg3d{position:fixed;inset:0;z-index:0;pointer-events:none}
.orb{position:fixed;border-radius:50%;filter:blur(100px);opacity:.3;z-index:0;pointer-events:none;animation:drift 16s ease-in-out infinite alternate}
.orb1{width:440px;height:440px;background:var(--purple);top:-120px;right:-100px}
.orb2{width:380px;height:380px;background:var(--neon);bottom:-140px;left:-120px;animation-delay:-6s}
.orb3{width:300px;height:300px;background:var(--red);top:40%;left:60%;opacity:.12;animation-delay:-3s}
@keyframes drift{to{transform:translate(50px,70px) scale(1.2)}}
.scanlines{position:fixed;inset:0;z-index:1;pointer-events:none;opacity:.4;
  background:repeating-linear-gradient(0deg,transparent 0 3px,rgba(0,0,0,.12) 3px 4px)}
.vig{position:fixed;inset:0;z-index:1;pointer-events:none;background:radial-gradient(ellipse at center,transparent 55%,rgba(0,0,0,.5))}
.wrap{position:relative;z-index:2;max-width:1150px;margin:0 auto;padding:0 22px}

/* ===== NAV ===== */
header{position:sticky;top:0;z-index:50;backdrop-filter:blur(14px);background:rgba(4,9,12,.72);border-bottom:1px solid var(--line)}
.nav{display:flex;align-items:center;justify-content:space-between;padding:14px 22px;max-width:1150px;margin:0 auto}
.brand{display:flex;gap:12px;align-items:center}
.hex{width:46px;height:46px;display:grid;place-items:center;font-family:'Orbitron';font-weight:900;color:var(--neon);flex-shrink:0;
  clip-path:polygon(50% 0,100% 25%,100% 75%,50% 100%,0 75%,0 25%);
  background:linear-gradient(135deg,rgba(0,255,200,.15),rgba(180,75,255,.15));border:1px solid var(--line);
  animation:hexPulse 3s ease-in-out infinite}
@keyframes hexPulse{50%{box-shadow:0 0 25px rgba(0,255,200,.45)}}
.brand h1{font-family:'Orbitron';font-size:16px;letter-spacing:3px}
.brand small{color:var(--lime);letter-spacing:3px;font-size:9px;font-weight:600}
.menu-btn{font-family:'Orbitron';letter-spacing:3px;color:var(--neon);background:transparent;border:1px solid var(--neon);padding:10px 24px;cursor:none;transition:.3s}
@media(hover:none){.menu-btn{cursor:pointer}}
.menu-btn:hover{background:var(--neon);color:#000;box-shadow:0 0 30px rgba(0,255,200,.5)}
#navlinks{display:none;flex-direction:column;gap:4px;padding:10px 22px 18px;border-top:1px solid var(--line)}
#navlinks.open{display:flex}
#navlinks a{color:var(--text);text-decoration:none;font-family:'Orbitron';font-size:12px;letter-spacing:2px;padding:10px 12px;border-radius:6px;transition:.25s}
#navlinks a:hover{color:var(--neon);background:rgba(0,255,200,.08);padding-left:18px}

/* ===== BUTTONS + FIRE ANIMATION ===== */
.btn{font-family:'Orbitron';letter-spacing:2px;font-size:13px;padding:16px 30px;cursor:none;border:none;transition:.3s;text-decoration:none;display:inline-block;position:relative;overflow:hidden}
@media(hover:none){.btn{cursor:pointer}}
.btn:active{transform:scale(.95)}
.btn-fill{background:linear-gradient(90deg,var(--neon),var(--lime));color:#03110c;font-weight:700}
.btn-fill:hover{transform:translateY(-3px);box-shadow:0 10px 40px rgba(0,255,200,.45)}
.btn-ghost{background:transparent;color:var(--neon);border:1px solid var(--neon)}
.btn-ghost:hover{background:rgba(0,255,200,.1);box-shadow:0 0 25px rgba(0,255,200,.3)}
.btn-purple{background:linear-gradient(90deg,var(--purple),#ff6bf0);color:#fff;font-weight:700}
.btn-purple:hover{transform:translateY(-3px);box-shadow:0 10px 40px rgba(180,75,255,.5)}
.btn-lime{background:transparent;color:var(--lime);border:1px solid var(--lime)}
.btn-lime:hover{background:rgba(182,255,60,.1);box-shadow:0 0 25px rgba(182,255,60,.35)}
.ripple{position:absolute;border-radius:50%;background:rgba(255,255,255,.5);transform:scale(0);animation:rip .6s ease-out;pointer-events:none}
@keyframes rip{to{transform:scale(4);opacity:0}}
.shine::after{content:'';position:absolute;top:0;left:-80%;width:60%;height:100%;
  background:linear-gradient(100deg,transparent,rgba(255,255,255,.35),transparent);transform:skewX(-25deg);animation:shine 3.5s infinite}
@keyframes shine{0%{left:-80%}55%,100%{left:130%}}

/* FIRE BURST on tap */
.btn.firing{animation:fireFlash .6s ease}
@keyframes fireFlash{
  0%{filter:brightness(1)}
  20%{filter:brightness(1.8);box-shadow:0 0 30px rgba(255,150,0,.95),0 0 70px rgba(255,60,0,.55)}
  45%{filter:brightness(1.15)}
  70%{filter:brightness(1.6);box-shadow:0 0 26px rgba(255,150,0,.8),0 0 55px rgba(255,60,0,.4)}
  100%{filter:brightness(1)}
}
.flame{position:fixed;border-radius:50%;pointer-events:none;z-index:998;
  background:radial-gradient(circle,#fff3b0,#ff9d00 50%,#ff3d00 80%,transparent);
  box-shadow:0 0 8px rgba(255,120,0,.9)}

/* ===== HERO ===== */
.hero{padding:80px 0 40px;display:grid;grid-template-columns:1.15fr .85fr;gap:40px;align-items:center}
@media(max-width:860px){.hero{grid-template-columns:1fr;padding:56px 0 30px}}
.tag{display:inline-block;font-family:'Share Tech Mono';color:var(--lime);border:1px solid rgba(182,255,60,.4);
  padding:7px 18px;letter-spacing:4px;font-size:12px;background:rgba(182,255,60,.05);margin-bottom:22px;animation:tagGlow 2.5s ease-in-out infinite}
@keyframes tagGlow{50%{box-shadow:0 0 20px rgba(182,255,60,.25)}}
.hero h2{font-family:'Orbitron';font-weight:900;font-size:clamp(38px,7vw,72px);line-height:1.05;letter-spacing:2px}
.hero h2 .grad{background:linear-gradient(90deg,var(--neon),var(--lime));-webkit-background-clip:text;background-clip:text;color:transparent;
  background-size:200%;animation:gradMove 4s linear infinite}
@keyframes gradMove{to{background-position:200%}}
.hero .type{color:var(--dim);font-size:19px;margin:18px 0 8px;min-height:52px;max-width:560px}
.hero .type .caret{display:inline-block;width:10px;background:var(--neon);margin-left:2px;animation:blinkC .8s infinite}
@keyframes blinkC{50%{opacity:0}}

/* GLITCH */
.glitch{position:relative;display:inline-block}
.glitch::before,.glitch::after{content:attr(data-text);position:absolute;left:0;top:0;width:100%;opacity:0;pointer-events:none}
.glitch::before{color:var(--neon);animation:glA 4s infinite}
.glitch::after{color:var(--purple);animation:glB 4s infinite}
@keyframes glA{0%,88%,100%{opacity:0}90%{opacity:.7;transform:translate(-4px,2px);clip-path:inset(10% 0 55% 0)}94%{opacity:.7;transform:translate(3px,-2px);clip-path:inset(60% 0 10% 0)}97%{opacity:0}}
@keyframes glB{0%,89%,100%{opacity:0}91%{opacity:.7;transform:translate(4px,-1px);clip-path:inset(40% 0 30% 0)}95%{opacity:.6;transform:translate(-3px,1px);clip-path:inset(5% 0 70% 0)}98%{opacity:0}}

/* quick action buttons */
.quick{display:grid;grid-template-columns:repeat(2,minmax(150px,1fr));gap:12px;margin-top:28px;max-width:520px}
@media(max-width:420px){.quick{grid-template-columns:1fr}}
.quick .btn{text-align:center;padding:15px 12px;font-size:12px}

.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:12px;margin-top:34px}
.stat{background:var(--panel);border:1px solid var(--line);border-radius:12px;padding:16px 10px;text-align:center;backdrop-filter:blur(8px);transition:.3s;position:relative;overflow:hidden}
.stat:hover{border-color:var(--neon);transform:translateY(-4px)}
.stat .num{font-family:'Orbitron';font-weight:900;font-size:24px;color:var(--lime);display:block;text-shadow:0 0 18px rgba(182,255,60,.4)}
.stat label{font-family:'Share Tech Mono';font-size:9px;letter-spacing:2px;color:var(--dim)}

/* ===== PHONE MOCKUP ===== */
.phone-zone{display:flex;justify-content:center;perspective:1000px}
.phone{width:250px;height:500px;border-radius:36px;border:2px solid rgba(0,255,200,.35);position:relative;
  background:linear-gradient(160deg,#071512,#040a08);box-shadow:0 30px 80px rgba(0,0,0,.6),0 0 50px rgba(0,255,200,.12),inset 0 0 30px rgba(0,255,200,.04);
  transform-style:preserve-3d;animation:phoneFloat 5s ease-in-out infinite}
@keyframes phoneFloat{50%{transform:translateY(-14px) rotateZ(.5deg)}}
.phone .notch{position:absolute;top:12px;left:50%;transform:translateX(-50%);width:80px;height:8px;border-radius:6px;background:#0a1f1a;border:1px solid var(--line)}
.scr{position:absolute;inset:22px 14px 18px;display:flex;flex-direction:column;gap:12px;overflow:hidden}
.scr-head{display:flex;align-items:center;gap:10px;border-bottom:1px solid var(--line);padding-bottom:10px}
.scr-hex{width:34px;height:34px;display:grid;place-items:center;font-family:'Orbitron';font-size:11px;font-weight:900;color:var(--neon);flex-shrink:0;
  clip-path:polygon(50% 0,100% 25%,100% 75%,50% 100%,0 75%,0 25%);background:linear-gradient(135deg,rgba(0,255,200,.2),rgba(180,75,255,.2))}
.scr-head b{font-family:'Orbitron';font-size:12px;letter-spacing:2px}
.scr-head small{display:block;color:var(--lime);font-size:8px;letter-spacing:2px}
.scr-chip{font-family:'Share Tech Mono';font-size:10px;letter-spacing:1px;color:var(--neon);border:1px solid var(--line);border-radius:6px;padding:8px 10px;display:flex;justify-content:space-between;gap:8px}
.scr-chip span:last-child{color:var(--lime)}
.scr-bar{height:6px;border-radius:4px;background:rgba(0,255,200,.1);overflow:hidden}
.scr-bar i{display:block;height:100%;border-radius:4px;background:linear-gradient(90deg,var(--neon),var(--lime));width:0;animation:barFill 2.4s ease forwards}
@keyframes barFill{to{width:var(--w,80%)}}
.scr-key{margin-top:auto;border:1px dashed rgba(0,255,200,.4);border-radius:10px;padding:12px;text-align:center;
  font-family:'Share Tech Mono';font-size:12px;letter-spacing:3px;color:var(--neon);text-shadow:0 0 12px rgba(0,255,200,.5);animation:holo 3s linear infinite}
@keyframes holo{50%{box-shadow:0 0 22px rgba(0,255,200,.25)}}
.scr-btn{background:linear-gradient(90deg,var(--neon),var(--lime));color:#03110c;font-family:'Orbitron';font-size:10px;letter-spacing:2px;font-weight:700;text-align:center;padding:10px;border-radius:8px}

/* ===== TICKER ===== */
.ticker{border-top:1px solid var(--line);border-bottom:1px solid var(--line);background:rgba(0,255,200,.03);overflow:hidden;position:relative;z-index:2;margin:34px 0}
.tk{display:flex;width:max-content;animation:tick 26s linear infinite}
.tk span{font-family:'Share Tech Mono';letter-spacing:3px;font-size:12px;color:var(--dim);padding:13px 28px;white-space:nowrap}
.tk span b{color:var(--neon);font-weight:400}
@keyframes tick{to{transform:translateX(-50%)}}

/* ===== COUNTDOWN ===== */
.drop{display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap;margin:10px 0 40px;
  background:linear-gradient(120deg,rgba(180,75,255,.12),rgba(0,255,200,.08));border:1px solid rgba(180,75,255,.35);border-radius:16px;padding:26px 30px;position:relative;overflow:hidden}
.drop::before{content:'';position:absolute;inset:-2px;background:linear-gradient(120deg,transparent 30%,rgba(255,255,255,.08) 50%,transparent 70%);
  background-size:200% 100%;animation:sweep 3.5s linear infinite}
@keyframes sweep{to{background-position:-200% 0}}
.drop h3{font-family:'Orbitron';font-size:clamp(16px,3vw,22px);letter-spacing:2px}
.drop p{color:var(--dim);font-size:14px;margin-top:4px}
.cd{display:flex;gap:10px}
.cd div{background:#050f0c;border:1px solid var(--line);border-radius:10px;min-width:64px;padding:10px 6px;text-align:center}
.cd b{font-family:'Orbitron';font-size:24px;color:var(--lime);display:block;text-shadow:0 0 14px rgba(182,255,60,.5)}
.cd label{font-family:'Share Tech Mono';font-size:9px;letter-spacing:2px;color:var(--dim)}

/* ===== SECTION HEADS ===== */
section{padding:46px 0}
.kicker{font-family:'Share Tech Mono';color:var(--lime);letter-spacing:5px;font-size:13px;margin-bottom:10px;display:flex;align-items:center;gap:10px}
.kicker::before{content:'';width:26px;height:1px;background:var(--lime);display:inline-block}
.sec-title{font-family:'Orbitron';font-weight:900;font-size:clamp(26px,4.5vw,40px);letter-spacing:1px;margin-bottom:28px}

/* ===== CARDS ===== */
.card{background:var(--panel);border:1px solid var(--line);border-radius:14px;padding:34px;backdrop-filter:blur(10px);
  transition:transform .25s ease-out,box-shadow .3s;will-change:transform;position:relative;overflow:hidden}
.card::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--neon),transparent);opacity:.6}
.card:hover{box-shadow:0 20px 60px rgba(0,255,200,.12)}
.chips{display:flex;gap:10px;flex-wrap:wrap;margin:22px 0}
.chip{font-family:'Share Tech Mono';font-size:12px;letter-spacing:1px;padding:8px 14px;border:1px solid var(--line);border-radius:6px;color:var(--dim)}
.chip b{color:var(--neon);font-weight:400}

/* 3D cube */
.pkg-grid{display:grid;grid-template-columns:1fr auto;gap:36px;align-items:center}
@media(max-width:860px){.pkg-grid{grid-template-columns:1fr}}
.cube-zone{display:flex;justify-content:center;perspective:800px}
.cube{width:120px;height:120px;position:relative;transform-style:preserve-3d;animation:cubeSpin 9s linear infinite;margin:40px}
@keyframes cubeSpin{from{transform:rotateX(-18deg) rotateY(0)}to{transform:rotateX(-18deg) rotateY(360deg)}}
.cube i{position:absolute;inset:0;display:grid;place-items:center;font-family:'Orbitron';font-weight:900;font-size:34px;font-style:normal;
  border:1px solid rgba(0,255,200,.5);background:rgba(0,255,200,.06);color:var(--neon);text-shadow:0 0 14px rgba(0,255,200,.7);
  box-shadow:inset 0 0 30px rgba(0,255,200,.1)}
.cube i:nth-child(1){transform:translateZ(60px)}
.cube i:nth-child(2){transform:rotateY(180deg) translateZ(60px)}
.cube i:nth-child(3){transform:rotateY(90deg) translateZ(60px)}
.cube i:nth-child(4){transform:rotateY(-90deg) translateZ(60px)}
.cube i:nth-child(5){transform:rotateX(90deg) translateZ(60px)}
.cube i:nth-child(6){transform:rotateX(-90deg) translateZ(60px)}

/* ===== APK DOWNLOAD ===== */
.dl-grid{display:grid;grid-template-columns:1.2fr .8fr;gap:20px}
@media(max-width:860px){.dl-grid{grid-template-columns:1fr}}
.dl-main{background:var(--panel);border:1px solid rgba(0,255,200,.3);border-radius:14px;padding:34px;backdrop-filter:blur(10px);position:relative;overflow:hidden;transition:.3s}
.dl-main:hover{box-shadow:0 20px 60px rgba(0,255,200,.15)}
.dl-main::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--neon),var(--lime))}
.dl-ver{font-family:'Orbitron';font-weight:900;font-size:clamp(24px,4vw,34px);color:var(--text);letter-spacing:1px;margin:6px 0 4px}
.dl-ver span{color:var(--lime);text-shadow:0 0 16px rgba(182,255,60,.5)}
.dl-meta{display:flex;gap:10px;flex-wrap:wrap;margin:18px 0 24px}
.mini-steps{display:grid;gap:10px}
.mini-step{display:flex;gap:14px;align-items:center;background:var(--panel);border:1px solid var(--line);border-radius:10px;padding:14px 18px;transition:.3s}
.mini-step:hover{border-color:var(--neon);transform:translateX(6px)}
.mini-step b{font-family:'Orbitron';font-size:20px;color:transparent;-webkit-text-stroke:1px var(--neon);flex-shrink:0}
.mini-step p{color:var(--dim);font-size:15px}
.mini-step p strong{color:var(--text);font-family:'Orbitron';font-size:12px;letter-spacing:2px;display:block;margin-bottom:2px}

/* ===== PANEL LOGIN ===== */
.login-box{max-width:460px;margin:0 auto;background:rgba(3,12,10,.88);border:1px solid rgba(180,75,255,.4);border-radius:14px;overflow:hidden;
  box-shadow:0 0 60px rgba(180,75,255,.1);font-family:'Share Tech Mono';display:block}
.l-head{display:flex;align-items:center;gap:8px;padding:13px 18px;border-bottom:1px solid var(--line);letter-spacing:2px;font-size:12px;color:var(--dim)}
.l-live{margin-left:auto;color:var(--lime);font-size:11px;animation:blinkL 1.4s infinite}
@keyframes blinkL{50%{opacity:.3}}
.dot{width:10px;height:10px;border-radius:50%}
.r{background:#ff5f56}.y{background:#ffbd2e}.g{background:#27c93f}
.l-body{padding:28px}
.l-field{margin-bottom:16px}
.l-field label{display:block;font-size:11px;letter-spacing:2px;color:var(--dim);margin-bottom:7px}
.l-field input{width:100%;background:#02110d;border:1px solid var(--line);color:var(--neon);font-family:'Share Tech Mono';padding:13px 14px;border-radius:8px;outline:none;font-size:14px;transition:.25s}
.l-field input:focus{border-color:var(--purple);box-shadow:0 0 14px rgba(180,75,255,.3)}
.l-note{color:var(--dim);font-size:12px;letter-spacing:1px;margin-top:16px;text-align:center}
.l-note a{color:var(--purple);text-decoration:none}
.l-note a:hover{text-decoration:underline}

/* ===== FEATURES ===== */
.feat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px}
.feat{background:var(--panel);border:1px solid var(--line);border-radius:12px;padding:24px;transition:.35s;position:relative;overflow:hidden}
.feat::after{content:'';position:absolute;inset:0;background:radial-gradient(220px circle at var(--mx,50%) var(--my,50%),rgba(0,255,200,.1),transparent 65%);opacity:0;transition:.3s}
.feat:hover::after{opacity:1}
.feat:hover{border-color:var(--neon);transform:translateY(-6px)}
.feat .ico{font-family:'Share Tech Mono';font-size:14px;letter-spacing:2px;color:var(--neon);margin-bottom:12px;display:inline-block;border:1px solid var(--line);border-radius:6px;padding:6px 10px}
.feat h4{font-family:'Orbitron';font-size:12px;letter-spacing:2px;color:var(--neon);margin-bottom:8px}
.feat p{color:var(--dim);font-size:15px}

/* ===== PRICING ===== */
.lanes{display:grid;grid-template-columns:repeat(auto-fit,minmax(225px,1fr));gap:18px}
.lane{background:var(--panel);border:1px solid var(--line);border-radius:14px;padding:28px;backdrop-filter:blur(10px);
  transition:transform .25s ease-out,box-shadow .3s,border-color .3s;position:relative;display:flex;flex-direction:column;overflow:hidden}
.lane:hover{border-color:var(--neon);box-shadow:0 18px 50px rgba(0,255,200,.15)}
.lane .plan{font-family:'Share Tech Mono';color:var(--neon);letter-spacing:3px;font-size:12px}
.lane h3{font-family:'Orbitron';font-size:18px;margin:10px 0 4px}
.lane .dur{color:var(--dim)}
.lane .price{font-family:'Orbitron';font-weight:900;font-size:36px;color:var(--lime);margin:16px 0 4px;text-shadow:0 0 20px rgba(182,255,60,.4)}
.lane .dev{color:var(--dim);font-size:14px;margin-bottom:20px}
.lane .btn{width:100%;text-align:center;padding:14px;font-size:12px;margin-top:auto}
.lane.hot::after{content:'POPULAR';position:absolute;top:14px;right:-32px;background:linear-gradient(90deg,var(--neon),var(--lime));
  color:#03110c;font-family:'Orbitron';font-size:9px;letter-spacing:2px;padding:5px 36px;transform:rotate(40deg);font-weight:700}
.lane.panel-card{border-color:rgba(180,75,255,.4);background:linear-gradient(160deg,rgba(180,75,255,.1),var(--panel))}
.lane.panel-card:hover{border-color:var(--purple);box-shadow:0 18px 50px rgba(180,75,255,.2)}
.lane.panel-card .plan{color:var(--purple)}
.lane.panel-card .price{color:#d98cff;text-shadow:0 0 20px rgba(180,75,255,.5)}
.lane-empty{grid-column:1/-1;text-align:center;color:var(--dim);font-family:'Share Tech Mono';letter-spacing:2px;padding:30px;border:1px dashed var(--line);border-radius:14px}

/* ===== COMPARISON ===== */
.cmp{display:grid;grid-template-columns:1fr 1fr;gap:18px;max-width:760px;margin:0 auto}
@media(max-width:640px){.cmp{grid-template-columns:1fr}}
.cmp-col{background:var(--panel);border:1px solid var(--line);border-radius:14px;padding:28px;transition:.3s}
.cmp-col:hover{transform:translateY(-5px)}
.cmp-col.k{border-top:3px solid var(--neon)}
.cmp-col.p{border-top:3px solid var(--purple)}
.cmp-col h4{font-family:'Orbitron';font-size:15px;letter-spacing:2px;margin-bottom:16px}
.cmp-col.k h4{color:var(--neon)}.cmp-col.p h4{color:#d98cff}
.cmp-col li{list-style:none;color:var(--dim);font-size:15px;padding:9px 0 9px 26px;position:relative;border-bottom:1px dashed rgba(0,255,200,.1)}
.cmp-col li::before{content:'>';position:absolute;left:2px;color:var(--lime);font-family:'Share Tech Mono'}
.cmp-col.p li::before{color:var(--purple)}

/* ===== FEEDBACK MEDIA ===== */
.media-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;margin-bottom:24px}
.shot{position:relative;border-radius:12px;overflow:hidden;border:1px solid var(--line);aspect-ratio:4/3;cursor:none;
  background:linear-gradient(135deg,#07171a,#0b1224 60%,#150b24);display:grid;place-items:center;transition:.35s}
@media(hover:none){.shot{cursor:pointer}}
.shot:hover{border-color:var(--neon);transform:translateY(-6px);box-shadow:0 16px 44px rgba(0,255,200,.15)}
.shot .ph-ico{font-family:'Share Tech Mono';font-size:22px;color:var(--dim);letter-spacing:3px;opacity:.85}
.shot .ph-label{position:absolute;bottom:10px;left:0;right:0;text-align:center;font-family:'Share Tech Mono';font-size:10px;letter-spacing:3px;color:var(--dim)}
.shot img,.shot video{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:.4s}
.shot:hover img,.shot:hover video{transform:scale(1.08)}
.vid-box{position:relative;border-radius:14px;overflow:hidden;border:1px solid rgba(180,75,255,.4);aspect-ratio:16/9;cursor:none;
  background:linear-gradient(135deg,#0a0614,#07171a);display:grid;place-items:center;transition:.35s;margin-bottom:10px}
@media(hover:none){.vid-box{cursor:pointer}}
.vid-box:hover{border-color:var(--purple);box-shadow:0 16px 50px rgba(180,75,255,.2)}
.vid-box .play{width:74px;height:74px;border-radius:50%;background:linear-gradient(135deg,var(--purple),#ff6bf0);display:grid;place-items:center;
  box-shadow:0 0 34px rgba(180,75,255,.6);animation:playPulse 2s ease-in-out infinite;position:relative;z-index:2}
.vid-box .play svg{margin-left:5px}
@keyframes playPulse{50%{transform:scale(1.12)}}
.vid-box .vid-label{position:absolute;bottom:14px;left:0;right:0;text-align:center;font-family:'Share Tech Mono';font-size:11px;letter-spacing:3px;color:var(--dim);z-index:2}
.vid-box::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 50% 45%,rgba(180,75,255,.18),transparent 55%)}

/* lightbox */
#lb{position:fixed;inset:0;z-index:120;background:rgba(1,4,6,.92);backdrop-filter:blur(6px);display:none;align-items:center;justify-content:center;padding:24px}
#lb.open{display:flex}
#lb .lb-media{max-width:min(1000px,92vw);max-height:86vh;border:1px solid var(--line);border-radius:12px;overflow:hidden;background:#020a08}
#lb img,#lb video{display:block;max-width:min(1000px,92vw);max-height:86vh;object-fit:contain}
#lb .lb-cap{position:absolute;bottom:26px;left:0;right:0;text-align:center;font-family:'Share Tech Mono';font-size:12px;letter-spacing:2px;color:var(--dim)}
#lb .lb-x{position:absolute;top:22px;right:26px;width:44px;height:44px;border-radius:50%;border:1px solid var(--line);background:rgba(4,9,12,.8);color:var(--neon);font-family:'Orbitron';cursor:none}
@media(hover:none){#lb .lb-x{cursor:pointer}}

/* ===== REVIEWS ===== */
.rev-wrap{overflow:hidden;position:relative;padding:6px 0}
.rev-wrap::before,.rev-wrap::after{content:'';position:absolute;top:0;bottom:0;width:90px;z-index:3;pointer-events:none}
.rev-wrap::before{left:0;background:linear-gradient(90deg,var(--bg),transparent)}
.rev-wrap::after{right:0;background:linear-gradient(-90deg,var(--bg),transparent)}
.rev-track{display:flex;gap:16px;width:max-content;animation:revScroll 30s linear infinite}
.rev-wrap:hover .rev-track{animation-play-state:paused}
@keyframes revScroll{to{transform:translateX(-50%)}}
.rev{width:290px;background:var(--panel);border:1px solid var(--line);border-radius:12px;padding:22px;flex-shrink:0}
.rev .stars{color:var(--lime);letter-spacing:3px;margin-bottom:10px}
.rev p{color:var(--dim);font-size:14px;margin-bottom:12px}
.rev b{font-family:'Orbitron';font-size:11px;letter-spacing:2px;color:var(--neon)}

/* ===== TERMINAL PANEL ===== */
.terminal{background:rgba(3,12,10,.88);border:1px solid rgba(0,255,200,.35);border-radius:14px;overflow:hidden;max-width:780px;margin:0 auto;
  box-shadow:0 0 60px rgba(0,255,200,.08),inset 0 0 80px rgba(0,255,200,.03);font-family:'Share Tech Mono';position:relative}
#matrix{position:absolute;inset:0;opacity:.07;pointer-events:none}
.t-head{display:flex;align-items:center;gap:8px;padding:13px 18px;border-bottom:1px solid var(--line);letter-spacing:2px;font-size:12px;color:var(--dim);flex-wrap:wrap;position:relative;z-index:2}
.t-live{margin-left:auto;color:var(--lime);font-size:11px;animation:blinkL 1.4s infinite}
.t-body{padding:24px;position:relative;z-index:2}
.t-line{color:var(--neon);letter-spacing:2px;font-size:12px;margin:18px 0 10px}
.t-line:first-child{margin-top:0}
.t-dim{color:var(--dim);font-size:13px;line-height:1.7}
.t-foot{border-top:1px solid var(--line);padding:11px 18px;font-size:11px;letter-spacing:2px;color:var(--dim);display:flex;gap:18px;flex-wrap:wrap;position:relative;z-index:2}
.t-log{color:var(--neon)}

/* ===== STEPS ===== */
.steps{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;counter-reset:st}
.step{background:var(--panel);border:1px solid var(--line);border-radius:12px;padding:26px;position:relative;transition:.3s}
.step:hover{border-color:var(--neon);transform:translateY(-4px)}
.step::before{counter-increment:st;content:"0" counter(st);font-family:'Orbitron';font-weight:900;font-size:30px;
  color:transparent;-webkit-text-stroke:1px var(--neon);display:block;margin-bottom:12px}
.step h4{font-family:'Orbitron';font-size:13px;letter-spacing:2px;margin-bottom:6px}
.step p{color:var(--dim);font-size:14px}

/* ===== CHANGELOG ===== */
.tl{position:relative;max-width:640px;margin:0 auto;padding-left:30px}
.tl::before{content:'';position:absolute;left:8px;top:6px;bottom:6px;width:2px;background:linear-gradient(180deg,var(--neon),var(--purple));border-radius:2px}
.tl-item{position:relative;padding:0 0 30px 22px}
.tl-item::before{content:'';position:absolute;left:-30px;top:4px;width:18px;height:18px;border-radius:50%;
  background:#04090c;border:2px solid var(--neon);box-shadow:0 0 14px rgba(0,255,200,.5)}
.tl-item h4{font-family:'Orbitron';font-size:14px;letter-spacing:2px;color:var(--lime)}
.tl-item .dt{font-family:'Share Tech Mono';font-size:11px;color:var(--dim);letter-spacing:2px;margin:4px 0 8px}
.tl-item p{color:var(--dim);font-size:15px}

/* ===== FAQ ===== */
details{background:var(--panel);border:1px solid var(--line);border-radius:10px;margin-bottom:12px;overflow:hidden}
summary{cursor:none;padding:18px 22px;font-family:'Orbitron';font-size:13px;letter-spacing:1px;list-style:none;display:flex;justify-content:space-between;align-items:center;transition:.25s}
@media(hover:none){summary{cursor:pointer}}
summary:hover{color:var(--neon)}
summary::after{content:'+';color:var(--neon);font-size:18px;transition:.3s}
details[open] summary::after{transform:rotate(45deg)}
details p{padding:0 22px 18px;color:var(--dim);font-size:15px}

/* ===== CTA ===== */
.cta{margin:40px 0;border-radius:18px;padding:50px 30px;text-align:center;position:relative;overflow:hidden;
  background:linear-gradient(120deg,rgba(0,255,200,.1),rgba(180,75,255,.12));border:1px solid rgba(0,255,200,.3)}
.cta h3{font-family:'Orbitron';font-weight:900;font-size:clamp(24px,5vw,42px);letter-spacing:3px;margin-bottom:14px;
  background:linear-gradient(90deg,var(--neon),var(--lime),var(--purple));background-size:200%;-webkit-background-clip:text;background-clip:text;color:transparent;animation:gradMove 3s linear infinite}
.cta p{color:var(--dim);margin-bottom:26px;font-size:17px}

/* ===== FOOTER ===== */
footer{border-top:1px solid var(--line);padding:34px 22px;text-align:center;position:relative;z-index:2}
footer .flinks{display:flex;gap:26px;justify-content:center;flex-wrap:wrap;margin-bottom:14px}
footer a{color:var(--dim);text-decoration:none;font-size:14px;transition:.25s}
footer a:hover{color:var(--neon)}
footer .cp{color:var(--dim);font-family:'Share Tech Mono';font-size:12px;letter-spacing:2px}

/* ===== REVEAL / TOAST ===== */
.reveal{opacity:0;transform:translateY(40px);transition:opacity .8s cubic-bezier(.2,.7,.3,1),transform .8s cubic-bezier(.2,.7,.3,1)}
.reveal.in{opacity:1;transform:none}
.reveal.d1{transition-delay:.1s}.reveal.d2{transition-delay:.2s}.reveal.d3{transition-delay:.3s}
#toast{position:fixed;bottom:26px;left:50%;transform:translate(-50%,80px);background:#0a1a16;border:1px solid var(--neon);
  color:var(--neon);font-family:'Share Tech Mono';letter-spacing:1px;padding:13px 26px;border-radius:8px;z-index:99;transition:.4s;opacity:0;font-size:13px}
#toast.show{transform:translate(-50%,0);opacity:1;box-shadow:0 0 30px rgba(0,255,200,.3)}

@media(max-width:640px){.nav{padding:12px 16px}.card{padding:24px}.t-body{padding:18px}.drop{padding:22px}.l-body{padding:20px}}
@media(prefers-reduced-motion:reduce){*{animation-duration:.001ms!important;animation-iteration-count:1!important;transition-duration:.001ms!important}}
</style>
</head>
<body>
<?= view('Layout/WelcomeSplash') ?>

<div id="curDot"></div><div id="curRing"></div>
<div id="sProg"></div>

<canvas id="bg3d"></canvas>
<div class="orb orb1"></div><div class="orb orb2"></div><div class="orb orb3"></div>
<div class="scanlines"></div><div class="vig"></div>

<header>
  <nav class="nav">
    <div class="brand">
      <div class="hex">BB</div>
      <div><h1>BLACK BUNNY</h1><small><?= shopLang('PREMIUM APK STORE', 'PREMIUM APK STORE') ?></small></div>
    </div>
    <button class="menu-btn" type="button" onclick="document.getElementById('navlinks').classList.toggle('open')">MENU</button>
  </nav>
  <div id="navlinks">
    <a href="#apkdl"><?= shopLang('GET APK', 'APK LE LO') ?></a>
    <a href="#login"><?= shopLang('PANEL LOGIN', 'PANEL LOGIN') ?></a>
    <a href="#plans"><?= shopLang('PLANS', 'PLANS') ?></a>
    <a href="#feedback"><?= shopLang('FEEDBACK', 'FEEDBACK') ?></a>
    <a href="#panel"><?= shopLang('PANEL', 'PANEL') ?></a>
    <a href="#faq">FAQ</a>
  </div>
</header>

<div class="wrap">

  <!-- ================= HERO ================= -->
  <section class="hero">
    <div class="reveal in">
      <span class="tag"><?= shopLang('PREMIUM APK LICENSE STORE', 'PREMIUM APK LICENSE STORE') ?></span>
      <h2><span class="glitch" data-text="BLACK BUNNY">BLACK BUNNY</span><br><span class="grad">APK ACCESS</span></h2>
      <p class="type"><span id="typed"></span><span class="caret">&nbsp;</span></p>

      <!-- QUICK ACTION BUTTONS -->
      <div class="quick">
        <a class="btn btn-fill shine" href="<?= esc($apkTarget) ?>"><?= shopLang('GET LATEST APK', 'LATEST APK LO') ?></a>
        <a class="btn btn-purple" href="<?= site_url('login') ?>">PANEL LOGIN</a>
        <a class="btn btn-ghost" href="#plans"><?= shopLang('VIEW PLANS', 'PLANS DEKHO') ?></a>
        <a class="btn btn-lime" href="#feedback">FEEDBACK</a>
      </div>

      <div class="stats">
        <div class="stat"><span class="num" data-count="12500" data-suffix="+">0</span><label>KEYS ISSUED</label></div>
        <div class="stat"><span class="num" data-count="99" data-suffix="%">0</span><label>UPTIME</label></div>
        <div class="stat"><span class="num" data-count="3500" data-suffix="+">0</span><label>ACTIVE USERS</label></div>
        <div class="stat"><span class="num">24/7</span><label>SUPPORT</label></div>
      </div>
    </div>
    <div class="phone-zone reveal in d2">
      <div class="phone" id="phoneTilt">
        <div class="notch"></div>
        <div class="scr">
          <div class="scr-head">
            <div class="scr-hex">BB</div>
            <div><b>BLACK BUNNY</b><small>PREMIUM &middot; ACTIVE</small></div>
          </div>
          <div class="scr-chip"><span>LICENSE</span><span>VALID</span></div>
          <div class="scr-chip"><span>PLAN</span><span>30 DAYS</span></div>
          <div class="scr-chip"><span>DEVICE</span><span>HWID LOCKED</span></div>
          <div class="scr-bar"><i style="--w:92%"></i></div>
          <div class="scr-bar"><i style="--w:78%;animation-delay:.5s"></i></div>
          <div class="scr-bar"><i style="--w:85%;animation-delay:.8s"></i></div>
          <div class="scr-key">BB-30D-X7K2-QM9F</div>
          <div class="scr-btn">ACTIVATE PREMIUM</div>
        </div>
      </div>
    </div>
  </section>

</div>

<!-- TICKER -->
<div class="ticker"><div class="tk">
  <span><b>INSTANT DELIVERY</b></span><span><b>HWID LOCKED KEYS</b></span><span><b>VERIFIED UPI</b></span>
  <span><b>PREMIUM APK UNLOCK</b></span><span><b>LIVE STATUS</b></span><span><b>SECURE PANEL</b></span><span><b>PRIORITY UPDATES</b></span>
</div></div>

<div class="wrap">

  <!-- ================= 1. APK DOWNLOAD ================= -->
  <section id="apkdl" class="reveal">
    <p class="kicker"><?= shopLang('DOWNLOAD', 'DOWNLOAD') ?></p>
    <h3 class="sec-title"><?= shopLang('GET LATEST APK', 'LATEST APK LO') ?></h3>
    <div class="dl-grid">
      <div class="dl-main">
        <p class="kicker" style="margin-bottom:0"><?= esc(strtoupper($loaderName)) ?> APK</p>
        <div class="dl-ver"><?= shopLang('LATEST BUILD', 'LATEST BUILD') ?> <span><?= esc(strtoupper($loaderSize)) ?></span></div>
        <p style="color:var(--dim);font-size:16px"><?= shopLang('Download the build, grab a plan, paste your key and the premium unlocks instantly. The newest build always lives here.', 'Build download karo, plan lo, key paste karo aur premium turant on. Latest build hamesha yahin milega.') ?></p>
        <div class="dl-meta">
          <span class="chip">SIZE <b><?= esc($loaderSize) ?></b></span>
          <span class="chip">REQUIRES <b><?= esc(strtoupper($loaderGame)) ?></b></span>
          <span class="chip">UPDATED <b><?= date('Y') ?></b></span>
        </div>
        <a class="btn btn-fill shine" style="width:100%;padding:18px;font-size:14px;text-align:center" href="<?= esc($apkTarget) ?>"<?= preg_match('#^https?://#i', $apkTarget) ? ' target="_blank" rel="noopener"' : '' ?>><?= shopLang('DOWNLOAD LATEST APK', 'LATEST APK DOWNLOAD') ?></a>
        <p class="gen-note"><?= shopLang('Always fetch the build from this store so your loader stays on the current version.', 'Build hamesha isi store se lo taaki loader current version pe rahe.') ?></p>
      </div>
      <div class="mini-steps">
        <div class="mini-step"><b>01</b><p><strong>DOWNLOAD</strong><?= shopLang('Grab the latest APK here.', 'Latest APK yahan se lo.') ?></p></div>
        <div class="mini-step"><b>02</b><p><strong>INSTALL</strong><?= shopLang('Install it and allow unknown sources.', 'Install karo, unknown sources allow karo.') ?></p></div>
        <div class="mini-step"><b>03</b><p><strong>BUY KEY</strong><?= shopLang('Pick a plan and get a key.', 'Plan choose karke key lo.') ?></p></div>
        <div class="mini-step"><b>04</b><p><strong>ACTIVATE</strong><?= shopLang('Paste the key. Premium on.', 'Key paste karo. Premium on.') ?></p></div>
      </div>
    </div>
  </section>

  <!-- ================= 2. PANEL LOGIN ================= -->
  <section id="login" class="reveal">
    <p class="kicker"><?= shopLang('RESELLERS', 'RESELLERS') ?></p>
    <h3 class="sec-title">PANEL LOGIN</h3>
    <?= form_open(site_url('login'), ['class' => 'login-box', 'autocomplete' => 'on']) ?>
      <div class="l-head">
        <span class="dot r"></span><span class="dot y"></span><span class="dot g"></span>
        BB-PANEL v2.0 &mdash; SECURE LOGIN
        <span class="l-live">&bull; LIVE</span>
      </div>
      <div class="l-body">
        <?= csrf_field() ?>
        <div class="l-field">
          <label>USERNAME</label>
          <input id="plUser" name="username" placeholder="<?= shopLang('your username', 'apna username') ?>" autocomplete="username" required>
        </div>
        <div class="l-field">
          <label>PASSWORD</label>
          <input id="plPass" name="password" type="password" placeholder="********" autocomplete="current-password" minlength="6" required>
        </div>
        <input type="hidden" name="ip" value="portal">
        <button class="btn btn-purple" type="submit" style="width:100%">LOGIN TO PANEL</button>
        <p class="l-note"><?= shopLang('No panel access?', 'Panel access nahi hai?') ?> <a href="<?= esc($contactHref) ?>"<?= preg_match('#^https?://#i', $contactHref) ? ' target="_blank" rel="noopener"' : '' ?>><?= shopLang('Contact the owner', 'Owner se contact karo') ?> &rarr;</a></p>
      </div>
    <?= form_close() ?>
  </section>

  <!-- ================= 3. PLANS ================= -->
  <section id="plans" class="reveal">
    <p class="kicker"><?= shopLang('KEY LANES', 'KEY LANES') ?></p>
    <h3 class="sec-title"><?= shopLang('Pick a duration. Pay UPI.<br>Key drops instantly.', 'Duration choose karo. UPI pay karo.<br>Key turant milegi.') ?></h3>
    <div class="lanes">
      <?php if (!empty($lanes)) : ?>
        <?php foreach ($lanes as $plan) : ?>
          <div class="lane<?= !empty($plan['badge']) ? ' hot' : '' ?>" data-tilt>
            <span class="plan"><?= esc($plan['badge'] ?: 'KEY') ?></span>
            <h3><?= esc($plan['title']) ?></h3>
            <span class="dur"><?= esc(hoursToDays((int) $plan['hours'])) ?></span>
            <div class="price">Rs <?= (int) $plan['price'] ?></div>
            <p class="dev"><?= (int) $plan['devices'] ?> device<?= (int) $plan['devices'] > 1 ? 's' : '' ?></p>
            <a class="btn btn-fill" href="<?= site_url('shop/buy/' . (int) $plan['id']) ?>">BUY NOW</a>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="lane-empty"><?= shopLang('PLANS ARE BEING RESTOCKED. CHECK BACK SOON.', 'PLANS RESTOCK HO RAHE HAIN. THODI DER MEIN DEKHO.') ?></div>
      <?php endif; ?>
      <div class="lane panel-card" data-tilt>
        <span class="plan">RESELLER</span>
        <h3>PANEL ACCESS</h3>
        <span class="dur"><?= shopLang('Generate unlimited keys', 'Unlimited keys generate karo') ?></span>
        <div class="price" style="font-size:26px">CUSTOM</div>
        <p class="dev"><?= shopLang('Own license console', 'Apna license console') ?></p>
        <a class="btn btn-purple" href="<?= esc($contactHref) ?>"<?= preg_match('#^https?://#i', $contactHref) ? ' target="_blank" rel="noopener"' : '' ?>>REQUEST ACCESS</a>
      </div>
    </div>
  </section>

  <!-- ================= 4. FEEDBACK (images + video + reviews) ================= -->
  <section id="feedback" class="reveal">
    <p class="kicker"><?= shopLang('FEEDBACK', 'FEEDBACK') ?></p>
    <h3 class="sec-title"><?= shopLang('COMMUNITY PROOF', 'COMMUNITY PROOF') ?></h3>

    <?php if (!empty($media)) : ?>
      <div class="media-grid">
        <?php foreach ($media as $m) : ?>
          <div class="shot lb-open" role="button" tabindex="0" data-kind="<?= esc($m['kind']) ?>" data-src="<?= base_url($m['file']) ?>" data-cap="<?= esc($m['caption']) ?>">
            <?php if ($m['kind'] === 'video') : ?>
              <video src="<?= base_url($m['file']) ?>" muted preload="metadata"></video>
            <?php else : ?>
              <img src="<?= base_url($m['file']) ?>" alt="<?= esc($m['caption']) ?>" loading="lazy" decoding="async">
            <?php endif; ?>
            <span class="ph-label"><?= $m['kind'] === 'video' ? 'VIDEO' : 'IMAGE' ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else : ?>
      <div class="media-grid">
        <div class="shot"><span class="ph-ico">SCREENSHOT</span><span class="ph-label">MEDIA SOON</span></div>
        <div class="shot"><span class="ph-ico">SCREENSHOT</span><span class="ph-label">MEDIA SOON</span></div>
        <div class="shot"><span class="ph-ico">SCREENSHOT</span><span class="ph-label">MEDIA SOON</span></div>
        <div class="shot"><span class="ph-ico">SCREENSHOT</span><span class="ph-label">MEDIA SOON</span></div>
      </div>
    <?php endif; ?>

    <div class="rev-wrap" style="margin-top:28px">
      <div class="rev-track">
        <div class="rev"><div class="stars">*****</div><p>Key mili 2 minute mein, activation instant tha. Smooth experience.</p><b>&mdash; RAHUL K.</b></div>
        <div class="rev"><div class="stars">*****</div><p>Panel lene ke baad apni keys generate karta hoon. Best decision.</p><b>&mdash; ARJUN S.</b></div>
        <div class="rev"><div class="stars">****</div><p>Owner support bohot fast hai. UPI payment bhi verified aur safe.</p><b>&mdash; PRIYA M.</b></div>
        <div class="rev"><div class="stars">*****</div><p>APK lightweight hai aur updates bhi time pe milte hain. Loved it.</p><b>&mdash; VIKRAM T.</b></div>
        <div class="rev"><div class="stars">*****</div><p>60 day plan liya, worth every rupee. HWID lock security achhi hai.</p><b>&mdash; SNEHA R.</b></div>
      </div>
    </div>
  </section>

  <!-- COUNTDOWN -->
  <div class="drop reveal">
    <div>
      <h3><?= shopLang('NEXT SEASON DROP INCOMING', 'NEXT SEASON DROP INCOMING') ?></h3>
      <p><?= shopLang('New plans, faster builds and surprise bonuses. Stay tuned.', 'Naye plans, faster builds aur surprise bonuses. Stay tuned.') ?></p>
    </div>
    <div class="cd">
      <div><b id="cdD">00</b><label>DAYS</label></div>
      <div><b id="cdH">00</b><label>HRS</label></div>
      <div><b id="cdM">00</b><label>MIN</label></div>
      <div><b id="cdS">00</b><label>SEC</label></div>
    </div>
  </div>

  <!-- 3D BANNER -->
  <div class="reveal" style="perspective:900px;margin-bottom:46px">
    <div class="banner-inner" id="bannerTilt" style="position:relative;border:1px solid var(--line);border-radius:14px;overflow:hidden;min-height:300px;
      background:radial-gradient(ellipse at 30% 30%,rgba(255,184,77,.1),transparent 50%),radial-gradient(ellipse at 70% 70%,rgba(0,255,200,.12),transparent 50%),#050b09;
      display:grid;place-items:center;transform-style:preserve-3d;transition:transform .2s ease-out">
      <div style="position:absolute;width:180%;height:5px;filter:blur(3px);opacity:.8;background:linear-gradient(90deg,transparent,var(--orange),transparent);top:28%;left:-30%;transform:rotate(-32deg);animation:beamSlide 5s ease-in-out infinite alternate"></div>
      <div style="position:absolute;width:180%;height:5px;filter:blur(3px);opacity:.8;background:linear-gradient(90deg,transparent,var(--neon),var(--lime),transparent);bottom:24%;right:-30%;transform:rotate(-32deg);animation:beamSlide2 6s ease-in-out infinite alternate"></div>
      <div style="font-family:'Orbitron';font-weight:900;text-align:center;transform:rotateX(14deg);transform-style:preserve-3d;line-height:1.1;letter-spacing:8px">
        <div style="font-size:clamp(28px,5.5vw,54px);background:linear-gradient(180deg,var(--orange) 0%,var(--lime) 55%,var(--neon) 100%);-webkit-background-clip:text;background-clip:text;color:transparent;filter:drop-shadow(0 0 18px rgba(182,255,60,.45));animation:float3d 4s ease-in-out infinite">BLACK</div>
        <div style="font-size:clamp(28px,5.5vw,54px);background:linear-gradient(180deg,var(--orange) 0%,var(--lime) 55%,var(--neon) 100%);-webkit-background-clip:text;background-clip:text;color:transparent;filter:drop-shadow(0 0 18px rgba(182,255,60,.45));animation:float3d 4s ease-in-out infinite .2s">BUNNY</div>
        <div style="font-size:clamp(28px,5.5vw,54px);background:linear-gradient(180deg,var(--orange) 0%,var(--lime) 55%,var(--neon) 100%);-webkit-background-clip:text;background-clip:text;color:transparent;filter:drop-shadow(0 0 18px rgba(182,255,60,.45));animation:float3d 4s ease-in-out infinite .4s">APK</div>
      </div>
    </div>
  </div>
  <style>@keyframes beamSlide{to{transform:rotate(-32deg) translateX(120px)}}@keyframes beamSlide2{to{transform:rotate(-32deg) translateX(-120px)}}@keyframes float3d{50%{transform:translateZ(30px)}}</style>

  <!-- APK PACKAGE -->
  <section class="reveal">
    <p class="kicker"><?= shopLang('THE APK', 'THE APK') ?></p>
    <h3 class="sec-title"><?= esc(strtoupper($loaderName)) ?> APK</h3>
    <div class="pkg-grid">
      <div class="card" data-tilt>
        <p class="kicker">PRODUCT</p>
        <h3 class="sec-title" style="margin-bottom:10px"><?= esc(strtoupper($loaderName)) ?></h3>
        <p style="color:var(--dim);font-size:17px"><?= shopLang('Premium APK by BLACK BUNNY. Buy a license key from this store - or grab a reseller panel and generate your own keys. Paste the key in the app, activate, and enjoy full premium access.', 'Premium APK by BLACK BUNNY. Is store se license key lo - ya reseller panel leke apni keys generate karo. App mein key paste karo, activate karo, full premium enjoy karo.') ?></p>
        <div class="chips">
          <span class="chip">FORMAT <b>KEY-BASED</b></span>
          <span class="chip">DELIVERY <b>INSTANT</b></span>
          <span class="chip">ACCESS <b>KEY + PANEL</b></span>
        </div>
        <div class="btn-row" style="display:flex;gap:14px;flex-wrap:wrap">
          <a class="btn btn-fill" href="#plans">BUY KEY</a>
          <a class="btn btn-ghost" href="<?= site_url('login') ?>">OPEN PANEL</a>
        </div>
      </div>
      <div class="cube-zone reveal d2"><div class="cube"><i>BB</i><i>BB</i><i>BB</i><i>BB</i><i>BB</i><i>BB</i></div></div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="reveal">
    <p class="kicker"><?= shopLang('INSIDE THE APK', 'INSIDE THE APK') ?></p>
    <h3 class="sec-title"><?= shopLang('WHAT YOU UNLOCK', 'WHAT YOU UNLOCK') ?></h3>
    <div class="feat-grid">
      <div class="feat"><span class="ico">PWR</span><h4>PREMIUM UNLOCKED</h4><p>Full Black Bunny features unlocked with your license key.</p></div>
      <div class="feat"><span class="ico">AD</span><h4>ZERO ADS</h4><p>Clean, distraction-free experience.</p></div>
      <div class="feat"><span class="ico">UPD</span><h4>PRIORITY UPDATES</h4><p>Key holders get new builds first.</p></div>
      <div class="feat"><span class="ico">LITE</span><h4>LIGHTWEIGHT</h4><p>Small APK size, smooth performance.</p></div>
      <div class="feat"><span class="ico">HWID</span><h4>KEY PROTECTED</h4><p>Every key is HWID-locked to your device.</p></div>
      <div class="feat"><span class="ico">FAST</span><h4>EASY ACTIVATION</h4><p>Paste key in app - activated in seconds.</p></div>
    </div>
  </section>

  <!-- COMPARISON -->
  <section class="reveal">
    <p class="kicker"><?= shopLang('KEY vs PANEL', 'KEY vs PANEL') ?></p>
    <h3 class="sec-title"><?= shopLang('WHICH ONE FITS YOU?', 'KAUNSA TUMHARE LIYE?') ?></h3>
    <div class="cmp">
      <div class="cmp-col k" data-tilt>
        <h4>LICENSE KEY</h4>
        <ul>
          <li>Starting at just Rs 20</li>
          <li>1 device (HWID lock)</li>
          <li>Instant delivery after UPI</li>
          <li>Perfect for personal use</li>
          <li>All durations available</li>
        </ul>
      </div>
      <div class="cmp-col p" data-tilt>
        <h4>RESELLER PANEL</h4>
        <ul>
          <li>Generate unlimited keys</li>
          <li>Own license console</li>
          <li>Sell keys at your price</li>
          <li>Session stats &amp; recent keys</li>
          <li>Priority owner support</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- RESELLER PANEL -->
  <section id="panel" class="reveal">
    <p class="kicker"><?= shopLang('OWNER PANEL', 'OWNER PANEL') ?></p>
    <h3 class="sec-title"><?= shopLang('LICENSE CONSOLE', 'LICENSE CONSOLE') ?></h3>
    <div class="terminal">
      <canvas id="matrix"></canvas>
      <div class="t-head">
        <span class="dot r"></span><span class="dot y"></span><span class="dot g"></span>
        BB-PANEL v2.0 &mdash; LICENSE CONSOLE
        <span class="t-live">&bull; LIVE</span>
      </div>
      <div class="t-body">
        <p class="t-line">// RESELLER CONSOLE</p>
        <p class="t-dim"><?= shopLang('Panel access is granted by the owner. Sign in to mint license keys, manage plans, upload the loader APK and add store feedback media.', 'Panel access owner deta hai. Sign in karke license keys mint karo, plans manage karo, loader APK upload karo aur store feedback media add karo.') ?></p>
        <div class="btn-row" style="display:flex;gap:14px;flex-wrap:wrap;margin:20px 0 4px">
          <a class="btn btn-purple" href="<?= site_url('login') ?>">PANEL LOGIN</a>
          <a class="btn btn-ghost" href="<?= esc($contactHref) ?>"<?= preg_match('#^https?://#i', $contactHref) ? ' target="_blank" rel="noopener"' : '' ?>>REQUEST ACCESS</a>
        </div>
      </div>
      <div class="t-foot"><span>UPTIME 99.9%</span><span>DB SYNCED</span><span>NODE: AP-SOUTH-1</span><span class="t-log" id="sysLog">&gt; booting...</span></div>
    </div>
  </section>

  <!-- STEPS -->
  <section class="reveal">
    <p class="kicker"><?= shopLang('HOW IT WORKS', 'KAISE KAAM KARTA HAI') ?></p>
    <h3 class="sec-title"><?= shopLang('4 STEPS. DONE.', '4 STEPS. DONE.') ?></h3>
    <div class="steps">
      <div class="step"><h4>PICK PLAN</h4><p>Choose your duration lane.</p></div>
      <div class="step"><h4>PAY UPI</h4><p>Owner-verified UPI payment.</p></div>
      <div class="step"><h4>GET KEY</h4><p>Key delivered instantly.</p></div>
      <div class="step"><h4>ACTIVATE</h4><p>Paste key in Black Bunny APK.</p></div>
    </div>
  </section>

  <!-- UPDATES -->
  <section id="updates" class="reveal">
    <p class="kicker"><?= shopLang('CHANGELOG', 'CHANGELOG') ?></p>
    <h3 class="sec-title"><?= shopLang('LATEST UPDATES', 'LATEST UPDATES') ?></h3>
    <div class="tl">
      <div class="tl-item"><h4>v2.0 &mdash; PANEL CONSOLE</h4><p class="dt"><?= date('Y') ?> &bull; LATEST</p><p>Reseller panel launch. Generate unlimited keys from your own console with session stats.</p></div>
      <div class="tl-item"><h4>v1.5 &mdash; HWID SECURITY</h4><p class="dt"><?= date('Y') ?></p><p>Every key now binds to a single device. Extra protection against key sharing.</p></div>
      <div class="tl-item"><h4>v1.0 &mdash; FIRST DROP</h4><p class="dt"><?= date('Y') - 1 ?></p><p>Black Bunny APK released with 5 license lanes - from 5 hours to 60 days.</p></div>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq" class="reveal">
    <p class="kicker">FAQ</p>
    <h3 class="sec-title"><?= shopLang('QUESTIONS', 'SAWAAL') ?></h3>
    <details open><summary>What is Black Bunny APK?</summary><p>Black Bunny is a premium APK by BLACK BUNNY. Buy a license key from this store to unlock full premium access.</p></details>
    <details><summary>How do I receive my key?</summary><p>Pick a plan, complete the UPI payment, and your key is delivered instantly. You can also track it from the order lookup.</p></details>
    <details><summary>What is the Panel?</summary><p>The panel is a reseller console that generates license keys for Black Bunny APK. Contact the owner for panel access.</p></details>
    <details><summary>Can I use one key on multiple devices?</summary><p>Standard keys are HWID-locked to 1 device. Multi-device keys are available - contact the owner.</p></details>
    <details><summary>What about refunds?</summary><p>Full refund if the key is not delivered. Activated keys are non-refundable.</p></details>
  </section>

  <!-- CTA -->
  <div class="cta reveal">
    <h3><?= shopLang('READY TO DROP IN?', 'READY TO DROP IN?') ?></h3>
    <p><?= shopLang('Join thousands of users already running premium Black Bunny.', 'Hazaaron users already premium Black Bunny chala rahe hain.') ?></p>
    <div class="btn-row" style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
      <a class="btn btn-fill shine" href="<?= esc($apkTarget) ?>"<?= preg_match('#^https?://#i', $apkTarget) ? ' target="_blank" rel="noopener"' : '' ?>><?= shopLang('GET LATEST APK', 'LATEST APK LO') ?></a>
      <a class="btn btn-purple" href="<?= esc($contactHref) ?>"<?= preg_match('#^https?://#i', $contactHref) ? ' target="_blank" rel="noopener"' : '' ?>>CONTACT OWNER</a>
    </div>
  </div>

</div>

<footer>
  <div class="flinks">
    <a href="<?= site_url('shop/legal/privacy') ?>">Privacy</a>
    <a href="<?= site_url('shop/legal/terms') ?>">Terms</a>
    <a href="<?= site_url('shop/legal/refund') ?>">Refund</a>
    <a href="<?= site_url('shop/legal/contact') ?>">Contact</a>
    <a href="<?= site_url('shop/lookup') ?>">Track Order</a>
  </div>
  <p class="cp">&copy; <?= date('Y') ?> BLACK BUNNY &mdash; PREMIUM APK LICENSE STORE</p>
</footer>

<div id="lb" aria-hidden="true"><button class="lb-x" type="button" id="lbX" aria-label="Close">X</button><div class="lb-body" id="lbBody"></div><div class="lb-cap" id="lbCap"></div></div>

<div id="toast"></div>
<button id="toTop" type="button" onclick="scrollTo({top:0,behavior:'smooth'})">
  <svg viewBox="0 0 52 52"><circle id="topRing" cx="26" cy="26" r="24"></circle></svg>
  <span class="arr">&uarr;</span>
</button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
/* ================= CUSTOM CURSOR ================= */
const dot=document.getElementById('curDot'),ring=document.getElementById('curRing');
let cx=0,cy=0,rx=0,ry=0;
addEventListener('mousemove',e=>{cx=e.clientX;cy=e.clientY;dot.style.left=cx+'px';dot.style.top=cy+'px'});
(function curLoop(){rx+=(cx-rx)*.16;ry+=(cy-ry)*.16;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(curLoop)})();
document.querySelectorAll('a,button,summary,.lane,.feat,.card,.shot,.vid-box,input,select,details').forEach(el=>{
  el.addEventListener('mouseenter',()=>document.body.classList.add('hovering'));
  el.addEventListener('mouseleave',()=>document.body.classList.remove('hovering'));
});

/* ================= SCROLL PROGRESS + TO TOP ================= */
const sProg=document.getElementById('sProg'),toTop=document.getElementById('toTop'),topRing=document.getElementById('topRing');
addEventListener('scroll',()=>{
  const h=document.documentElement.scrollHeight-innerHeight,p=h>0?scrollY/h:0;
  sProg.style.width=(p*100)+'%';
  toTop.classList.toggle('show',scrollY>500);
  topRing.style.strokeDashoffset=151-(151*p);
});

/* ================= 3D BACKGROUND ================= */
const canvas=document.getElementById('bg3d');
const renderer=new THREE.WebGLRenderer({canvas,alpha:true,antialias:true});
renderer.setPixelRatio(Math.min(devicePixelRatio,2));
renderer.setSize(innerWidth,innerHeight);
const scene=new THREE.Scene();
scene.fog=new THREE.FogExp2(0x04090c,0.055);
const camera=new THREE.PerspectiveCamera(60,innerWidth/innerHeight,.1,100);
camera.position.set(0,0,14);

const N=1300,pos=new Float32Array(N*3),col=new Float32Array(N*3);
const pal=[[0,1,.78],[.71,1,.24],[.7,.3,1],[1,.72,.3]];
for(let i=0;i<N;i++){
  pos[i*3]=(Math.random()-.5)*44; pos[i*3+1]=(Math.random()-.5)*26; pos[i*3+2]=(Math.random()-.5)*34-4;
  const c=pal[(Math.random()*pal.length)|0]; col[i*3]=c[0];col[i*3+1]=c[1];col[i*3+2]=c[2];
}
const pGeo=new THREE.BufferGeometry();
pGeo.setAttribute('position',new THREE.BufferAttribute(pos,3));
pGeo.setAttribute('color',new THREE.BufferAttribute(col,3));
const points=new THREE.Points(pGeo,new THREE.PointsMaterial({size:.07,vertexColors:true,transparent:true,opacity:.85,blending:THREE.AdditiveBlending,depthWrite:false}));
scene.add(points);

const mats=new THREE.MeshBasicMaterial({color:0x00ffc8,wireframe:true,transparent:true,opacity:.22});
const mats2=new THREE.MeshBasicMaterial({color:0xb44bff,wireframe:true,transparent:true,opacity:.18});
const objs=[
  {m:new THREE.Mesh(new THREE.IcosahedronGeometry(2.4,1),mats),p:[-6,2,-4]},
  {m:new THREE.Mesh(new THREE.TorusGeometry(1.7,.45,10,28),mats2),p:[6,-1,-6]},
  {m:new THREE.Mesh(new THREE.OctahedronGeometry(1.6,0),mats),p:[3.5,3.5,-8]},
  {m:new THREE.Mesh(new THREE.TorusKnotGeometry(1.3,.35,60,8),mats2),p:[-4,-3.5,-6]}
];
objs.forEach(o=>{o.m.position.set(...o.p);scene.add(o.m)});

const grid=new THREE.GridHelper(70,46,0x00ffc8,0x0a2a22);
grid.material.transparent=true;grid.material.opacity=.35;grid.position.y=-7;scene.add(grid);

let mx=0,my=0;
addEventListener('mousemove',e=>{mx=(e.clientX/innerWidth-.5)*2;my=(e.clientY/innerHeight-.5)*2});
addEventListener('resize',()=>{camera.aspect=innerWidth/innerHeight;camera.updateProjectionMatrix();renderer.setSize(innerWidth,innerHeight)});

const clock=new THREE.Clock();
(function loop(){
  requestAnimationFrame(loop);
  const t=clock.getElapsedTime();
  points.rotation.y=t*.02;
  objs.forEach((o,i)=>{o.m.rotation.x=t*(.2+i*.07);o.m.rotation.y=t*(.25+i*.05);o.m.position.y=o.p[1]+Math.sin(t+i*2)*.5});
  grid.position.z=(t*.6)%1.52;
  camera.position.x+=(mx*1.6-camera.position.x)*.04;
  camera.position.y+=(-my*1.2-camera.position.y)*.04;
  camera.lookAt(0,0,0);
  renderer.render(scene,camera);
})();

/* ================= TYPEWRITER ================= */
const phrases=["HWID-locked keys, secured to your device.","Buy a key. Pay UPI. Drop in.","Instant delivery. Zero waiting."];
const typed=document.getElementById('typed');
let pi=0,ci=0,del=false;
(function type(){
  const cur=phrases[pi];
  typed.textContent=del?cur.slice(0,--ci):cur.slice(0,++ci);
  if(!del&&ci===cur.length){del=true;return setTimeout(type,2200)}
  if(del&&ci===0){del=false;pi=(pi+1)%phrases.length}
  setTimeout(type,del?26:52);
})();

/* ================= FIRE BURST (har button tap pe) ================= */
function fireBurst(btn){
  btn.classList.remove('firing'); void btn.offsetWidth; btn.classList.add('firing');
  const r=btn.getBoundingClientRect();
  for(let i=0;i<12;i++){
    const f=document.createElement('span');
    f.className='flame';
    const size=4+Math.random()*7;
    f.style.width=f.style.height=size+'px';
    f.style.left=(r.left+r.width*Math.random())+'px';
    f.style.top=(r.top+r.height*.5)+'px';
    document.body.appendChild(f);
    f.animate([
      {transform:'translateY(0) translateX(0) scale(1)',opacity:1},
      {transform:`translateY(${-26-Math.random()*46}px) translateX(${(Math.random()-.5)*22}px) scale(.15)`,opacity:0}
    ],{duration:480+Math.random()*420,easing:'ease-out'}).onfinish=()=>f.remove();
  }
}
document.querySelectorAll('.btn,.menu-btn').forEach(b=>{
  b.addEventListener('click',function(){fireBurst(this)});
});

/* ================= RIPPLE ================= */
document.querySelectorAll('.btn').forEach(b=>{
  b.addEventListener('click',function(e){
    const r=this.getBoundingClientRect(),s=document.createElement('span');
    s.className='ripple';
    s.style.width=s.style.height=Math.max(r.width,r.height)+'px';
    s.style.left=(e.clientX-r.left-s.offsetWidth/2)+'px';
    s.style.top=(e.clientY-r.top-s.offsetHeight/2)+'px';
    this.appendChild(s);setTimeout(()=>s.remove(),650);
  });
});

/* ================= TILT ================= */
document.querySelectorAll('[data-tilt]').forEach(c=>{
  c.addEventListener('mousemove',e=>{
    const r=c.getBoundingClientRect();
    const x=(e.clientX-r.left)/r.width-.5, y=(e.clientY-r.top)/r.height-.5;
    c.style.transform=`perspective(900px) rotateY(${x*9}deg) rotateX(${-y*9}deg) translateY(-4px)`;
  });
  c.addEventListener('mouseleave',()=>c.style.transform='');
});
const phone=document.getElementById('phoneTilt');
if(phone)addEventListener('mousemove',e=>{
  const x=(e.clientX/innerWidth-.5), y=(e.clientY/innerHeight-.5);
  phone.style.transform=`rotateY(${x*14}deg) rotateX(${-y*8}deg)`;
});
const bt=document.getElementById('bannerTilt');
if(bt)addEventListener('mousemove',e=>{
  const x=(e.clientX/innerWidth-.5), y=(e.clientY/innerHeight-.5);
  bt.style.transform=`rotateY(${x*7}deg) rotateX(${-y*5}deg)`;
});

/* ================= FEATURE SPOTLIGHT ================= */
document.querySelectorAll('.feat').forEach(f=>{
  f.addEventListener('mousemove',e=>{
    const r=f.getBoundingClientRect();
    f.style.setProperty('--mx',(e.clientX-r.left)+'px');
    f.style.setProperty('--my',(e.clientY-r.top)+'px');
  });
});

/* ================= REVEAL + COUNTERS ================= */
const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target)}}),{threshold:.12});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
const cio=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){animCount(e.target);cio.unobserve(e.target)}}),{threshold:.5});
document.querySelectorAll('.num[data-count]').forEach(n=>cio.observe(n));
function animCount(el){
  const t=+el.dataset.count,s=el.dataset.suffix||'',st=performance.now();
  (function f(now){
    const p=Math.min((now-st)/1400,1);
    el.textContent=Math.floor(t*(1-Math.pow(1-p,3))).toLocaleString('en-IN')+s;
    if(p<1)requestAnimationFrame(f);
  })(performance.now());
}

/* ================= COUNTDOWN ================= */
const DROP=new Date('2026-03-01T20:00:00+05:30');
setInterval(()=>{
  let d=new Date(DROP);
  if(d<Date.now()){d.setDate(d.getDate()+7)}
  const ms=d-Date.now();
  document.getElementById('cdD').textContent=String(Math.floor(ms/864e5)).padStart(2,'0');
  document.getElementById('cdH').textContent=String(Math.floor(ms/36e5)%24).padStart(2,'0');
  document.getElementById('cdM').textContent=String(Math.floor(ms/6e4)%60).padStart(2,'0');
  document.getElementById('cdS').textContent=String(Math.floor(ms/1e3)%60).padStart(2,'0');
},1000);

/* ================= MATRIX RAIN ================= */
const mx2=document.getElementById('matrix'),mc=mx2.getContext('2d');
function mSize(){mx2.width=mx2.offsetWidth;mx2.height=mx2.offsetHeight}
mSize();addEventListener('resize',mSize);
const mchars='01<>#$%&ABCDEF';
let drops=Array(60).fill(0);
setInterval(()=>{
  mc.fillStyle='rgba(2,10,8,.12)';mc.fillRect(0,0,mx2.width,mx2.height);
  mc.fillStyle='#00ffc8';mc.font='12px monospace';
  drops.forEach((y,i)=>{
    mc.fillText(mchars[Math.random()*mchars.length|0],i*14,y*14);
    if(y*14>mx2.height&&Math.random()>.97)drops[i]=0;
    drops[i]++;
  });
},60);

/* ================= SYSTEM LOG ================= */
const logs=['> ping 24ms OK','> db synced','> heartbeat OK','> node: AP-SOUTH-1','> license engine ready','> uptime 99.9%'];
let li=0;
setInterval(()=>{
  const el=document.getElementById('sysLog');
  el.textContent='';let c=0;const s=logs[li%logs.length];li++;
  const iv=setInterval(()=>{el.textContent=s.slice(0,++c);if(c>=s.length)clearInterval(iv)},24);
},3200);

/* ================= TOAST ================= */
let toastT;
function toast(msg){
  const t=document.getElementById('toast');
  t.textContent=msg;t.classList.add('show');
  clearTimeout(toastT);toastT=setTimeout(()=>t.classList.remove('show'),2600);
}

/* ================= LIGHTBOX ================= */
const lb=document.getElementById('lb'),lbBody=document.getElementById('lbBody'),lbCap=document.getElementById('lbCap');
function openLb(kind,src,cap){
  lbBody.innerHTML=kind==='video'
    ?`<video src="${src}" controls autoplay playsinline></video>`
    :`<img src="${src}" alt="${cap||''}">`;
  lbCap.textContent=cap||'';
  lb.classList.add('open');lb.setAttribute('aria-hidden','false');
}
function closeLb(){lb.classList.remove('open');lb.setAttribute('aria-hidden','true');lbBody.innerHTML='';}
document.querySelectorAll('.lb-open').forEach(el=>{
  el.addEventListener('click',()=>openLb(el.dataset.kind,el.dataset.src,el.dataset.cap));
  el.addEventListener('keydown',e=>{if(e.key==='Enter'||e.key===' '){e.preventDefault();openLb(el.dataset.kind,el.dataset.src,el.dataset.cap)}});
});
document.getElementById('lbX').addEventListener('click',closeLb);
lb.addEventListener('click',e=>{if(e.target===lb)closeLb()});
addEventListener('keydown',e=>{if(e.key==='Escape')closeLb()});
</script>
</body>
</html>
