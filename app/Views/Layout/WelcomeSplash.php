<style>
html.bb-splash-on,html.bb-splash-on body{overflow:hidden!important;perspective:none!important;transform:none!important}
#bbWelcome{position:fixed!important;top:0!important;left:0!important;right:0!important;bottom:0!important;width:100vw!important;height:100vh!important;z-index:2147483647!important;display:flex!important;align-items:center!important;justify-content:center!important;background:#02040a!important;color:#e8f6ff!important;text-align:center!important;transform:none!important;opacity:1!important;visibility:visible!important;pointer-events:auto!important;font-family:Orbitron,Arial,sans-serif!important;overflow:hidden}
#bbWelcome.out{opacity:0!important;transform:scale(1.06)!important;filter:blur(8px);transition:opacity .55s ease,transform .55s ease,filter .55s ease;pointer-events:none!important}
.bb-sp-bg{position:absolute;inset:0;pointer-events:none}
.bb-sp-grid{position:absolute;inset:-20%;opacity:.18;background-image:linear-gradient(rgba(0,255,208,.18) 1px,transparent 1px),linear-gradient(90deg,rgba(0,255,208,.1) 1px,transparent 1px);background-size:44px 44px;transform:perspective(700px) rotateX(62deg) scale(1.6) translateY(12%);animation:bbSpGrid 8s linear infinite}
.bb-sp-aurora{position:absolute;inset:0;background:radial-gradient(520px 320px at 50% 42%,rgba(0,255,208,.18),transparent 62%),radial-gradient(420px 280px at 22% 18%,rgba(255,45,106,.16),transparent 58%),radial-gradient(380px 240px at 78% 22%,rgba(182,255,59,.1),transparent 55%);animation:bbSpPulse 3.2s ease-in-out infinite}
.bb-sp-scan{position:absolute;left:0;right:0;height:90px;background:linear-gradient(180deg,transparent,rgba(0,255,208,.12),transparent);animation:bbSpScan 2.8s linear infinite}
.bb-sp-core{position:relative;z-index:2;padding:20px}
.bb-bunny{width:min(210px,58vw);height:auto;margin:0 auto 8px;filter:drop-shadow(0 0 18px rgba(0,255,208,.45));animation:bbBunnyIn .9s cubic-bezier(.16,1,.3,1) both,bbBunnyFloat 3.4s ease-in-out 1s infinite}
.bb-bunny .ear-l{transform-origin:70px 78px;animation:bbEarL 2.4s ease-in-out infinite}
.bb-bunny .ear-r{transform-origin:118px 74px;animation:bbEarR 2.6s ease-in-out infinite}
.bb-bunny .eye{animation:bbBlink 4.2s ease-in-out infinite}
.bb-bunny .glow{animation:bbEyeGlow 1.8s ease-in-out infinite}
.bb-bunny .ring{transform-origin:100px 118px;animation:bbRing 3s linear infinite}
.bb-bunny .stroke{stroke-dasharray:900;stroke-dashoffset:900;animation:bbDraw 1.6s ease forwards}
.bb-sp-kicker{margin-top:6px;letter-spacing:.42em;font-size:11px;color:#b6ff3b;opacity:0;animation:bbFadeUp .6s ease .4s forwards}
.bb-sp-title{margin:14px 0 8px;font-size:clamp(26px,6.4vw,54px);font-weight:800;letter-spacing:.12em;line-height:1.12;color:#e8f6ff;text-shadow:0 0 28px rgba(0,255,208,.5)}
.bb-sp-title span{display:inline-block;opacity:0;transform:translateY(18px);animation:bbLetter .55s cubic-bezier(.16,1,.3,1) forwards}
.bb-sp-sub{color:#8aa3c2;letter-spacing:.28em;font-size:11px;text-transform:uppercase;opacity:0;animation:bbFadeUp .6s ease 1.5s forwards}
.bb-sp-bar{width:240px;height:3px;margin:22px auto 0;background:rgba(0,255,208,.14);overflow:hidden;opacity:0;animation:bbFadeUp .5s ease 1.7s forwards}
.bb-sp-bar i{display:block;height:100%;width:38%;background:linear-gradient(90deg,#00ffd0,#b6ff3b,#ff2d6a);animation:bbBar 1.15s linear infinite}
.bb-sp-skip{margin-top:20px;color:#00ffd0;letter-spacing:.38em;font-size:10px;cursor:pointer;opacity:0;animation:bbFadeUp .5s ease 2s forwards,bbHudBlink 1.4s ease 2.4s infinite}
@keyframes bbSpGrid{to{background-position:0 44px,44px 0}}
@keyframes bbSpPulse{50%{opacity:.7;transform:scale(1.04)}}
@keyframes bbSpScan{0%{top:-90px}100%{top:110%}}
@keyframes bbBunnyIn{from{opacity:0;transform:translateY(28px) scale(.86)}to{opacity:1;transform:none}}
@keyframes bbBunnyFloat{50%{transform:translateY(-8px)}}
@keyframes bbEarL{0%,100%{transform:rotate(0)}40%{transform:rotate(-9deg)}60%{transform:rotate(4deg)}}
@keyframes bbEarR{0%,100%{transform:rotate(0)}35%{transform:rotate(8deg)}55%{transform:rotate(-5deg)}}
@keyframes bbBlink{0%,8%,100%{transform:scaleY(1)}4%{transform:scaleY(.12)}}
@keyframes bbEyeGlow{50%{opacity:.35}}
@keyframes bbRing{to{transform:rotate(360deg)}}
@keyframes bbDraw{to{stroke-dashoffset:0}}
@keyframes bbLetter{to{opacity:1;transform:none}}
@keyframes bbFadeUp{to{opacity:1}}
@keyframes bbBar{0%{transform:translateX(-120%)}100%{transform:translateX(320%)}}
@keyframes bbHudBlink{50%{opacity:.35}}
</style>
<script>
(function(){
  var skip=false;
  try{ skip=!!sessionStorage.getItem('bb_splash_seen'); }catch(e){}
  window.__bbSplashSkip=skip;
  if(skip) document.write('<style>#bbWelcome{display:none!important;visibility:hidden!important}</style>');
  else document.documentElement.className+=' bb-splash-on';
})();
</script>
<div id="bbWelcome">
  <div class="bb-sp-bg">
    <div class="bb-sp-grid"></div>
    <div class="bb-sp-aurora"></div>
    <div class="bb-sp-scan"></div>
  </div>
  <div class="bb-sp-core">
    <svg class="bb-bunny" viewBox="0 0 200 230" fill="none" aria-hidden="true">
      <circle class="ring" cx="100" cy="118" r="92" stroke="rgba(0,255,208,.22)" stroke-width="1" stroke-dasharray="6 10"/>
      <circle cx="100" cy="118" r="78" stroke="rgba(255,45,106,.18)" stroke-width="1"/>
      <ellipse class="glow" cx="100" cy="128" rx="54" ry="18" fill="rgba(0,255,208,.16)"/>
      <path class="ear-l" d="M62 86 C48 18 78 8 86 78 C80 70 68 74 62 86Z" fill="#050914" stroke="#00ffd0" stroke-width="2"/>
      <path class="ear-l" d="M70 80 C62 34 78 28 82 76" stroke="#ff2d6a" stroke-width="1.4" fill="none"/>
      <path class="ear-r" d="M128 84 C150 12 176 28 142 86 C136 74 132 74 128 84Z" fill="#050914" stroke="#00ffd0" stroke-width="2"/>
      <path class="ear-r" d="M136 78 C152 32 164 42 140 82" stroke="#ff2d6a" stroke-width="1.4" fill="none"/>
      <path class="stroke" d="M70 92 C62 108 62 128 78 146 C90 160 110 162 126 148 C144 130 146 108 136 92 C128 80 110 74 100 74 C88 74 76 82 70 92Z" fill="#070b14" stroke="#00ffd0" stroke-width="2.2"/>
      <path d="M78 146 C86 176 114 180 124 148 C116 160 92 160 78 146Z" fill="#050914" stroke="#00ffd0" stroke-width="1.8"/>
      <ellipse cx="132" cy="150" rx="10" ry="7" fill="#050914" stroke="#b6ff3b" stroke-width="1.2"/>
      <circle class="eye" cx="84" cy="108" r="5.2" fill="#00ffd0"/>
      <circle class="eye" cx="116" cy="106" r="5.6" fill="#00ffd0"/>
      <circle cx="85.4" cy="106.6" r="1.6" fill="#031018"/>
      <circle cx="117.4" cy="104.6" r="1.7" fill="#031018"/>
      <path d="M96 118 C100 124 106 124 110 118" stroke="#ff2d6a" stroke-width="1.6" fill="none"/>
      <path d="M100 74 L100 54" stroke="#b6ff3b" stroke-width="1" opacity=".7"/>
      <circle cx="100" cy="50" r="3" fill="#b6ff3b"/>
    </svg>
    <div class="bb-sp-kicker">SECURE CHANNEL</div>
    <h1 class="bb-sp-title" id="bbSpTitle"></h1>
    <div class="bb-sp-sub">Tactical HUD · BGMI Loader · Key Arena</div>
    <div class="bb-sp-bar"><i></i></div>
    <div class="bb-sp-skip">TAP TO ENTER</div>
  </div>
</div>
<script>
(function(){
  var el=document.getElementById('bbWelcome');
  if(!el) return;
  if(window.__bbSplashSkip){
    if(el.parentNode) el.parentNode.removeChild(el);
    document.documentElement.className=document.documentElement.className.replace(' bb-splash-on','');
    return;
  }
  try{ document.documentElement.appendChild(el); }catch(e){}
  var title=document.getElementById('bbSpTitle');
  if(title){
    var lines=['WELCOME TO','BLACK BUNNY PORTAL'];
    lines.forEach(function(line,li){
      if(li) title.appendChild(document.createElement('br'));
      line.split('').forEach(function(ch,i){
        var s=document.createElement('span');
        s.textContent=ch=== ' ' ? '\u00a0' : ch;
        s.style.animationDelay=(0.55+li*0.45+i*0.04)+'s';
        title.appendChild(s);
      });
    });
  }
  function hide(){
    if(!el||el.getAttribute('data-done')) return;
    el.setAttribute('data-done','1');
    try{ sessionStorage.setItem('bb_splash_seen','1'); }catch(e){}
    el.className='out';
    document.documentElement.className=document.documentElement.className.replace(' bb-splash-on','');
    setTimeout(function(){ if(el&&el.parentNode) el.parentNode.removeChild(el); }, 560);
  }
  el.onclick=hide;
  setTimeout(hide, 6200);
})();
</script>
