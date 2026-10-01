(function () {
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const root = document.documentElement;
  let ticking = false;
  let mx = 0.5;
  let my = 0.5;

  function stageLayers() {
    return {
      aurora: document.querySelector('.bb-aurora'),
      grid: document.querySelector('.bb-grid'),
      orbs: document.querySelectorAll('.bb-orb'),
      hero: document.querySelector('.hero-cinematic:not(.cmd-hero)'),
      depth: document.querySelector('.hero-radar')
    };
  }

  function onScroll() {
    if (reduce) return;
    const y = window.scrollY || 0;
    const layers = stageLayers();
    if (layers.aurora) layers.aurora.style.transform = 'translate3d(0,' + (y * 0.08) + 'px,-200px) scale(1.15)';
    if (layers.grid) layers.grid.style.transform = 'perspective(900px) rotateX(62deg) scale(1.8) translateY(' + (18 + y * 0.012) + '%)';
    layers.orbs.forEach(function (orb, i) {
      const dir = i % 2 === 0 ? 1 : -1;
      orb.style.transform = 'translate3d(' + (dir * y * 0.04) + 'px,' + (y * -0.06) + 'px,40px)';
    });
    document.querySelectorAll('.scroll-layer').forEach(function (el, i) {
      const speed = 0.04 + (i % 4) * 0.018;
      el.style.transform = 'translate3d(0,' + (y * speed * -1) + 'px,0)';
    });
  }

  function onPointer(e) {
    if (reduce || window.innerWidth < 900) return;
    mx = e.clientX / window.innerWidth - 0.5;
    my = e.clientY / window.innerHeight - 0.5;
    const layers = stageLayers();
    if (layers.hero) {
      layers.hero.style.transform = 'rotateX(' + (my * -4) + 'deg) rotateY(' + (mx * 6) + 'deg)';
    }
    if (layers.depth) {
      layers.depth.style.transform = 'translateY(-50%) rotateY(' + (-18 + mx * 18) + 'deg) rotateX(' + (8 + my * -10) + 'deg)';
    }
    document.querySelectorAll('.bb-orb').forEach(function (orb, i) {
      const k = i % 2 === 0 ? 24 : -18;
      orb.style.marginLeft = (mx * k) + 'px';
      orb.style.marginTop = (my * k) + 'px';
    });
  }

  function tiltCards() {
    document.querySelectorAll('.glass-card').forEach(function (card, i) {
      card.style.animationDelay = (Math.min(i, 12) * 0.07) + 's';
      card.addEventListener('pointermove', function (e) {
        if (reduce || window.innerWidth < 900) return;
        const r = card.getBoundingClientRect();
        const x = (e.clientX - r.left) / r.width - 0.5;
        const y = (e.clientY - r.top) / r.height - 0.5;
        card.style.transform = 'translateY(-8px) perspective(1100px) rotateX(' + (-y * 7) + 'deg) rotateY(' + (x * 9) + 'deg) translateZ(18px)';
      });
      card.addEventListener('pointerleave', function () {
        card.style.transform = '';
      });
    });
  }

  function observeLayers() {
    if (!('IntersectionObserver' in window)) return;
    const io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-inview');
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translate3d(0,0,0)';
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
    document.querySelectorAll('.glass-card, .hero-cinematic, .login-card, .register-card').forEach(function (el) {
      io.observe(el);
    });
  }

  function loop() {
    if (!ticking) {
      window.requestAnimationFrame(function () {
        onScroll();
        ticking = false;
      });
      ticking = true;
    }
  }

  function particles() {
    if (reduce) return;
    const field = document.createElement('div');
    field.className = 'particle-field';
    field.style.cssText = 'position:fixed;inset:0;pointer-events:none;z-index:1;overflow:hidden';
    for (let i = 0; i < 22; i++) {
      const p = document.createElement('i');
      const gold = Math.random() > 0.45;
      p.style.cssText = 'position:absolute;width:' + (1 + Math.random() * 3) + 'px;height:' + (1 + Math.random() * 3) + 'px;left:' + (Math.random() * 100) + '%;top:' + (Math.random() * 100) + '%;border-radius:50%;background:' + (gold ? '#00ffd0' : '#ff2d6a') + ';box-shadow:0 0 10px currentColor;opacity:' + (0.18 + Math.random() * 0.45) + ';animation:bbDust' + i + ' ' + (8 + Math.random() * 12) + 's ease-in-out infinite alternate';
      const s = document.createElement('style');
      s.textContent = '@keyframes bbDust' + i + '{to{transform:translate3d(' + ((Math.random() - 0.5) * 160) + 'px,' + ((Math.random() - 0.5) * 180) + 'px,40px);opacity:.04}}';
      document.head.appendChild(s);
      field.appendChild(p);
    }
    document.body.appendChild(field);
  }

  function toast(msg, kind) {
    var el = document.createElement('div');
    el.className = 'bb-toast ' + (kind || 'ok');
    el.textContent = msg;
    document.body.appendChild(el);
    setTimeout(function () { el.remove(); }, 2600);
  }

  function burst(label) {
    if (reduce) return;
    var wrap = document.createElement('div');
    wrap.className = 'bb-burst';
    wrap.innerHTML = '<span class="ring"></span><span class="stamp">' + (label || 'LOCKED IN') + '</span>';
    document.body.appendChild(wrap);
    setTimeout(function () { wrap.remove(); }, 900);
  }

  function spark(x, y) {
    if (reduce) return;
    for (var i = 0; i < 10; i++) {
      var d = document.createElement('i');
      var ang = (Math.PI * 2 * i) / 10;
      d.style.cssText = 'position:fixed;left:' + x + 'px;top:' + y + 'px;width:6px;height:6px;background:#00ffd0;box-shadow:0 0 10px #00ffd0;z-index:140;pointer-events:none;border-radius:50%';
      document.body.appendChild(d);
      d.animate([
        { transform: 'translate(0,0)', opacity: 1 },
        { transform: 'translate(' + (Math.cos(ang) * 70) + 'px,' + (Math.sin(ang) * 70) + 'px)', opacity: 0 }
      ], { duration: 520, easing: 'ease-out' }).onfinish = function () { d.remove(); };
    }
  }

  function hudActions() {
    document.querySelectorAll('form').forEach(function (form) {
      form.addEventListener('submit', function () {
        var btn = form.querySelector('button[type="submit"], .submit');
        if (btn) btn.classList.add('is-firing');
      });
    });
    document.querySelectorAll('button[type="submit"], .submit').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        spark(e.clientX || (window.innerWidth / 2), e.clientY || (window.innerHeight / 2));
      });
    });
    if (document.querySelector('.key-drop, [data-bb-success], .msgSuccess-flag')) {
      burst('KEY DROP');
    }
    var ok = document.querySelector('.hud-alert.ok, .bb-ok');
    var bad = document.querySelector('.hud-alert.bad');
    if (ok) { burst(ok.getAttribute('data-stamp') || 'LOCKED IN'); toast(ok.textContent.trim().slice(0, 48) || 'SUCCESS', 'ok'); }
    if (bad) toast(bad.textContent.trim().slice(0, 48) || 'FAILED', 'bad');
  }

  window.bbToast = toast;
  window.bbBurst = burst;

  function boot() {
    document.body.classList.add('bb-ready');
    tiltCards();
    observeLayers();
    particles();
    hudActions();
    onScroll();
    window.addEventListener('scroll', loop, { passive: true });
    window.addEventListener('pointermove', onPointer, { passive: true });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
  root.style.setProperty('--ease', 'cubic-bezier(0.22, 1, 0.36, 1)');
})();
