(function () {
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  var REDUCED = matchMedia('(prefers-reduced-motion: reduce)').matches;
  var MIN_MS = 1400;

  (function clock() {
    var el = $('#bbClock');
    if (!el) return;
    var tick = function () { el.textContent = new Date().toTimeString().slice(0, 8); };
    tick();
    setInterval(tick, 1000);
  })();

  (function telemetry() {
    var ping = $('#bbPing'), lat = $('#bbLat'), ping2 = $('#bbPing2'), ch = $('#bbCh');
    if (!ping && !lat && !ping2) return;
    var tick = function () {
      var ms = 8 + Math.floor(Math.random() * 18);
      if (ping) ping.textContent = ms + 'ms';
      if (lat) lat.textContent = ms + 'ms';
      if (ping2) ping2.textContent = ms + 'ms';
      if (ch) ch.textContent = (Math.floor(Math.random() * 4) + 1).toString().padStart(2, '0');
    };
    tick();
    setInterval(tick, 1600);
  })();

  (function bg() {
    var mount = $('#bbWebgl');
    if (!mount) return;
    if (typeof THREE === 'undefined') {
      document.body.insertAdjacentHTML('afterbegin', '<div class="bb-fallback-bg"></div>');
      mount.remove();
      return;
    }
    var scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0x05070d, 0.042);
    var cam = new THREE.PerspectiveCamera(62, innerWidth / innerHeight, 0.1, 100);
    cam.position.set(0, 2.7, 7.6);
    cam.lookAt(0, -0.4, 0);
    var ren = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    ren.setPixelRatio(Math.min(devicePixelRatio, 2));
    ren.setSize(innerWidth, innerHeight);
    mount.appendChild(ren.domElement);

    var COLS = 150, ROWS = 92, SEP = 0.2, N = COLS * ROWS;
    var pos = new Float32Array(N * 3), col = new Float32Array(N * 3);
    var cA = new THREE.Color(0x00ffd0), cB = new THREE.Color(0xff2d6a), cC = new THREE.Color(0xb6ff3b), tmp = new THREE.Color();
    var k = 0;
    for (var ix = 0; ix < COLS; ix++) {
      for (var iz = 0; iz < ROWS; iz++) {
        var x = (ix - COLS / 2) * SEP, z = (iz - ROWS / 2) * SEP;
        pos[k * 3] = x; pos[k * 3 + 1] = 0; pos[k * 3 + 2] = z;
        tmp.copy(cA).lerp(cB, ix / COLS);
        if (iz / ROWS > 0.72) tmp.lerp(cC, 0.35);
        col[k * 3] = tmp.r; col[k * 3 + 1] = tmp.g; col[k * 3 + 2] = tmp.b; k++;
      }
    }
    var geo = new THREE.BufferGeometry();
    geo.setAttribute('position', new THREE.BufferAttribute(pos, 3));
    geo.setAttribute('color', new THREE.BufferAttribute(col, 3));
    var pts = new THREE.Points(geo, new THREE.PointsMaterial({
      size: 0.048, vertexColors: true, transparent: true, opacity: 0.55,
      blending: THREE.AdditiveBlending, depthWrite: false, sizeAttenuation: true
    }));
    pts.position.y = -2;
    scene.add(pts);

    function wire(g, c, x, y, z, s, op) {
      var m = new THREE.Mesh(g, new THREE.MeshBasicMaterial({ color: c, wireframe: true, transparent: true, opacity: op || 0.18 }));
      m.position.set(x, y, z); m.scale.setScalar(s); scene.add(m); return m;
    }
    var w1 = wire(new THREE.IcosahedronGeometry(1.5, 0), 0x00ffd0, -4.4, 1.6, -3, 1);
    var w2 = wire(new THREE.TorusKnotGeometry(0.9, 0.28, 80, 12), 0xff2d6a, 4.6, 1.2, -4, 1);
    var w3 = wire(new THREE.OctahedronGeometry(1.1, 0), 0xb6ff3b, 2.8, 3.1, -6, 0.9);
    var w4 = wire(new THREE.TetrahedronGeometry(1.05, 0), 0x00ffd0, -3.2, 3.4, -5.2, 0.85, 0.14);
    var w5 = wire(new THREE.TorusGeometry(1.15, 0.035, 8, 48), 0xff2d6a, 0, 0.35, -2.2, 1.6, 0.22);

    var rings = [];
    for (var ri = 0; ri < 3; ri++) {
      var rg = new THREE.RingGeometry(1.6 + ri * 0.7, 1.64 + ri * 0.7, 64);
      var rm = new THREE.Mesh(rg, new THREE.MeshBasicMaterial({
        color: ri === 1 ? 0xff2d6a : 0x00ffd0, side: THREE.DoubleSide,
        transparent: true, opacity: 0.12 - ri * 0.02
      }));
      rm.rotation.x = -Math.PI / 2;
      rm.position.set(0, -1.85, -0.4);
      scene.add(rm);
      rings.push(rm);
    }

    var DN = 560, dp = new Float32Array(DN * 3);
    for (var i = 0; i < DN; i++) {
      dp[i * 3] = (Math.random() - 0.5) * 26;
      dp[i * 3 + 1] = Math.random() * 10 - 2;
      dp[i * 3 + 2] = (Math.random() - 0.5) * 22;
    }
    var dg = new THREE.BufferGeometry();
    dg.setAttribute('position', new THREE.BufferAttribute(dp, 3));
    var dust = new THREE.Points(dg, new THREE.PointsMaterial({
      size: 0.032, color: 0x00ffd0, transparent: true, opacity: 0.38,
      blending: THREE.AdditiveBlending, depthWrite: false
    }));
    scene.add(dust);

    var mx = 0, my = 0, tx = 0, ty = 0;
    addEventListener('mousemove', function (e) {
      tx = (e.clientX / innerWidth - 0.5) * 2;
      ty = (e.clientY / innerHeight - 0.5) * 2;
    }, { passive: true });

    var run = true;
    document.addEventListener('visibilitychange', function () { run = !document.hidden; });

    var base = geo.attributes.position.array;
    function draw(t) {
      requestAnimationFrame(draw);
      if (!run) return;
      var T = t * 0.001;
      for (var i = 0; i < N; i++) {
        var x = base[i * 3], z = base[i * 3 + 2];
        base[i * 3 + 1] = Math.sin(x * 0.55 + T * 1.15) * 0.42
          + Math.cos(z * 0.6 + T * 0.9) * 0.38
          + Math.sin(Math.hypot(x, z) * 0.75 - T * 1.5) * 0.28;
      }
      geo.attributes.position.needsUpdate = true;
      w1.rotation.x = T * 0.18; w1.rotation.y = T * 0.24;
      w2.rotation.x = T * 0.14; w2.rotation.y = -T * 0.2;
      w3.rotation.y = T * 0.3; w3.rotation.x = -T * 0.12;
      w4.rotation.y = -T * 0.22; w4.rotation.z = T * 0.16;
      w5.rotation.z = T * 0.35;
      w5.scale.setScalar(1.55 + Math.sin(T * 1.4) * 0.08);
      for (var ri = 0; ri < rings.length; ri++) {
        var pulse = 1 + Math.sin(T * 1.6 + ri * 1.1) * 0.04;
        rings[ri].scale.set(pulse, pulse, 1);
        rings[ri].material.opacity = 0.1 + Math.sin(T * 2 + ri) * 0.04;
      }
      dust.rotation.y = T * 0.02;
      mx += (tx - mx) * 0.045; my += (ty - my) * 0.045;
      cam.position.x += (mx * 0.85 - cam.position.x) * 0.05;
      cam.position.y += (2.7 - my * 0.55 - cam.position.y) * 0.05;
      cam.lookAt(0, -0.4, 0);
      ren.render(scene, cam);
    }
    requestAnimationFrame(draw);
    addEventListener('resize', function () {
      cam.aspect = innerWidth / innerHeight;
      cam.updateProjectionMatrix();
      ren.setSize(innerWidth, innerHeight);
    });
  })();

  (function cursor() {
    if (matchMedia('(hover:none)').matches) return;
    var d = $('.bb-cur-dot'), r = $('.bb-cur-ring');
    if (!d || !r) return;
    var x = innerWidth / 2, y = innerHeight / 2, rx = x, ry = y;
    addEventListener('mousemove', function (e) {
      x = e.clientX; y = e.clientY;
      d.style.transform = 'translate(' + x + 'px,' + y + 'px) translate(-50%,-50%)';
    }, { passive: true });
    (function loop() {
      rx += (x - rx) * 0.16; ry += (y - ry) * 0.16;
      r.style.transform = 'translate(' + rx + 'px,' + ry + 'px) translate(-50%,-50%)';
      requestAnimationFrame(loop);
    })();
    document.addEventListener('mouseover', function (e) {
      document.body.classList.toggle('bb-cur-hover', !!e.target.closest('a,button,input,label,.bb-tab'));
    });
  })();

  (function tilt() {
    if (REDUCED || matchMedia('(hover:none)').matches) return;
    var card = $('#bbCard');
    var stage = $('.bb-stage');
    if (!card || !stage) return;
    var cx = 0, cy = 0, gx = 0, gy = 0;
    stage.addEventListener('mousemove', function (e) {
      var b = card.getBoundingClientRect();
      gx = ((e.clientX - b.left) / b.width - 0.5) * 2;
      gy = ((e.clientY - b.top) / b.height - 0.5) * 2;
    });
    stage.addEventListener('mouseleave', function () { gx = 0; gy = 0; });
    (function loop() {
      cx += (gx - cx) * 0.08; cy += (gy - cy) * 0.08;
      card.style.transform = 'perspective(900px) rotateY(' + (cx * 5) + 'deg) rotateX(' + (-cy * 4) + 'deg)';
      requestAnimationFrame(loop);
    })();
  })();

  function typeSub() {
    var el = $('#bbType');
    if (!el) return;
    if (REDUCED) { el.textContent = 'SQUAD QUEUE // READY TO DROP'; return; }
    var msg = 'SQUAD QUEUE // READY TO DROP';
    var i = 0;
    (function step() {
      if (i < msg.length) { el.textContent += msg.charAt(i++); setTimeout(step, 34); }
    })();
  }

  (function boot() {
    var done = function () {
      document.body.classList.add('bb-ready');
      typeSub();
    };
    var splash = document.getElementById('bbWelcome');
    if (REDUCED || window.__bbSplashSkip || !splash) { done(); return; }
    var iv = setInterval(function () {
      if (!document.getElementById('bbWelcome') || splash.classList.contains('exit')) {
        clearInterval(iv);
        setTimeout(done, 180);
      }
    }, 80);
  })();

  $$('.bb-eye').forEach(function (b) {
    b.onclick = function () {
      var i = $('#' + b.getAttribute('data-eye'));
      if (!i) return;
      i.type = i.type === 'password' ? 'text' : 'password';
      b.textContent = i.type === 'text' ? 'HIDE' : 'SHOW';
      b.style.color = i.type === 'text' ? 'var(--bb-green)' : '';
    };
  });

  function scorePass(p) {
    if (!p) return 0;
    var s = 0;
    if (p.length >= 6) s++;
    if (p.length >= 10) s++;
    if ((/[a-z]/.test(p) && /[A-Z]/.test(p)) || (/\d/.test(p) && /[a-zA-Z]/.test(p))) s++;
    if (/[^a-zA-Z0-9]/.test(p)) s++;
    return Math.min(4, Math.max(p.length < 6 ? 1 : s, p.length ? 1 : 0));
  }
  var STR_LBL = ['INVALID', 'WEAK', 'MEDIUM', 'STRONG', 'ELITE'];
  var rgPass = $('#rgPass');
  if (rgPass) {
    rgPass.addEventListener('input', function (e) {
      var s = scorePass(e.target.value), m = $('#bbMeter');
      if (m) m.classList.toggle('on', !!e.target.value);
      $$('#bbMeter .bb-segs i').forEach(function (seg, i) { seg.className = i < s ? 'f' + s : ''; });
      var lbl = $('#bbStrLbl');
      if (lbl) {
        lbl.textContent = STR_LBL[s];
        lbl.style.color = ['', '#ff2d6a', '#ffb020', '#b6ff3b', '#00ffd0'][s];
      }
    });
  }

  function checkMatch() {
    var m = $('#bbMatch'), a = $('#rgPass'), b = $('#rgPass2');
    if (!m || !a || !b) return;
    if (!b.value) { m.classList.remove('on'); return; }
    m.classList.add('on');
    m.classList.toggle('ok', a.value === b.value);
    m.classList.toggle('no', a.value !== b.value);
    m.textContent = a.value === b.value ? 'KEYS SYNCED' : 'KEYS MISMATCH';
  }
  var rgPass2 = $('#rgPass2');
  if (rgPass2) rgPass2.addEventListener('input', checkMatch);
  if (rgPass) rgPass.addEventListener('input', checkMatch);

  function fieldWrap(form, name) { return form.querySelector('.bb-field[data-f="' + name + '"]'); }
  function markErr(form, names) {
    names.forEach(function (n) {
      var w = fieldWrap(form, n);
      if (w) { w.classList.remove('err'); void w.offsetWidth; w.classList.add('err'); }
    });
  }
  $$('.bb-field input').forEach(function (i) {
    i.addEventListener('input', function () {
      var f = i.closest('.bb-field');
      if (f) f.classList.remove('err');
    });
  });

  var stampT;
  function stamp(type, title, sub) {
    var el = $('#bbAlert');
    if (!el) return;
    el.className = '';
    void el.offsetWidth;
    el.classList.add(type, 'show');
    el.innerHTML = title + '<small>' + sub + '</small>';
    clearTimeout(stampT);
    stampT = setTimeout(function () { el.classList.remove('show'); }, 2300);
  }
  function toast(msg, bad) {
    var box = $('#bbToast');
    if (!box) return;
    var t = document.createElement('div');
    t.className = 'bb-toast' + (bad ? ' bad' : '');
    t.innerHTML = msg;
    box.appendChild(t);
    setTimeout(function () {
      t.style.opacity = '0';
      t.style.transition = 'opacity .4s';
      setTimeout(function () { t.remove(); }, 400);
    }, 2600);
  }

  function burst(btn) {
    var wrap = btn.querySelector('.bb-burst');
    if (!wrap) return;
    for (var i = 0; i < 18; i++) {
      var p = document.createElement('i');
      wrap.appendChild(p);
      var a = (Math.PI * 2 * i) / 18 + Math.random() * 0.5, d = 34 + Math.random() * 46;
      p.animate([
        { transform: 'translate(-50%,-50%)', opacity: 1 },
        { transform: 'translate(' + (Math.cos(a) * d - 3) + 'px, ' + (Math.sin(a) * d - 3) + 'px) scale(.2)', opacity: 0 }
      ], { duration: 620 + Math.random() * 260, easing: 'cubic-bezier(.1,.8,.3,1)' }).onfinish = function () { p.remove(); };
    }
  }

  function runAuth(btn, idleText) {
    var lbl = btn.querySelector('.lbl'), fill = btn.querySelector('.fill');
    var t0 = Date.now();
    btn.dataset.phase = 'processing';
    btn.disabled = true;
    var iv = setInterval(function () {
      var el = Math.min(1, (Date.now() - t0) / (MIN_MS * 0.85));
      var p = Math.floor(Math.min(92, el * 92 * (0.6 + Math.random() * 0.4)));
      if (fill) fill.style.width = p + '%';
      if (lbl) lbl.innerHTML = 'INJECTING CREDENTIALS <span class="pct">' + p + '%</span>';
    }, 120);
    return new Promise(function (resolve) {
      setTimeout(function () {
        clearInterval(iv);
        if (fill) fill.style.width = '100%';
        if (lbl) lbl.textContent = idleText.indexOf('FORGE') !== -1 ? 'IDENTITY FORGED' : 'ACCESS GRANTED';
        btn.dataset.phase = 'granted';
        burst(btn);
        resolve();
      }, MIN_MS);
    });
  }

  var formLogin = $('#formLogin');
  if (formLogin) {
    formLogin.addEventListener('submit', function (e) {
      var u = (formLogin.username && formLogin.username.value || '').trim();
      var p = formLogin.password && formLogin.password.value || '';
      if (!u || !p) {
        e.preventDefault();
        markErr(formLogin, [!u ? 'username' : '', !p ? 'password' : ''].filter(Boolean));
        toast('FIELDS REQUIRED', true);
        return;
      }
      e.preventDefault();
      var btn = $('#btnLogin');
      runAuth(btn, 'ESTABLISH CONNECTION').then(function () {
        stamp('good', 'ACCESS GRANTED', 'WELCOME BACK, OPERATOR');
        formLogin.submit();
      });
    });
  }

  var formReg = $('#formReg');
  if (formReg) {
    formReg.addEventListener('submit', function (e) {
      var v = function (n) { return (formReg[n] && formReg[n].value || '').trim(); };
      var errs = [];
      if (v('fullname').length < 4) errs.push('fullname');
      if (v('username').length < 4) errs.push('username');
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(v('email'))) errs.push('email');
      if (!formReg.password || formReg.password.value.length < 6) errs.push('password');
      if (!formReg.password2 || formReg.password.value !== formReg.password2.value) errs.push('password2');
      if (v('referral').length < 6) errs.push('referral');
      if (errs.length) {
        e.preventDefault();
        markErr(formReg, errs);
        toast('VALIDATION FAILED', true);
        return;
      }
      e.preventDefault();
      var btn = $('#btnReg');
      runAuth(btn, 'FORGE NEW IDENTITY').then(function () {
        stamp('good', 'IDENTITY FORGED', 'OPERATOR REGISTERED');
        formReg.submit();
      });
    });
  }

  var flash = document.body.getAttribute('data-bb-flash') || '';
  var flashKind = document.body.getAttribute('data-bb-flash-kind') || '';
  if (flash) {
    setTimeout(function () {
      stamp(flashKind === 'ok' ? 'good' : 'bad', flashKind === 'ok' ? 'LOCKED IN' : 'DENIED', flash);
      toast(flash, flashKind !== 'ok');
    }, 700);
  }
})();
