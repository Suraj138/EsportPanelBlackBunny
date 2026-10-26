<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<?= view('Layout/HudCss') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?= view('Layout/HudHero', [
    'hudKick' => 'LOADER BAY · PACKAGES',
    'hudTitle' => 'LOADER',
    'hudAccent' => 'PACKAGES',
    'hudOrbit' => 'BAY CORE',
    'hudIcon' => 'pack',
    'hudClocks' => [
        ['label' => 'VAULT CLOCK', 'id' => 'hudClock', 'value' => '--'],
        ['label' => 'LIB', 'value' => (string) ($lib->file ?? '—')],
        ['label' => 'SIZE', 'value' => (string) ($lib->file_size ?? '—')],
    ],
    'hudCta' => [
        ['label' => 'ONLINE SYSTEM', 'href' => site_url('Server')],
        ['label' => 'DASHBOARD', 'href' => site_url('dashboard')],
    ],
]) ?>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="glass-card rounded-2xl p-6 sm:p-8 dk-reveal d1">
            <h2>CURRENT PACKAGE</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span>Current LIB</span><strong><?= esc($lib->file) ?></strong></div>
                <div class="flex justify-between"><span>LIB Size</span><strong><?= esc($lib->file_size) ?></strong></div>
                <div class="flex justify-between"><span>LIB ID</span><strong><?= esc($lib->id) ?></strong></div>
                <div class="flex justify-between"><span>LIB Path</span><strong><?= esc($lib->file_type) ?></strong></div>
                <div class="flex justify-between"><span>Last Modified</span><strong><?= esc($lib->time) ?></strong></div>
                <div class="flex justify-between"><span>Current Time</span><strong><?= esc($now) ?></strong></div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-6 sm:p-8 dk-reveal d1">
            <h2>UPLOAD STORE PACKAGE</h2>
            <?= form_open_multipart('store', ['class' => 'space-y-6']) ?>
                <input type="hidden" name="save" value="1">
                <div>
                    <label>Package File</label>
                    <input type="file" name="myfile" required>
                    <p class="muted">Allowed: .so .zip .apk .bin — max 100MB</p>
                </div>
                <button type="submit" class="w-full py-3 px-6 submit">PUSH PACKAGE</button>
            <?= form_close() ?>
        </div>
    </div>
    <div class="glass-card rounded-2xl p-6 sm:p-8 dk-reveal d2">
        <h2>VERSION HISTORY</h2>
        <?php if ($lib_history) : ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>File</th>
                            <th>Size</th>
                            <th>Path</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lib_history as $row) : ?>
                            <tr>
                                <td><?= esc($row->id) ?></td>
                                <td><?= esc($row->file) ?></td>
                                <td><?= esc($row->file_size) ?></td>
                                <td><?= esc($row->file_type) ?></td>
                                <td><?= esc($row->time) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p class="muted">No store packages uploaded yet.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= view('Layout/HudJs', [
    'hudShape' => 'octa',
    'hudPhrases' => ['Push loader packages the public client pulls.', 'Allowed: so zip apk bin. Max 100MB.', 'History stays in the bay after every push.'],
]) ?>
<?= $this->endSection() ?>
