<?= $this->extend('Layout/Starter') ?>
<?= $this->section('css') ?>
<?= view('Layout/HudCss') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?= view('Layout/HudHero', [
    'hudKick' => 'TRACE · AUDIT LOG',
    'hudTitle' => 'AUDIT',
    'hudAccent' => 'LOG',
    'hudOrbit' => 'TRACE CORE',
    'hudIcon' => 'audit',
    'hudClocks' => [
        ['label' => 'VAULT CLOCK', 'id' => 'hudClock', 'value' => '--'],
        ['label' => 'ENTRIES', 'value' => (string) (is_countable($logs) ? count($logs) : 0)],
        ['label' => 'FEED', 'value' => 'LIVE', 'class' => 'lime'],
    ],
    'hudCta' => [
        ['label' => 'DASHBOARD', 'href' => site_url('dashboard')],
        ['label' => 'MANAGE USERS', 'href' => site_url('admin/manage-users')],
    ],
]) ?>
    <div class="glass-card rounded-2xl p-6 dk-reveal d1">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Operator</th>
                        <th>Action</th>
                        <th>Detail</th>
                        <th>IP</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log) : ?>
                        <tr>
                            <td><?= $log->id ?></td>
                            <td><?= esc($log->username) ?></td>
                            <td><span class="hud-chip"><?= esc($log->action) ?></span></td>
                            <td><?= esc($log->detail) ?></td>
                            <td><?= esc($log->ip) ?></td>
                            <td><?= esc($log->created_at) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= view('Layout/HudJs', [
    'hudShape' => 'icosa',
    'hudPhrases' => ['Portal logins, key generation, HWID resets, store uploads, recoveries.', 'Every operator action lands in this trace.', 'IP and timestamp stay attached to the row.'],
]) ?>
<?= $this->endSection() ?>
