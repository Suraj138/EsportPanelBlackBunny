<?php
$spTitle = $spTitle ?? 'BLACK BUNNY';
$spSub   = $spSub   ?? 'P U B L I C   S T O R E';
$spKey   = $spKey   ?? 'bb_splash_seen';
$spMs    = (int) ($spMs ?? 3500);
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Share+Tech+Mono&display=swap');
html.bb-splash-on,html.bb-splash-on body{overflow:hidden!important}
#bbWelcome{position:fixed;inset:0;z-index:2147483647;background:radial-gradient(ellipse at 50% 45%,#04120e 0%,#010403 70%);display:flex;align-items:center;justify-content:center;overflow:hidden;font-family:'Share Tech Mono',Orbitron,monospace;color:#d9fff6}
#bbWelcome .half{position:absolute;left:0;width:100%;height:50.5%;background:#010403;transition:transform .9s cubic-bezier(.8,0,.2,1)}
#bbWelcome .half.top{top:0;box-shadow:0 2px 0 rgba(0,255,208,.35)}
#bbWelcome .half.bot{bottom:0;box-shadow:0 -2px 0 rgba(0,255,208,.35)}
#bbWelcome.exit .half.top{transform:translateY(-101%)}
#bbWelcome.exit .half.bot{transform:translateY(101%)}
#bbWelcome .s-inner{position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;text-align:center;transition:opacity .4s,transform .4s}
#bbWelcome.exit .s-inner{opacity:0;transform:scale(.92)}
#bbWelcome .s-hex{position:relative;width:130px;height:130px;margin-bottom:26px}
#bbWelcome .s-hex svg{position:absolute;inset:0;width:100%;height:100%;animation:hexSpin 14s linear infinite}
@keyframes hexSpin{to{transform:rotate(360deg)}}
#bbWelcome .s-hex .draw{stroke-dasharray:100;stroke-dashoffset:100;animation:sDraw 1s .1s cubic-bezier(.6,0,.3,1) forwards}
@keyframes sDraw{to{stroke-dashoffset:0}}
#bbWelcome .s-bb{position:absolute;inset:0;display:grid;place-items:center;font-family:Orbitron,sans-serif;font-weight:900;font-size:44px;color:#00ffd0;text-shadow:0 0 18px rgba(0,255,208,.9),0 0 60px rgba(0,255,208,.4);transform:scale(0);animation:bbpop .55s .75s cubic-bezier(.2,1.6,.4,1) forwards}
@keyframes bbpop{to{transform:scale(1)}}
#bbWelcome .s-title{font-family:Orbitron,sans-serif;font-weight:900;font-size:clamp(26px,5vw,54px);letter-spacing:.14em;color:#fff;text-shadow:0 0 14px rgba(0,255,208,.8),0 0 50px rgba(0,255,208,.3);min-height:1.2em}
#bbWelcome .s-title span{display:inline-block;opacity:0;transform:translateY(26px) rotateX(60deg);animation:lin .5s cubic-bezier(.2,.9,.3,1.2) forwards;animation-delay:calc(.9s + var(--i)*.055s)}
@keyframes lin{to{opacity:1;transform:none}}
#bbWelcome .s-sub{margin-top:10px;font-size:12px;letter-spacing:.6em;color:#b6ff3b;text-shadow:0 0 12px rgba(182,255,59,.6);min-height:16px}
#bbWelcome .s-sub::after{content:"|";animation:cur 1s steps(2) infinite;margin-left:2px}
@keyframes cur{50%{opacity:0}}
#bbWelcome .s-bar{margin-top:30px;width:min(340px,70vw);height:3px;background:rgba(0,255,208,.12);position:relative;overflow:hidden}
#bbWelcome .s-bar i{position:absolute;inset:0;width:0%;background:linear-gradient(90deg,#00ffd0,#b6ff3b);box-shadow:0 0 16px #00ffd0;transition:width .12s linear}
#bbWelcome .s-meta{margin-top:12px;display:flex;gap:26px;font-size:11px;letter-spacing:.3em;color:rgba(0,255,208,.75)}
#bbWelcome #sPct{color:#b6ff3b}
#bbWelcome #sStatus{color:#00ffd0;text-shadow:0 0 10px rgba(0,255,208,.6)}
#bbWelcome .s-skip{margin-top:30px;font-size:10px;letter-spacing:.4em;color:rgba(160,255,235,.4);cursor:pointer}
#bbWelcome .s-skip:hover{color:#00ffd0}
#bbWelcome .s-snd{margin-top:8px;font-size:10px;letter-spacing:.35em;color:rgba(182,255,59,.5)}
#bbWelcome .s-log{position:absolute;left:24px;bottom:20px;font-size:10px;line-height:1.9;color:rgba(0,255,208,.4);z-index:2;text-align:left}
#bbWelcome .s-log div::before{content:"> ";color:#b6ff3b}
#bbFlash{position:fixed;inset:0;z-index:2147483646;background:radial-gradient(circle at 50% 50%,#b8fff0,rgba(0,255,208,.5) 40%,transparent 75%);opacity:0;pointer-events:none;transition:opacity .35s}
#bbFlash.on{opacity:1}
</style>
<script>
(function(){
  var KEY=<?= json_encode($spKey) ?>;
  var skip=false;
  try{ skip=!!sessionStorage.getItem(KEY); }catch(e){}
  window.__bbSplashSkip=skip;
  if(skip) document.write('<style>#bbWelcome,#bbFlash{display:none!important}</style>');
  else document.documentElement.className+=' bb-splash-on';
})();
</script>
<div id="bbWelcome">
  <div class="half top"></div><div class="half bot"></div>
  <div class="s-log" id="sLog"></div>
  <div class="s-inner">
    <div class="s-hex">
      <svg viewBox="0 0 100 100">
        <defs><linearGradient id="hg" x1="0" y1="0" x2="1" y2="1">
          <stop offset="0" stop-color="#ff2d6a"/><stop offset="1" stop-color="#00ffd0"/>
        </linearGradient></defs>
        <polygon class="draw" points="50,4 92,27 92,73 50,96 8,73 8,27" fill="none" stroke="url(#hg)" stroke-width="2.5" pathLength="100"/>
        <polygon points="50,14 83,32 83,68 50,86 17,68 17,32" fill="none" stroke="rgba(0,255,208,.25)" stroke-width="1"/>
      </svg>
      <div class="s-bb">BB</div>
    </div>
    <div class="s-title" id="sTitle"></div>
    <div class="s-sub" id="sSub"></div>
    <div class="s-bar"><i id="sFill"></i></div>
    <div class="s-meta"><span id="sPct">0%</span><span id="sStatus">INITIALIZING...</span></div>
    <div class="s-skip" id="sSkip">TAP ANYWHERE TO SKIP</div>
    <div class="s-snd" id="sSnd">TAP TO ENABLE SOUND</div>
  </div>
</div>
<div id="bbFlash"></div>
<script>
(function(){
  var KEY=<?= json_encode($spKey) ?>;
  var TITLE=<?= json_encode($spTitle) ?>;
  var SUB=<?= json_encode($spSub) ?>;
  var SPLASH_MS=<?= $spMs ?>;
  var splash=document.getElementById('bbWelcome');
  var flash=document.getElementById('bbFlash');
  if(!splash) return;
  if(window.__bbSplashSkip){
    if(splash.parentNode) splash.parentNode.removeChild(splash);
    if(flash&&flash.parentNode) flash.parentNode.removeChild(flash);
    document.documentElement.className=document.documentElement.className.replace(' bb-splash-on','');
    return;
  }
  try{ document.documentElement.appendChild(splash); if(flash) document.documentElement.appendChild(flash); }catch(e){}

  var Sound={
    ctx:null, master:null, on:false,
    init:function(){
      if(this.ctx) return;
      try{
        this.ctx=new (window.AudioContext||window.webkitAudioContext)();
        this.master=this.ctx.createGain();
        this.master.gain.value=0.5;
        this.master.connect(this.ctx.destination);
      }catch(e){ this.on=false; }
    },
    resume:function(){ if(this.ctx&&this.ctx.state==='suspended') this.ctx.resume(); },
    ready:function(){ return this.on&&this.ctx&&this.ctx.state==='running'; },
    tone:function(freq,dur,type,vol,slideTo){
      if(!this.ready()) return;
      var t=this.ctx.currentTime;
      var o=this.ctx.createOscillator(), g=this.ctx.createGain();
      o.type=type||'sine'; o.frequency.setValueAtTime(freq,t);
      if(slideTo) o.frequency.exponentialRampToValueAtTime(slideTo,t+dur);
      g.gain.setValueAtTime(vol,t);
      g.gain.exponentialRampToValueAtTime(0.0001,t+dur);
      o.connect(g); g.connect(this.master);
      o.start(t); o.stop(t+dur+0.02);
    },
    beep:function(){ this.tone(880,0.08,'square',0.14); },
    success:function(){ this.tone(660,0.1,'sine',0.18); var s=this; setTimeout(function(){ s.tone(990,0.16,'sine',0.18); },100); },
    whoosh:function(){
      if(!this.ready()) return;
      var t=this.ctx.currentTime, dur=0.75;
      var buf=this.ctx.createBuffer(1,this.ctx.sampleRate*dur,this.ctx.sampleRate);
      var d=buf.getChannelData(0);
      for(var i=0;i<d.length;i++) d[i]=(Math.random()*2-1)*(1-i/d.length);
      var src=this.ctx.createBufferSource(); src.buffer=buf;
      var f=this.ctx.createBiquadFilter(); f.type='bandpass';
      f.frequency.setValueAtTime(300,t);
      f.frequency.exponentialRampToValueAtTime(2600,t+dur*0.6);
      var g=this.ctx.createGain();
      g.gain.setValueAtTime(0.0001,t);
      g.gain.exponentialRampToValueAtTime(0.45,t+0.08);
      g.gain.exponentialRampToValueAtTime(0.0001,t+dur);
      src.connect(f); f.connect(g); g.connect(this.master);
      src.start(t);
    }
  };

  var title=document.getElementById('sTitle');
  if(title){
    TITLE.split('').forEach(function(ch,i){
      var s=document.createElement('span');
      s.textContent=ch===' '?'\u00A0':ch;
      s.style.setProperty('--i',i);
      title.appendChild(s);
    });
  }

  var si=0;
  setTimeout(function type(){
    var el=document.getElementById('sSub');
    if(!el) return;
    if(si<=SUB.length){ el.textContent=SUB.slice(0,si++); setTimeout(type,55); }
  },1400);

  var LOGS=['BOOT v2.4.1','MEMCHECK OK','UPLINK: NODE-07','MASCOT: AWAKE','CHANNEL: SECURE'];
  var logEl=document.getElementById('sLog');
  var li=0;
  var logIv=setInterval(function(){
    if(!logEl||li>=LOGS.length){ clearInterval(logIv); return; }
    var d=document.createElement('div'); d.textContent=LOGS[li++];
    logEl.appendChild(d);
    while(logEl.children.length>4) logEl.removeChild(logEl.firstChild);
  },520);

  var sFill=document.getElementById('sFill');
  var sPct=document.getElementById('sPct');
  var sStatus=document.getElementById('sStatus');
  var MSGS=[[0,'INITIALIZING...'],[30,'LOADING ASSETS...'],[60,'DECRYPTING CHANNEL...'],[90,'ACCESS GRANTED']];
  var MILE={25:'beep',50:'beep',75:'beep',100:'success'};
  var sp=0;

  var pIv=setInterval(function(){
    sp=Math.min(100,sp+Math.random()*3.2+1.2);
    if(sFill) sFill.style.width=sp+'%';
    if(sPct) sPct.textContent=Math.floor(sp)+'%';
    for(var k=0;k<MSGS.length;k++){ if(sp>=MSGS[k][0]&&sStatus) sStatus.textContent=MSGS[k][1]; }
    for(var th in MILE){ if(sp>=+th){ if(Sound[MILE[th]]) Sound[MILE[th]](); delete MILE[th]; } }
    if(sp>=100) clearInterval(pIv);
  }, SPLASH_MS/48);

  var exited=false;
  function hide(){
    if(exited) return; exited=true;
    clearInterval(pIv); clearInterval(logIv);
    if(sFill) sFill.style.width='100%';
    if(sPct) sPct.textContent='100%';
    if(sStatus) sStatus.textContent='ACCESS GRANTED';
    try{ sessionStorage.setItem(KEY,'1'); }catch(e){}
    Sound.whoosh();
    if(flash) flash.className='on';
    setTimeout(function(){
      splash.className='exit';
      document.documentElement.className=document.documentElement.className.replace(' bb-splash-on','');
      setTimeout(function(){ if(flash) flash.className=''; },350);
      setTimeout(function(){
        if(splash&&splash.parentNode) splash.parentNode.removeChild(splash);
        if(flash&&flash.parentNode) flash.parentNode.removeChild(flash);
      },1000);
    },280);
  }

  var sndEl=document.getElementById('sSnd');
  function unlockAudio(){
    Sound.init(); Sound.resume();
    if(!Sound.on){
      Sound.on=true;
      if(sndEl) sndEl.textContent='SOUND ON';
      Sound.beep();
    }
  }
  splash.addEventListener('click',function(e){
    if(e.target&&e.target.id==='sSnd'){ unlockAudio(); return; }
    hide();
  });
  if(sndEl) sndEl.addEventListener('click',function(e){ e.stopPropagation(); unlockAudio(); });
  setTimeout(hide, SPLASH_MS);
})();
</script>
