<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4 py-6">
    <div class="mb-6"><?= $this->include('Layout/msgStatus') ?></div>
    <section class="page-hero">
        <div class="hero-kicker">LOADER BAY</div>
        <h1>LOADER PACKAGES</h1>
        <p>Push loader packages the public client pulls.</p>
    </section>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="glass-card rounded-2xl p-6 sm:p-8">
            <h2 class="text-2xl font-bold mb-6">Current Package</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span>Current LIB</span><strong><?= esc($lib->file) ?></strong></div>
                <div class="flex justify-between"><span>LIB Size</span><strong><?= esc($lib->file_size) ?></strong></div>
                <div class="flex justify-between"><span>LIB ID</span><strong><?= esc($lib->id) ?></strong></div>
                <div class="flex justify-between"><span>LIB Path</span><strong><?= esc($lib->file_type) ?></strong></div>
                <div class="flex justify-between"><span>Last Modified</span><strong><?= esc($lib->time) ?></strong></div>
                <div class="flex justify-between"><span>Current Time</span><strong><?= esc($now) ?></strong></div>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-6 sm:p-8">
            <h2 class="text-2xl font-bold mb-6">Upload Store Package</h2>
            <?= form_open_multipart('store', ['class' => 'space-y-6']) ?>
                <input type="hidden" name="save" value="1">
                <div>
                    <label class="block text-sm font-medium mb-2">Package File</label>
                    <input type="file" name="myfile" required class="w-full px-4 py-3">
                    <p class="text-xs mt-2">Allowed: .so .zip .apk .bin — max 100MB</p>
                </div>
                <button type="submit" class="w-full py-3 px-6 submit">PUSH PACKAGE</button>
            <?= form_close() ?>
        </div>
    </div>
    <div class="glass-card rounded-2xl p-6 sm:p-8">
        <h2 class="text-2xl font-bold mb-6">Version History</h2>
        <?php if ($lib_history) : ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left px-3 py-2">ID</th>
                            <th class="text-left px-3 py-2">File</th>
                            <th class="text-left px-3 py-2">Size</th>
                            <th class="text-left px-3 py-2">Path</th>
                            <th class="text-left px-3 py-2">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lib_history as $row) : ?>
                            <tr>
                                <td class="px-3 py-2"><?= esc($row->id) ?></td>
                                <td class="px-3 py-2"><?= esc($row->file) ?></td>
                                <td class="px-3 py-2"><?= esc($row->file_size) ?></td>
                                <td class="px-3 py-2"><?= esc($row->file_type) ?></td>
                                <td class="px-3 py-2"><?= esc($row->time) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>No store packages uploaded yet.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
