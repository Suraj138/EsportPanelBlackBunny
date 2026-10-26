(function () {
  if (window.__hud3d) return;
  window.__hud3d = true;
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var cfg = window.HUD3D || {};
  var canvasId = cfg.canvas || 'hud3d';
  var torchId = cfg.torch || 'hudTorch';
  var heroId = cfg.hero || 'hudHero';
  var orbitId = cfg.orbit || 'hudOrbit';
  var typeId = cfg.type || 'hudTyped';
  var phrases = cfg.phrases || ['BLACK BUNNY HUD ONLINE.'];
  var clockId = cfg.clock || 'hudClock';
  var shape = cfg.shape || 'icosa';
  var forge = 0;
  window.__hudForge = function () { forge = 1; };

  var torch = document.getElementById(torchId);
  addEventListener('mousemove', function (e) {
    if (!torch) return;
    torch.style.setProperty('--tx', e.clientX + 'px');
    torch.style.setProperty('--ty', e.clientY + 'px');
  });

  document.querySelectorAll('.dk-panel,.glass-card,.ctrl-card,.hud-wrap .ctrl-hero').forEach(function (p) {
    if (p.querySelector('.dk-glare')) return;
    var g = document.createElement('div'); g.className = 'dk-glare'; p.appendChild(g);
    var c = document.createElement('div'); c.className = 'dk-corners'; c.innerHTML = '<i></i><i></i><i></i><i></i>'; p.appendChild(c);
  });

  (function () {
    var NS = 'http://www.w3.org/2000/svg';
    function addTrace(el, stroke) {
      if (!el || el.querySelector('.dk-trace')) return;
      var svg = document.createElementNS(NS, 'svg'); svg.setAttribute('class', 'dk-trace');
      var r = document.createElementNS(NS, 'rect'); r.setAttribute('pathLength', '100');
      if (stroke) r.style.stroke = stroke;
      svg.appendChild(r); el.appendChild(svg);
      function size() {
        r.setAttribute('x', 1); r.setAttribute('y', 1);
        r.setAttribute('width', Math.max(0, el.clientWidth - 2));
        r.setAttribute('height', Math.max(0, el.clientHeight - 2));
      }
      size(); addEventListener('resize', size);
    }
    document.querySelectorAll('.dk-panel,.glass-card,.ctrl-card').forEach(function (p) { addTrace(p); });
    var hero = document.getElementById(heroId);
    if (hero) addTrace(hero, '#b6ff3c');
  })();

  document.querySelectorAll('.dk-panel,.glass-card,.ctrl-card').forEach(function (p) {
    p.addEventListener('mousemove', function (e) {
      var r = p.getBoundingClientRect();
      p.style.setProperty('--gx', ((e.clientX - r.left) / r.width * 100) + '%');
      p.style.setProperty('--gy', ((e.clientY - r.top) / r.height * 100) + '%');
    });
  });

  var hero = document.getElementById(heroId), orbit = document.getElementById(orbitId);
  if (hero) addEventListener('mousemove', function (e) {
    if (reduce || innerWidth < 980) return;
    var x = e.clientX / innerWidth - .5, y = e.clientY / innerHeight - .5;
    hero.style.transform = 'perspective(1200px) rotateY(' + (x * 4) + 'deg) rotateX(' + (-y * 3) + 'deg)';
    if (orbit) orbit.style.transform = 'translate(' + (x * 14) + 'px,' + (y * 9) + 'px)';
  });

  var typed = document.getElementById(typeId), pi = 0, ci = 0, del = false;
  (function type() {
    if (!typed || !phrases.length) return;
    var cur = phrases[pi];
    typed.textContent = del ? cur.slice(0, --ci) : cur.slice(0, ++ci);
    if (!del && ci === cur.length) { del = true; return setTimeout(type, 2400); }
    if (del && ci === 0) { del = false; pi = (pi + 1) % phrases.length; }
    setTimeout(type, del ? 22 : 46);
  })();

  var clockEl = document.getElementById(clockId);
  if (clockEl) {
    function tick() {
      var d = new Date();
      var pad = function (n) { return n < 10 ? '0' + n : '' + n; };
      clockEl.textContent = pad(d.getHours()) + ':' + pad(d.getMinutes()) + ':' + pad(d.getSeconds());
    }
    tick(); setInterval(tick, 1000);
  }

  var io = new IntersectionObserver(function (es) {
    es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: .1 });
  document.querySelectorAll('.dk-reveal').forEach(function (el) { io.observe(el); });

  function shock(x, y) {
    var s = document.createElement('span'); s.className = 'dk-shock';
    s.style.left = x + 'px'; s.style.top = y + 'px';
    document.body.appendChild(s); setTimeout(function () { s.remove(); }, 620);
  }
  document.addEventListener('click', function (e) {
    if (reduce) return;
    var t = e.target && e.target.closest ? e.target.closest('.dk-btn,.submit,.ghost-btn,button[type=submit],.hud-chip,.key-mono') : null;
    if (!t) return;
    shock(e.clientX, e.clientY);
    var r = t.getBoundingClientRect(), s = document.createElement('span');
    s.className = 'ripple';
    s.style.cssText += 'width:' + Math.max(r.width, r.height) + 'px;height:' + Math.max(r.width, r.height) + 'px;left:' + (e.clientX - r.left) + 'px;top:' + (e.clientY - r.top) + 'px';
    t.style.position = 'relative'; t.style.overflow = 'hidden'; t.appendChild(s); setTimeout(function () { s.remove(); }, 650);
  });

  document.querySelectorAll('.dk-btn,.submit').forEach(function (b) {
    if (b.querySelector('.dk-btn-wave')) return;
    var w = document.createElement('span'); w.className = 'dk-btn-wave'; w.setAttribute('aria-hidden', 'true');
    w.innerHTML = '<i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>';
    b.appendChild(w);
  });

  setInterval(function () {
    if (reduce) return;
    var ps = document.querySelectorAll('.dk-panel,.glass-card,.ctrl-card');
    if (!ps.length) return;
    var p = ps[(Math.random() * ps.length) | 0];
    p.classList.add('flick'); setTimeout(function () { p.classList.remove('flick'); }, 680);
  }, 7000);

  (function () {
    var canvas = document.getElementById(canvasId); if (!canvas || !window.THREE) return;
    var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
    renderer.setPixelRatio(Math.min(devicePixelRatio, 2)); renderer.setSize(innerWidth, innerHeight);
    var scene = new THREE.Scene(); scene.fog = new THREE.FogExp2(0x04090c, 0.045);
    var camera = new THREE.PerspectiveCamera(58, innerWidth / innerHeight, .1, 100); camera.position.set(0, 0, 24);

    var N = 900, pos = new Float32Array(N * 3), col = new Float32Array(N * 3);
    var pal = [[0, 1, .82], [.71, 1, .24], [.7, .3, 1], [1, .72, .3]];
    for (var i = 0; i < N; i++) {
      pos[i * 3] = (Math.random() - .5) * 52; pos[i * 3 + 1] = (Math.random() - .5) * 30; pos[i * 3 + 2] = (Math.random() - .5) * 42 - 4;
      var c = pal[(Math.random() * pal.length) | 0]; col[i * 3] = c[0]; col[i * 3 + 1] = c[1]; col[i * 3 + 2] = c[2];
    }
    var pg = new THREE.BufferGeometry();
    pg.setAttribute('position', new THREE.BufferAttribute(pos, 3));
    pg.setAttribute('color', new THREE.BufferAttribute(col, 3));
    var pts = new THREE.Points(pg, new THREE.PointsMaterial({ size: .07, vertexColors: true, transparent: true, opacity: .8, blending: THREE.AdditiveBlending, depthWrite: false }));
    scene.add(pts);

    var core, extra = [];
    if (shape === 'hourglass') {
      core = new THREE.Group();
      var glass = new THREE.MeshBasicMaterial({ color: 0x00ffd0, wireframe: true, transparent: true, opacity: .6 });
      var sandMat = new THREE.MeshBasicMaterial({ color: 0xffb84d, wireframe: true, transparent: true, opacity: .5 });
      var top = new THREE.Mesh(new THREE.ConeGeometry(1.5, 2.4, 6, 1, true), glass); top.position.y = 1.2;
      var bottom = new THREE.Mesh(new THREE.ConeGeometry(1.5, 2.4, 6, 1, true), sandMat); bottom.rotation.x = Math.PI; bottom.position.y = -1.2;
      var band = new THREE.Mesh(new THREE.TorusGeometry(1.15, .07, 8, 48), new THREE.MeshBasicMaterial({ color: 0xff2d6a, transparent: true, opacity: .8 }));
      core.add(top); core.add(bottom); core.add(band); scene.add(core);
    } else if (shape === 'torus') {
      core = new THREE.Mesh(new THREE.TorusGeometry(1.8, .42, 10, 28), new THREE.MeshBasicMaterial({ color: 0x00ffd0, wireframe: true, transparent: true, opacity: .28 }));
      scene.add(core);
    } else if (shape === 'octa') {
      core = new THREE.Mesh(new THREE.OctahedronGeometry(2.2, 0), new THREE.MeshBasicMaterial({ color: 0xff2d6a, wireframe: true, transparent: true, opacity: .22 }));
      scene.add(core);
    } else if (shape === 'knot') {
      core = new THREE.Mesh(new THREE.TorusKnotGeometry(1.4, .32, 72, 8), new THREE.MeshBasicMaterial({ color: 0xb44bff, wireframe: true, transparent: true, opacity: .26 }));
      scene.add(core);
    } else {
      core = new THREE.Mesh(new THREE.IcosahedronGeometry(2.6, 1), new THREE.MeshBasicMaterial({ color: 0x00ffd0, wireframe: true, transparent: true, opacity: .22 }));
      scene.add(core);
    }

    var halo = new THREE.Mesh(new THREE.TorusGeometry(3.4, .05, 8, 72), new THREE.MeshBasicMaterial({ color: 0xb6ff3c, wireframe: true, transparent: true, opacity: .28 }));
    halo.position.set(0, 0, -3); scene.add(halo);
    var knot = new THREE.Mesh(new THREE.TorusKnotGeometry(1.1, .24, 64, 8), new THREE.MeshBasicMaterial({ color: 0xb44bff, wireframe: true, transparent: true, opacity: .22 }));
    knot.position.set(7.5, 3, -9); scene.add(knot); extra.push(knot);
    var octa = new THREE.Mesh(new THREE.OctahedronGeometry(1.4, 0), new THREE.MeshBasicMaterial({ color: 0xff2d6a, wireframe: true, transparent: true, opacity: .2 }));
    octa.position.set(-8, -3, -8); scene.add(octa); extra.push(octa);
    var grid = new THREE.GridHelper(80, 50, 0x00ffd0, 0x0a2a22); grid.material.transparent = true; grid.material.opacity = .28; grid.position.y = -7; scene.add(grid);

    var mx = 0, my = 0;
    addEventListener('mousemove', function (e) { mx = (e.clientX / innerWidth - .5) * 2; my = (e.clientY / innerHeight - .5) * 2; });
    addEventListener('resize', function () { camera.aspect = innerWidth / innerHeight; camera.updateProjectionMatrix(); renderer.setSize(innerWidth, innerHeight); });

    if (reduce) { renderer.render(scene, camera); return; }
    var clock = new THREE.Clock();
    (function loop() {
      requestAnimationFrame(loop);
      var t = clock.getElapsedTime();
      var boost = forge ? 2.6 : 0;
      core.rotation.y = t * (.35 + boost);
      core.rotation.x = Math.sin(t * .8) * (.18 + boost * .08);
      core.position.y = Math.sin(t * .9) * .32;
      halo.rotation.z = t * (.4 + boost * .5);
      halo.rotation.x = Math.sin(t * .5) * .3;
      extra.forEach(function (m, i) { m.rotation.x = t * (.24 + i * .1); m.rotation.y = t * (.3 + i * .12); });
      pts.rotation.y = t * .02;
      grid.position.z = (t * .55) % 1.6;
      camera.position.x += (mx * 2.4 - camera.position.x) * .045;
      camera.position.y += (-my * 1.6 - camera.position.y) * .045;
      camera.position.z += (((forge ? 13 : 24)) - camera.position.z) * .03;
      camera.lookAt(0, 0, 0);
      renderer.render(scene, camera);
    })();
  })();
})();
