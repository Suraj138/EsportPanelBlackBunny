<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<style>
.deck-wrap{padding:18px 22px 48px!important;position:relative;z-index:3}
.cmd-hero{position:relative!important;overflow:hidden!important;min-height:240px!important;margin:0 0 18px!important;padding:28px 32px!important;display:grid!important;grid-template-columns:1.4fr .6fr!important;align-items:center!important;border:1px solid rgba(0,255,208,.32)!important;background:radial-gradient(420px 180px at 12% 0%,rgba(0,255,208,.16),transparent 60%),linear-gradient(135deg,rgba(4,12,24,.96),rgba(8,16,36,.92))!important}
.cmd-hero h1{margin:0 0 8px!important;font-family:Orbitron,sans-serif!important;font-size:clamp(1.8rem,4vw,3.2rem)!important;letter-spacing:.1em!important;color:#e8f6ff!important}
.cmd-hero h1 span{color:#00ffd0!important}
.cmd-hero p{max-width:540px!important;color:#8aa3c2!important;margin:0!important}
.cmd-clocks{display:flex!important;gap:28px!important;margin-top:18px!important}
.cmd-clocks small{display:block!important;letter-spacing:.2em!important;color:#b6ff3b!important;font-size:10px!important;font-family:Orbitron,sans-serif!important}
.cmd-clocks strong{display:block!important;font-family:Orbitron,sans-serif!important;font-size:18px!important;color:#00ffd0!important}
.cmd-orbit{position:relative!important;width:180px!important;height:180px!important;justify-self:end!important;display:grid!important;place-items:center!important}
.cmd-orbit small{position:absolute!important;bottom:18px!important;letter-spacing:.16em!important;font-size:9px!important;color:#8aa3c2!important}
.orb-ring{position:absolute!important;border-radius:50%!important;border:1px solid rgba(0,255,208,.28)!important;animation:radarSpin 9s linear infinite!important}
.orb-ring.r1{inset:8%!important}
.orb-ring.r2{inset:22%!important;animation-duration:6s!important;border-color:rgba(255,45,106,.35)!important}
.orb-ring.r3{inset:36%!important;animation-duration:4s!important}
.orb-sweep{position:absolute!important;inset:8%!important;border-radius:50%!important;background:conic-gradient(from 0deg,transparent 0 78%,rgba(0,255,208,.35) 88%,transparent 100%)!important;animation:radarSpin 2.4s linear infinite!important;pointer-events:none!important}
.orb-core{width:64px!important;height:64px!important;display:grid!important;place-items:center!important;font-family:Orbitron,sans-serif!important;font-size:22px!important;color:#031018!important;background:linear-gradient(135deg,#00ffd0,#b6ff3b)!important;clip-path:polygon(50% 0,95% 25%,95% 75%,50% 100%,5% 75%,5% 25%)!important}
.cmd-strip{display:grid!important;grid-template-columns:repeat(6,minmax(0,1fr))!important;gap:10px!important;margin:0 0 18px!important}
.cmd-strip article{display:flex!important;gap:10px!important;align-items:center!important;padding:14px 12px!important;margin:0!important;border:1px solid rgba(0,255,208,.18)!important;background:rgba(4,12,24,.92)!important}
.cmd-strip i{display:block!important;width:8px!important;height:28px!important;background:#00ffd0!important;box-shadow:0 0 10px #00ffd0!important}
.cmd-strip i.lime{background:#b6ff3b!important}
.cmd-strip i.rose{background:#ff2d6a!important}
.cmd-strip i.gold{background:#7dffea!important}
.cmd-strip small{display:block!important;font-size:9px!important;letter-spacing:.16em!important;color:#8aa3c2!important;font-family:Orbitron,sans-serif!important}
.cmd-strip b{font-size:22px!important;display:block!important}
.cmd-grid{display:grid!important;grid-template-columns:1.4fr .8fr!important;gap:14px!important}
.cmd-panel{padding:18px!important;margin:0!important;border:1px solid rgba(0,255,208,.22)!important;background:linear-gradient(160deg,rgba(6,16,32,.96),rgba(4,10,20,.94))!important}
.cmd-panel header{display:flex!important;justify-content:space-between!important;align-items:baseline!important;margin:0 0 14px!important;font-family:Orbitron,sans-serif!important;letter-spacing:.16em!important;font-size:12px!important;color:#00ffd0!important}
.cmd-panel header em{color:#8aa3c2!important;font-style:normal!important;font-size:10px!important}
.flow-row{display:grid!important;grid-template-columns:70px 1fr 48px!important;gap:10px!important;align-items:center!important;margin:0 0 10px!important;font-size:11px!important;letter-spacing:.12em!important}
.flow-track{height:8px!important;background:rgba(0,255,208,.08)!important}
.flow-track b{display:block!important;height:8px!important;background:#00ffd0!important}
.flow-track b.lime{background:#b6ff3b!important}
.flow-track b.rose{background:#ff2d6a!important}
.flow-track b.gold{background:#7dffea!important}
.op-list{list-style:none!important;margin:0!important;padding:0!important;display:grid!important;gap:8px!important}
.op-list li{display:flex!important;justify-content:space-between!important;padding:8px 0!important;border-bottom:1px solid rgba(0,255,208,.1)!important}
.op-actions,.lane-grid{display:grid!important;grid-template-columns:1fr 1fr!important;gap:8px!important;margin-top:14px!important}
.op-actions a,.lane-grid a{text-decoration:none!important;color:#031018!important;background:#00ffd0!important;padding:10px!important;font-family:Orbitron,sans-serif!important;font-size:11px!important;letter-spacing:.08em!important;text-align:center!important}
.lane-grid a{background:transparent!important;color:#e8f6ff!important;border:1px solid rgba(0,255,208,.25)!important;text-align:left!important}
.lane-grid a b{color:#00ffd0!important;margin-right:8px!important;display:inline!important}
.drop-feed{display:grid!important;gap:8px!important}
.drop-row{display:flex!important;gap:10px!important;align-items:center!important;padding:8px 0!important;border-bottom:1px solid rgba(0,255,208,.1)!important}
.drop-row i{display:block!important;width:8px!important;height:8px!important;background:#b6ff3b!important}
@media (max-width:1100px){.cmd-strip{grid-template-columns:repeat(3,minmax(0,1fr))!important}}
@media (max-width:980px){.cmd-hero,.cmd-grid{grid-template-columns:1fr!important}.cmd-orbit{justify-self:center!important;margin-top:12px!important}.cmd-strip{grid-template-columns:repeat(2,minmax(0,1fr))!important}}
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="deck-wrap">
    <div class="mb-4"><?= $this->include('Layout/msgStatus') ?></div>

    <section class="cmd-hero">
        <div class="cmd-scan"></div>
        <div class="cmd-hero-copy">
            <div class="hero-kicker">OPERATOR DECK · <?= esc($roleLabel) ?></div>
            <h1>NODE <span><?= esc(strtoupper(getName($user))) ?></span></h1>
            <p>Live license radar. Keys, pings, store orders and session clock in one tactical frame.</p>
            <?php if (keyExpirySoon($expiration_date, 7)) : ?>
                <div class="hud-alert warn" data-stamp="HOLD">Account window closing · <?= esc($expiration_date) ?></div>
            <?php endif; ?>
            <div class="cmd-clocks">
                <div>
                    <small>SESSION EXPIRES</small>
                    <strong id="exp">--</strong>
                </div>
                <div>
                    <small>LOBBY CLOCK</small>
                    <strong id="lobbyClock">--</strong>
                </div>
            </div>
        </div>
        <div class="cmd-orbit" aria-hidden="true">
            <span class="orb-ring r1"></span>
            <span class="orb-ring r2"></span>
            <span class="orb-ring r3"></span>
            <span class="orb-sweep"></span>
            <span class="orb-core"><?= (int) $stats['online'] ?></span>
            <small>LIVE PINGS</small>
        </div>
    </section>

    <div class="cmd-strip">
        <article>
            <i></i>
            <div>
                <small>TOTAL KEYS</small>
                <b class="hud-stat"><?= (int) $stats['total'] ?></b>
            </div>
        </article>
        <article>
            <i class="lime"></i>
            <div>
                <small>USED / BOUND</small>
                <b class="hud-stat lime"><?= (int) $stats['used'] ?></b>
            </div>
        </article>
        <article>
            <i class="rose"></i>
            <div>
                <small>UNUSED STOCK</small>
                <b class="hud-stat rose"><?= (int) $stats['unused'] ?></b>
            </div>
        </article>
        <article>
            <i class="gold"></i>
            <div>
                <small>FILL RATE</small>
                <b class="hud-stat"><?= (int) $stats['fill'] ?>%</b>
            </div>
        </article>
        <article>
            <i></i>
            <div>
                <small>OPERATORS</small>
                <b class="hud-stat"><?= (int) $stats['users'] ?></b>
            </div>
        </article>
        <article>
            <i class="rose"></i>
            <div>
                <small>STORE QUEUE</small>
                <b class="hud-stat rose"><?= (int) $stats['pending'] ?></b>
            </div>
        </article>
    </div>

    <div class="cmd-grid">
        <section class="cmd-panel">
            <header>
                <span>LICENSE FLOW</span>
                <em><?= (int) $stats['used'] ?> bound · <?= (int) $stats['unused'] ?> idle</em>
            </header>
            <div class="flow-bars">
                <?php
                $maxBar = max(1, (int) $stats['total']);
                $rows = [
                    ['TOTAL', (int) $stats['total'], 'cyan'],
                    ['USED', (int) $stats['used'], 'lime'],
                    ['UNUSED', (int) $stats['unused'], 'rose'],
                    ['ONLINE', (int) $stats['online'], 'gold'],
                ];
                foreach ($rows as $r) :
                    $w = min(100, round(($r[1] / $maxBar) * 100));
                ?>
                <div class="flow-row">
                    <span><?= $r[0] ?></span>
                    <div class="flow-track"><b class="<?= $r[2] ?>" style="width:<?= $w ?>%"></b></div>
                    <strong><?= $r[1] ?></strong>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="cmd-panel">
            <header>
                <span>OPERATOR</span>
                <em><?= esc($user->username) ?></em>
            </header>
            <ul class="op-list">
                <li><span>Role</span><b><?= esc($roleLabel) ?></b></li>
                <li><span>Balance</span><b>Rs <?= (int) $user->saldo ?></b></li>
                <li><span>Login</span><b><?= $time::parse(session()->time_since)->humanize() ?></b></li>
                <li><span>Auto logout</span><b><?= $time::now()->difference($time::parse(session()->time_login))->humanize() ?></b></li>
                <li><span>Public store</span><b><?= !empty($stats['page_on']) ? 'LIVE' : 'OFF' ?></b></li>
            </ul>
            <div class="op-actions">
                <a href="<?= site_url('keys/generate') ?>">GENERATE</a>
                <a href="<?= site_url('keys') ?>">KEYS</a>
                <?php if ((int) $user->level <= 2) : ?>
                <a href="<?= site_url('public-control') ?>">STORE</a>
                <?php endif; ?>
            </div>
        </section>

        <section class="cmd-panel">
            <header>
                <span>RECENT DROPS</span>
                <em>history feed</em>
            </header>
            <div class="drop-feed">
                <?php if ($history) : ?>
                    <?php foreach ($history as $h) : $in = explode('|', $h->info); ?>
                    <div class="drop-row">
                        <i></i>
                        <div>
                            <strong><?= esc($in[0] ?? 'KEY') ?> · <?= esc($in[1] ?? '-') ?>**</strong>
                            <small><?= hoursToDays($in[2] ?? 0) ?> · <?= esc($in[3] ?? '-') ?> devices · <?= $time::parse($h->created_at)->humanize() ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="muted">No drops yet. Generate a key to light this feed.</p>
                <?php endif; ?>
            </div>
        </section>

        <section class="cmd-panel">
            <header>
                <span>QUICK LANES</span>
                <em>jump</em>
            </header>
            <div class="lane-grid">
                <a href="<?= site_url('keys/generate') ?>"><b>01</b> Generate Key</a>
                <a href="<?= site_url('keys') ?>"><b>02</b> View Keys</a>
                <a href="<?= site_url('search') ?>"><b>03</b> Search</a>
                <a href="<?= site_url('settings') ?>"><b>04</b> Settings</a>
                <?php if ((int) $user->level <= 2) : ?>
                <a href="<?= site_url('shop') ?>" target="_blank" rel="noopener"><b>05</b> Public Shop</a>
                <a href="<?= site_url('public-control') ?>"><b>06</b> Public Control</a>
                <?php endif; ?>
                <?php if ((int) $user->level == 1) : ?>
                <a href="<?= site_url('admin/manage-users') ?>"><b>07</b> Manage Users</a>
                <a href="<?= site_url('audit') ?>"><b>08</b> Audit Log</a>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>

<script>
    <?php if (session()->get('welcome_toast')) : ?>
    if (window.bbBurst) window.bbBurst('LOCKED IN');
    if (window.bbToast) window.bbToast('NODE ONLINE', 'ok');
    <?php session()->remove('welcome_toast'); endif; ?>
    var countDownTimer = new Date("<?= esc($expiration_date) ?>").getTime();
    var interval = setInterval(function() {
        var diff = countDownTimer - new Date().getTime();
        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
        var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((diff % (1000 * 60)) / 1000);
        var el = document.getElementById("exp");
        if (!el) return;
        el.innerHTML = days + "D " + hours + "H " + minutes + "M " + seconds + "S";
        if (diff < 0) {
            clearInterval(interval);
            el.innerHTML = "EXPIRED";
        }
    }, 1000);
    function tickLobby() {
        var n = new Date();
        var p = function(v){ return (v < 10 ? '0' : '') + v; };
        var el = document.getElementById('lobbyClock');
        if (el) el.textContent = p(n.getHours()) + ':' + p(n.getMinutes()) + ':' + p(n.getSeconds());
    }
    tickLobby();
    setInterval(tickLobby, 1000);
    function tickStat(el, next, suffix) {
        if (!el) return;
        var cur = parseInt((el.textContent || '0').replace(/\D+/g, ''), 10) || 0;
        var end = parseInt(next, 10) || 0;
        if (cur === end) { el.textContent = end + (suffix || ''); return; }
        var step = (end - cur) / 14;
        var i = 0;
        var t = setInterval(function () {
            i++;
            el.textContent = Math.round(cur + step * i) + (suffix || '');
            if (i >= 14) { el.textContent = end + (suffix || ''); clearInterval(t); }
        }, 28);
    }
    function applyPulse(d, fromZero) {
        if (!d) return;
        var stats = document.querySelectorAll('.cmd-strip b.hud-stat');
        if (fromZero) {
            for (var s = 0; s < stats.length; s++) stats[s].textContent = '0';
        }
        tickStat(stats[0], d.total);
        tickStat(stats[1], d.used);
        tickStat(stats[2], d.unused);
        tickStat(stats[3], d.fill, '%');
        tickStat(stats[4], d.users);
        tickStat(stats[5], d.pending);
        var core = document.querySelector('.orb-core');
        if (core) core.textContent = d.online;
    }
    applyPulse({
        total: <?= (int) $stats['total'] ?>,
        used: <?= (int) $stats['used'] ?>,
        unused: <?= (int) $stats['unused'] ?>,
        fill: <?= (int) $stats['fill'] ?>,
        users: <?= (int) $stats['users'] ?>,
        pending: <?= (int) $stats['pending'] ?>,
        online: <?= (int) $stats['online'] ?>
    }, true);
    function pulseDeck() {
        fetch('<?= site_url('pulse') ?>', { headers: { 'Accept': 'application/json' } })
            .then(function (r) { return r.ok ? r.json() : null; })
            .then(function (d) { applyPulse(d, false); }).catch(function () {});
    }
    setInterval(pulseDeck, 12000);
</script>
<?= $this->endSection() ?>
