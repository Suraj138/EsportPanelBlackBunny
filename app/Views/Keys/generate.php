<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <section class="page-hero">
            <div class="hero-kicker">ARMORY</div>
            <h1>GENERATE LICENSE</h1>
            <p>Forge a loader key. Duration starts on first login.</p>
        </section>
        <div class="mb-6">
            <?= $this->include('Layout/msgStatus') ?>
        </div>
        
        <?php if (session()->getFlashdata('user_key')) : ?>
            <div class="glass-card key-drop rounded-2xl p-8 mb-6" data-bb-success="1">
                <div class="flex items-center mb-6">
                    <div class="gradient-bg w-16 h-16 rounded-xl flex items-center justify-center mr-4">
                        <span class="orb-core" style="width:40px;height:40px;font-size:12px">OK</span>
                    </div>
                    <h2 class="text-3xl font-bold">KEY DROP COMPLETE</h2>
                </div>
                
                <div class="space-y-4 bg-gradient-to-r from-green-50 to-teal-50 rounded-xl p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Game</p>
                            <p class="text-lg font-semibold text-gray-800"><?= session()->getFlashdata('game') ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Duration</p>
                            <p class="text-lg font-semibold text-gray-800"><?= session()->getFlashdata('duration') ?> Hours</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Max Devices</p>
                            <p class="text-lg font-semibold text-gray-800"><?= session()->getFlashdata('max_devices') ?> Devices</p>
                        </div>
                    </div>
                    
                    <?php
                        $dropKeys = preg_split('/\s+/', trim((string) (session()->getFlashdata('generated_keys') ?: session()->getFlashdata('user_key'))));
                        $dropKeys = array_values(array_filter($dropKeys));
                        $dropCount = (int) (session()->getFlashdata('bulk_count') ?: count($dropKeys));
                        $dropDur = (int) session()->getFlashdata('duration');
                        $dropDev = (int) session()->getFlashdata('max_devices');
                        $dropGame = (string) session()->getFlashdata('game');
                    ?>
                    <div class="mt-6">
                        <p class="muted mb-2">License Key<?= $dropCount > 1 ? 's ('.$dropCount.')' : '' ?></p>
                        <textarea id="mytext" class="w-full font-mono" rows="<?= min(8, max(1, $dropCount)) ?>" readonly style="color:#00ffd0;background:rgba(0,0,0,.35);border:1px solid rgba(0,255,208,.28);padding:12px"><?= esc(implode("\n", $dropKeys)) ?></textarea>
                        <div class="shop-cta" style="display:flex;gap:10px;flex-wrap:wrap;margin:12px 0">
                            <button type="button" class="submit" onclick="copyDetails()">COPY</button>
                            <button type="button" class="ghost-btn" onclick="shareText()">SHARE</button>
                        </div>
                        <div id="keyChips" class="mt-3" style="display:flex;flex-wrap:wrap;gap:8px">
                            <?php foreach ($dropKeys as $k) : ?>
                                <button type="button" class="hud-chip key-chip" data-key="<?= esc($k, 'attr') ?>"><?= esc($k) ?></button>
                            <?php endforeach; ?>
                        </div>
                        <p class="muted mt-2">Copy = details. Tap a key = that key only.</p>
                    </div>
                    <script>
                    window.bbDrop = {
                        keys: <?= json_encode($dropKeys) ?>,
                        count: <?= (int) $dropCount ?>,
                        duration: <?= (int) $dropDur ?>,
                        devices: <?= (int) $dropDev ?>,
                        game: <?= json_encode($dropGame) ?>
                    };
                    </script>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Generate Key Form -->
        <div class="glass-card rounded-2xl p-8 animate-fade-in-up" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="gradient-bg-3 w-12 h-12 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Create License</h2>
                </div>
                <a href="<?= site_url('keys') ?>" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </a>
            </div>
            
            <?= form_open('', ['class' => 'space-y-6']) ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Game -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Game</label>
                        <?= form_dropdown(['class' => 'w-full px-4 py-3 bg-white/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all', 'name' => 'game', 'id' => 'game'], $game, old('game') ?: '') ?>
                        <?php if ($validation->hasError('game')) : ?>
                            <small class="text-red-500 text-xs mt-1"><?= $validation->getError('game') ?></small>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Max Devices -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Max Devices</label>
                        <input type="number" name="max_devices" id="max_devices" value="<?= old('max_devices') ?: 1 ?>" class="w-full px-4 py-3 bg-white/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all" placeholder="1">
                        <?php if ($validation->hasError('max_devices')) : ?>
                            <small class="text-red-500 text-xs mt-1"><?= $validation->getError('max_devices') ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Duration -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                    <?= form_dropdown(['class' => 'w-full px-4 py-3 bg-white/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all', 'name' => 'duration', 'id' => 'duration'], $duration, old('duration') ?: '') ?>
                    <?php if ($validation->hasError('duration')) : ?>
                        <small class="text-red-500 text-xs mt-1"><?= $validation->getError('duration') ?></small>
                    <?php endif; ?>
                </div>
                
                <!-- Custom Key Toggle -->
                <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
                    <input type="checkbox" name="check" id="check" onchange="fupi(this)" class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500">
                    <label for="check" class="ml-3 text-gray-800 font-medium cursor-pointer">Custom Key</label>
                </div>
                
                <!-- Custom Key Input -->
                <div id="custom-key-section" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Input Your Key</label>
                    <input type="text" name="cuslicense" id="custom" minlength="4" maxlength="16" class="w-full px-4 py-3 bg-white/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all" placeholder="Enter custom key">
                </div>
                
                <!-- Bulk Keys -->
                <div id="bulk-section">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bulk Keys</label>
                     <select name="loopcount" id="hulala" class="w-full px-4 py-3 bg-white/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all">
                          <option value="1">1 Key</option>
                         <option value="5">5 Keys</option>
                         <option value="10">10 Keys</option>
                         <option value="25">25 Keys</option>
                         <option value="50">50 Keys</option>
                         <option value="100">100 Keys</option>
                     </select>
                </div>
                
                <input type="text" id="textinput" name="custominput" hidden>
                
                <!-- Estimation -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estimation</label>
                    <input type="text" id="estimation" class="w-full px-4 py-3 bg-gradient-to-r from-green-50 to-teal-50 border border-green-200 rounded-xl font-bold text-green-700" placeholder="Your order will total" readonly>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full py-4 px-6 submit">
                    FIRE GENERATE
                </button>
            <?= form_close() ?>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
</style>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        var price = JSON.parse('<?= $price ?>');
        getPrice(price);
        $("#max_devices, #duration, #game, #hulala").change(function() {
            getPrice(price);
        });
        function getPrice(price) {
            var device = $("#max_devices").val();
            var durate = $("#duration").val();
            var bulk = parseInt($("#hulala").val() || '1', 10);
            var gprice = price[durate];
            if (!isNaN(gprice)) {
                var result = (device * gprice * bulk);
                $("#estimation").val(result);
            } else {
                $("#estimation").val('Estimation error');
            }
        }
    });

    function fupi(obj) {
        if($(obj).is(":checked")){
            document.getElementById("custom-key-section").style.display = "block";
            document.getElementById("bulk-section").style.display = "none";
            document.getElementById("textinput").value = "custom";
        } else {
            document.getElementById("custom-key-section").style.display = "none";
            document.getElementById("bulk-section").style.display = "block";
            document.getElementById("textinput").value = "auto";
        }
    }
    
    function bbCopy(v, toast) {
        v = String(v || '');
        if (!v) return;
        if (navigator.clipboard && navigator.clipboard.writeText) navigator.clipboard.writeText(v);
        else {
            var t = document.createElement('textarea');
            t.value = v; document.body.appendChild(t); t.select();
            try { document.execCommand('copy'); } catch (e) {}
            t.remove();
        }
        if (window.bbToast) window.bbToast(toast || 'COPIED', 'ok');
        if (window.bbBurst) window.bbBurst('COPIED');
    }
    function copyDetails() {
        var d = window.bbDrop || {};
        var keys = d.keys && d.keys.length ? d.keys.join('\n') : (document.getElementById('mytext') || {}).value || '';
        var n = d.count || (keys ? keys.split(/\s+/).filter(Boolean).length : 0);
        var text = 'BLACK BUNNY KEY\nKeys: ' + n + '\nDuration: ' + (d.duration || '-') + ' Hours\nDevices: ' + (d.devices || '-') + '\n' + keys + '\nThanks for purchase.';
        bbCopy(text, 'DETAILS COPIED');
    }
    function copyOneKey(key) {
        bbCopy(String(key || '').trim() + '\nThanks for purchase.', 'KEY COPIED');
    }
    function copyText() { copyDetails(); }
    function shareText() {
        var d = window.bbDrop || {};
        var keys = d.keys && d.keys.length ? d.keys.join('\n') : (document.getElementById('mytext') || {}).value || '';
        var text = 'BLACK BUNNY KEY\nKeys: ' + (d.count || 1) + '\nDuration: ' + (d.duration || '-') + ' Hours\n' + keys + '\nThanks for purchase.';
        if (navigator.share) navigator.share({ title: 'BLACK BUNNY KEY', text: text });
        else copyDetails();
    }
    document.addEventListener('click', function(e) {
        var chip = e.target.closest('.key-chip');
        if (chip) copyOneKey(chip.getAttribute('data-key'));
    });
</script>
<?= $this->endSection() ?>