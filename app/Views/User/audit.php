<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-4 py-6">
    <div class="mb-6"><?= $this->include('Layout/msgStatus') ?></div>
    <section class="hero-cinematic">
        <div class="hero-kicker">TRACE</div>
        <h1>AUDIT LOG</h1>
        <p>Portal logins, key generation, HWID resets, store uploads, recoveries.</p>
    </section>
    <div class="glass-card rounded-2xl p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left px-3 py-2">ID</th>
                        <th class="text-left px-3 py-2">Operator</th>
                        <th class="text-left px-3 py-2">Action</th>
                        <th class="text-left px-3 py-2">Detail</th>
                        <th class="text-left px-3 py-2">IP</th>
                        <th class="text-left px-3 py-2">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log) : ?>
                        <tr>
                            <td class="px-3 py-2"><?= $log->id ?></td>
                            <td class="px-3 py-2"><?= esc($log->username) ?></td>
                            <td class="px-3 py-2"><span class="hud-chip"><?= esc($log->action) ?></span></td>
                            <td class="px-3 py-2"><?= esc($log->detail) ?></td>
                            <td class="px-3 py-2"><?= esc($log->ip) ?></td>
                            <td class="px-3 py-2"><?= esc($log->created_at) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
