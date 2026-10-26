<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<?= view('Layout/HudCss') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?= view('Layout/HudHero', [
    'hudKick' => 'ONLINE SYSTEM · SERVER CONTROL',
    'hudTitle' => 'SERVER',
    'hudAccent' => 'CONTROL',
    'hudOrbit' => 'LIVE CORE',
    'hudIcon' => 'server',
    'hudClocks' => [
        ['label' => 'VAULT CLOCK', 'id' => 'hudClock', 'value' => '--'],
        ['label' => 'STATUS', 'value' => strtoupper((string) ($userDetails1['status'] ?? 'off'))],
        ['label' => 'MOD', 'value' => (string) ($row['modname'] ?? '—')],
    ],
    'hudCta' => [
        ['label' => 'LOADER PACKAGES', 'href' => site_url('store')],
        ['label' => 'DASHBOARD', 'href' => site_url('dashboard')],
    ],
]) ?>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <?php if((int) $user->level === 1) : ?>
        <div class="glass-card rounded-2xl p-6 sm:p-8 dk-reveal d1">
            <h2>SERVER MAINTENANCE</h2>
            <?= form_open('', ['class' => 'space-y-6']) ?>
                <input type="hidden" name="status_form" value="1">
                <div>
                    <label>Current Status: <span><?php echo $userDetails1['status']; ?></span></label>
                    <div class="toggle-row">
                        <span>Maintenance Mode</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="radios" value="on" class="sr-only peer" <?php if ($userDetails1['status'] == "on"){?> checked <?php } ?>>
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </div>
                </div>
                <div>
                    <label>Offline Message: <span class="muted"><?php echo $userDetails1['myinput']; ?></span></label>
                    <textarea name="myInput" rows="3" placeholder="Server is Under Maintenance"></textarea>
                </div>
                <button type="submit" class="w-full py-3 px-6 submit">LOCK MAINTENANCE</button>
            <?= form_close() ?>
        </div>
        <?php endif; ?>

        <div class="glass-card rounded-2xl p-6 sm:p-8 dk-reveal d1">
            <h2>MOD FEATURES</h2>
            <?= form_open('', ['class' => 'space-y-4']) ?>
                <input type="hidden" name="feature_form" value="1">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="toggle-row">
                        <span>ESP</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="ESP" value="on" class="sr-only peer" <?php if ($ModFeatureStatus['ESP'] == "on"){?> checked <?php } ?>>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span>Items</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="Item" value="on" class="sr-only peer" <?php if ($ModFeatureStatus['Item'] == "on"){?> checked <?php } ?>>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span>Aim-Bot</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="AIM" value="on" class="sr-only peer" <?php if ($ModFeatureStatus['AIM'] == "on"){?> checked <?php } ?>>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span>Silent Aim</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="SilentAim" value="on" class="sr-only peer" <?php if ($ModFeatureStatus['SilentAim'] == "on"){?> checked <?php } ?>>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-600"></div>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span>Bullet Track</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="BulletTrack" value="on" class="sr-only peer" <?php if ($ModFeatureStatus['BulletTrack'] == "on"){?> checked <?php } ?>>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span>Memory</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="Memory" value="on" class="sr-only peer" <?php if ($ModFeatureStatus['Memory'] == "on"){?> checked <?php } ?>>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span>Floating Texts</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="Floating" value="on" class="sr-only peer" <?php if ($ModFeatureStatus['Floating'] == "on"){?> checked <?php } ?>>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600"></div>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <span>Settings</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="Setting" value="on" class="sr-only peer" <?php if ($ModFeatureStatus['Setting'] == "on"){?> checked <?php } ?>>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-600"></div>
                        </label>
                    </div>
                </div>
                <button type="submit" class="w-full py-3 px-6 submit mt-6">LOCK FEATURES</button>
            <?= form_close() ?>
        </div>

        <div class="glass-card rounded-2xl p-6 sm:p-8 dk-reveal d2">
            <h2>CHANGE MOD NAME</h2>
            <?= form_open('', ['class' => 'space-y-6']) ?>
                <input type="hidden" name="modname_form" value="1">
                <div>
                    <label>Current Mod Name: <span><?php echo esc($row['modname'] ?? ''); ?></span></label>
                    <input type="text" name="modname" required placeholder="Enter Your New Mod Name">
                </div>
                <button type="submit" class="w-full py-3 px-6 submit">LOCK MOD NAME</button>
            <?= form_close() ?>
        </div>

        <div class="glass-card rounded-2xl p-6 sm:p-8 dk-reveal d2">
            <h2>FLOATING TEXT</h2>
            <?= form_open('', ['class' => 'space-y-6']) ?>
                <input type="hidden" name="_ftext_form" value="1">
                <div>
                    <label>Current Status: <span><?php echo $userDetails2['_status']; ?></span></label>
                    <div class="toggle-row">
                        <span>Safe Mode</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="_ftextr" value="Safe" class="sr-only peer" <?php if ($userDetails2['_status'] == "Safe"){?> checked <?php } ?>>
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-600"></div>
                        </label>
                    </div>
                </div>
                <div>
                    <label>Current Text: <span class="muted"><?php echo $userDetails2['_ftext']; ?></span></label>
                    <input type="text" name="_ftext" required placeholder="Give Feedback Else Key Removed!">
                </div>
                <button type="submit" class="w-full py-3 px-6 submit">LOCK FLOAT TEXT</button>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= view('Layout/HudJs', [
    'hudShape' => 'icosa',
    'hudPhrases' => ['Maintenance, features, and live loader status.', 'Owner locks the bay. Features push to the client.', 'Safe mode floating text stays on the overlay.'],
]) ?>
<?= $this->endSection() ?>
