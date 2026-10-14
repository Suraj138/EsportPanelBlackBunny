<style>
@import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Rajdhani:wght@400;500;600;700&family=Share+Tech+Mono&display=swap');
:root{
  --bg:#04090c; --panel:rgba(8,18,22,.68); --line:rgba(0,255,200,.18);
  --neon:#00ffc8; --lime:#b6ff3c; --purple:#b44bff; --orange:#ffb84d; --red:#ff4d6b;
  --text:#d9ece7; --dim:#7fa39b;
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body.bba{background:var(--bg);color:var(--text);font-family:'Rajdhani',sans-serif;min-height:100vh;overflow-x:hidden;cursor:none}
@media(hover:none){body.bba{cursor:auto}}
::selection{background:var(--neon);color:#000}

/* ===== CURSOR ===== */
#curDot,#curRing{position:fixed;top:0;left:0;pointer-events:none;z-index:999;border-radius:50%;transform:translate(-50%,-50%)}
#curDot{width:8px;height:8px;background:var(--neon);box-shadow:0 0 12px var(--neon)}
#curRing{width:36px;height:36px;border:1px solid rgba(0,255,200,.5);transition:width .25s,height .25s,border-color .25s}
body.bba.hovering #curRing{width:56px;height:56px;border-color:var(--lime)}
@media(hover:none){#curDot,#curRing{display:none}}

/* ===== BG FX ===== */
#bg3d{position:fixed;inset:0;z-index:0;pointer-events:none}
.orb{position:fixed;border-radius:50%;filter:blur(100px);opacity:.3;z-index:0;pointer-events:none;animation:drift 16s ease-in-out infinite alternate}
.orb1{width:440px;height:440px;background:var(--purple);top:-120px;right:-100px}
.orb2{width:380px;height:380px;background:var(--neon);bottom:-140px;left:-120px;animation-delay:-6s}
.orb3{width:300px;height:300px;background:var(--red);top:40%;left:60%;opacity:.12;animation-delay:-3s}
@keyframes drift{to{transform:translate(50px,70px) scale(1.2)}}
.scanlines{position:fixed;inset:0;z-index:1;pointer-events:none;opacity:.4;
  background:repeating-linear-gradient(0deg,transparent 0 3px,rgba(0,0,0,.12) 3px 4px)}
.vig{position:fixed;inset:0;z-index:1;pointer-events:none;background:radial-gradient(ellipse at center,transparent 55%,rgba(0,0,0,.55))}

/* ===== LAYOUT ===== */
.auth-scene{position:relative;z-index:2;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:34px 20px;gap:26px}
.auth-brand{display:flex;align-items:center;gap:14px;justify-content:center;text-align:left}
.auth-brand .hex{width:54px;height:54px;display:grid;place-items:center;font-family:'Orbitron';font-weight:900;color:var(--neon);flex-shrink:0;
  clip-path:polygon(50% 0,100% 25%,100% 75%,50% 100%,0 75%,0 25%);
  background:linear-gradient(135deg,rgba(0,255,200,.15),rgba(180,75,255,.15));border:1px solid var(--line);
  animation:hexPulse 3s ease-in-out infinite}
@keyframes hexPulse{50%{box-shadow:0 0 25px rgba(0,255,200,.45)}}
.auth-brand h1{font-family:'Orbitron';font-size:18px;letter-spacing:4px;line-height:1.1}
.auth-brand small{display:block;color:var(--lime);letter-spacing:4px;font-size:9px;font-weight:600;margin-top:3px}
.auth-ticks{display:flex;gap:22px;flex-wrap:wrap;justify-content:center;font-family:'Share Tech Mono';font-size:10px;letter-spacing:2px;color:var(--dim);margin-top:2px}
.auth-ticks span{display:inline-flex;align-items:center;gap:7px}
.auth-ticks i{width:6px;height:6px;border-radius:50%;background:var(--neon);box-shadow:0 0 10px var(--neon);animation:blk 1.6s infinite}
@keyframes blk{50%{opacity:.25}}

/* ===== CARD ===== */
.auth-card{width:100%;max-width:480px;background:rgba(3,12,10,.9);border:1px solid rgba(180,75,255,.4);border-radius:16px;overflow:hidden;
  box-shadow:0 0 70px rgba(180,75,255,.12),inset 0 0 60px rgba(0,255,200,.03);font-family:'Share Tech Mono';backdrop-filter:blur(10px)}
.auth-card.wide{max-width:560px}
.a-head{display:flex;align-items:center;gap:8px;padding:13px 18px;border-bottom:1px solid var(--line);letter-spacing:2px;font-size:12px;color:var(--dim)}
.a-head .dot{width:10px;height:10px;border-radius:50%}
.a-head .r{background:#ff5f56}.a-head .y{background:#ffbd2e}.a-head .g{background:#27c93f}
.a-live{margin-left:auto;color:var(--lime);font-size:11px;animation:blk 1.4s infinite}
.a-body{padding:28px}
.a-kicker{font-family:'Share Tech Mono';color:var(--lime);letter-spacing:4px;font-size:11px;margin-bottom:8px}
.a-body h2{font-family:'Orbitron';font-weight:900;font-size:clamp(22px,4vw,30px);letter-spacing:2px;margin-bottom:8px;
  background:linear-gradient(90deg,var(--neon),var(--lime));-webkit-background-clip:text;background-clip:text;color:transparent;background-size:200%;animation:gradMove 4s linear infinite}
@keyframes gradMove{to{background-position:200%}}
.a-body>p{color:var(--dim);font-size:15px;margin-bottom:20px;font-family:'Rajdhani'}

/* ===== FIELDS ===== */
.a-field{margin-bottom:15px}
.a-field label{display:block;font-size:11px;letter-spacing:2px;color:var(--dim);margin-bottom:7px}
.a-field input{width:100%;background:#02110d;border:1px solid var(--line);color:var(--neon);font-family:'Share Tech Mono';padding:13px 14px;border-radius:9px;outline:none;font-size:14px;transition:.25s}
.a-field input::placeholder{color:#3f5a52}
.a-field input:focus{border-color:var(--purple);box-shadow:0 0 16px rgba(180,75,255,.3)}
.a-field input[readonly]{color:var(--dim);background:#010a08}
.a-field small{display:block;color:var(--red);font-size:12px;margin-top:6px}
.a-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
@media(max-width:520px){.a-grid{grid-template-columns:1fr}}
.a-rowx{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin:4px 0 18px;font-size:13px;font-family:'Rajdhani'}
.a-rowx label{display:flex;align-items:center;gap:8px;color:var(--dim);cursor:none}
.a-rowx a{color:var(--purple);text-decoration:none}
.a-rowx a:hover{text-decoration:underline}
.a-check{accent-color:var(--neon);width:16px;height:16px}

/* ===== BUTTON ===== */
.a-btn{width:100%;font-family:'Orbitron';letter-spacing:2px;font-size:13px;padding:16px 30px;border:none;cursor:none;position:relative;overflow:hidden;
  background:linear-gradient(90deg,var(--neon),var(--lime));color:#03110c;font-weight:700;transition:.3s}
@media(hover:none){.a-btn{cursor:pointer}}
.a-btn:hover{transform:translateY(-2px);box-shadow:0 12px 40px rgba(0,255,200,.4)}
.a-btn:active{transform:scale(.97)}
.a-btn.purple{background:linear-gradient(90deg,var(--purple),#ff6bf0);color:#fff}
.a-btn.purple:hover{box-shadow:0 12px 40px rgba(180,75,255,.5)}
.a-btn .ripple{position:absolute;border-radius:50%;background:rgba(255,255,255,.45);transform:scale(0);animation:rip .6s ease-out;pointer-events:none}
@keyframes rip{to{transform:scale(4);opacity:0}}
.a-foot{margin-top:18px;text-align:center;color:var(--dim);font-size:12px;letter-spacing:1px;font-family:'Rajdhani'}
.a-foot a{color:var(--purple);text-decoration:none}
.a-foot a:hover{text-decoration:underline}
.a-alt{margin-top:6px;text-align:center;color:#4f6b63;font-size:11px;letter-spacing:2px;font-family:'Share Tech Mono'}

/* ===== ALERTS ===== */
.hud-alert{position:relative;border:1px solid var(--line);border-radius:10px;padding:13px 16px;margin-bottom:18px;font-family:'Share Tech Mono';font-size:13px;letter-spacing:1px;background:rgba(0,255,200,.05);animation:shake .4s}
.hud-alert.bad{border-color:rgba(255,77,107,.55);background:rgba(255,77,107,.1);color:#ff9db0}
.hud-alert.ok{border-color:rgba(182,255,60,.5);background:rgba(182,255,60,.08);color:#d6ff9a}
.hud-alert.warn{border-color:rgba(255,184,77,.5);background:rgba(255,184,77,.08);color:#ffd79a}
@keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-5px)}75%{transform:translateX(5px)}}

/* ===== FIRE/SPARK ===== */
.flame{position:fixed;border-radius:50%;pointer-events:none;z-index:998;
  background:radial-gradient(circle,#fff3b0,#ff9d00 50%,#ff3d00 80%,transparent);box-shadow:0 0 8px rgba(255,120,0,.9)}
.a-btn.firing{animation:fireFlash .6s ease}
@keyframes fireFlash{0%{filter:brightness(1)}20%{filter:brightness(1.8);box-shadow:0 0 30px rgba(255,150,0,.95)}100%{filter:brightness(1)}}

@media(prefers-reduced-motion:reduce){*{animation-duration:.001ms!important;animation-iteration-count:1!important;transition-duration:.001ms!important}}
</style>

<div id="curDot"></div><div id="curRing"></div>
<canvas id="bg3d"></canvas>
<div class="orb orb1"></div><div class="orb orb2"></div><div class="orb orb3"></div>
<div class="scanlines"></div><div class="vig"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
/* cursor */
(function(){
  var dot=document.getElementById('curDot'),ring=document.getElementById('curRing'),cx=0,cy=0,rx=0,ry=0;
  addEventListener('mousemove',function(e){cx=e.clientX;cy=e.clientY;dot.style.left=cx+'px';dot.style.top=cy+'px'});
  (function L(){rx+=(cx-rx)*.16;ry+=(cy-ry)*.16;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(L)})();
  document.querySelectorAll('a,button,input,label').forEach(function(el){
    el.addEventListener('mouseenter',function(){document.body.classList.add('hovering')});
    el.addEventListener('mouseleave',function(){document.body.classList.remove('hovering')});
  });
})();
/* 3d bg */
(function(){
  var canvas=document.getElementById('bg3d');if(!canvas||!window.THREE)return;
  var renderer=new THREE.WebGLRenderer({canvas:canvas,alpha:true,antialias:true});
  renderer.setPixelRatio(Math.min(devicePixelRatio,2));renderer.setSize(innerWidth,innerHeight);
  var scene=new THREE.Scene();scene.fog=new THREE.FogExp2(0x04090c,0.055);
  var camera=new THREE.PerspectiveCamera(60,innerWidth/innerHeight,.1,100);camera.position.set(0,0,14);
  var N=1100,pos=new Float32Array(N*3),col=new Float32Array(N*3);
  var pal=[[0,1,.78],[.71,1,.24],[.7,.3,1],[1,.72,.3]];
  for(var i=0;i<N;i++){
    pos[i*3]=(Math.random()-.5)*44;pos[i*3+1]=(Math.random()-.5)*26;pos[i*3+2]=(Math.random()-.5)*34-4;
    var c=pal[(Math.random()*pal.length)|0];col[i*3]=c[0];col[i*3+1]=c[1];col[i*3+2]=c[2];
  }
  var pGeo=new THREE.BufferGeometry();
  pGeo.setAttribute('position',new THREE.BufferAttribute(pos,3));
  pGeo.setAttribute('color',new THREE.BufferAttribute(col,3));
  var points=new THREE.Points(pGeo,new THREE.PointsMaterial({size:.07,vertexColors:true,transparent:true,opacity:.85,blending:THREE.AdditiveBlending,depthWrite:false}));
  scene.add(points);
  var m1=new THREE.MeshBasicMaterial({color:0x00ffc8,wireframe:true,transparent:true,opacity:.22});
  var m2=new THREE.MeshBasicMaterial({color:0xb44bff,wireframe:true,transparent:true,opacity:.18});
  var objs=[
    {m:new THREE.Mesh(new THREE.IcosahedronGeometry(2.4,1),m1),p:[-6,2,-4]},
    {m:new THREE.Mesh(new THREE.TorusGeometry(1.7,.45,10,28),m2),p:[6,-1,-6]},
    {m:new THREE.Mesh(new THREE.OctahedronGeometry(1.6,0),m1),p:[3.5,3.5,-8]},
    {m:new THREE.Mesh(new THREE.TorusKnotGeometry(1.3,.35,60,8),m2),p:[-4,-3.5,-6]}
  ];
  objs.forEach(function(o){o.m.position.set(o.p[0],o.p[1],o.p[2]);scene.add(o.m)});
  var grid=new THREE.GridHelper(70,46,0x00ffc8,0x0a2a22);grid.material.transparent=true;grid.material.opacity=.35;grid.position.y=-7;scene.add(grid);
  var mx=0,my=0;
  addEventListener('mousemove',function(e){mx=(e.clientX/innerWidth-.5)*2;my=(e.clientY/innerHeight-.5)*2});
  addEventListener('resize',function(){camera.aspect=innerWidth/innerHeight;camera.updateProjectionMatrix();renderer.setSize(innerWidth,innerHeight)});
  var clock=new THREE.Clock();
  (function loop(){
    requestAnimationFrame(loop);
    var t=clock.getElapsedTime();
    points.rotation.y=t*.02;
    objs.forEach(function(o,i){o.m.rotation.x=t*(.2+i*.07);o.m.rotation.y=t*(.25+i*.05);o.m.position.y=o.p[1]+Math.sin(t+i*2)*.5});
    grid.position.z=(t*.6)%1.52;
    camera.position.x+=(mx*1.6-camera.position.x)*.04;
    camera.position.y+=(-my*1.2-camera.position.y)*.04;
    camera.lookAt(0,0,0);renderer.render(scene,camera);
  })();
})();
/* fire burst + ripple on submit */
(function(){
  function fireBurst(btn){
    btn.classList.remove('firing');void btn.offsetWidth;btn.classList.add('firing');
    var r=btn.getBoundingClientRect();
    for(var i=0;i<12;i++){
      var f=document.createElement('span');f.className='flame';
      var s=4+Math.random()*7;f.style.width=f.style.height=s+'px';
      f.style.left=(r.left+r.width*Math.random())+'px';f.style.top=(r.top+r.height*.5)+'px';
      document.body.appendChild(f);
      f.animate([{transform:'translateY(0) scale(1)',opacity:1},{transform:'translateY('+(-26-Math.random()*46)+'px) scale(.15)',opacity:0}],{duration:480+Math.random()*380,easing:'ease-out'}).onfinish=function(){f.remove()};
    }
  }
  document.querySelectorAll('.a-btn').forEach(function(b){
    b.addEventListener('click',function(e){
      fireBurst(this);
      var r=this.getBoundingClientRect(),s=document.createElement('span');
      s.className='ripple';s.style.width=s.style.height=Math.max(r.width,r.height)+'px';
      s.style.left=(e.clientX-r.left-s.offsetWidth/2)+'px';s.style.top=(e.clientY-r.top-s.offsetHeight/2)+'px';
      this.appendChild(s);setTimeout(function(){s.remove()},650);
    });
    b.closest('form')&&b.closest('form').addEventListener('submit',function(){fireBurst(b)});
  });
})();
</script>
