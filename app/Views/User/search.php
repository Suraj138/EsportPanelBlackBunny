<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-4 py-6">
    <section class="page-hero">
        <div class="hero-kicker">LOCATOR</div>
        <h1>SEARCH GRID</h1>
        <p>Find keys, licenses, and operators across the HUD.</p>
    </section>
    <div class="glass-card rounded-2xl p-6 mb-6">
        <form method="get" action="<?= site_url('search') ?>" class="flex gap-3">
            <input type="text" name="q" value="<?= esc($q) ?>" placeholder="Search keys, users, licenses..." class="flex-1 px-4 py-3">
            <button type="submit" class="px-6 py-3 submit">SCAN</button>
        </form>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="glass-card rounded-2xl p-6">
            <h2 class="text-xl font-bold mb-4">Keys</h2>
            <?php if ($keys) : ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead><tr><th class="text-left px-3 py-2">Key</th><th class="text-left px-3 py-2">Game</th><th class="text-left px-3 py-2">Devices</th></tr></thead>
                        <tbody>
                        <?php foreach ($keys as $k) : ?>
                            <tr>
                                <td class="px-3 py-2 font-mono"><?= esc($k['user_key']) ?></td>
                                <td class="px-3 py-2"><?= esc($k['game']) ?></td>
                                <td class="px-3 py-2"><?= esc($k['max_devices']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p>No keys matched.</p>
            <?php endif; ?>
        </div>
        <div class="glass-card rounded-2xl p-6">
            <h2 class="text-xl font-bold mb-4">Operators</h2>
            <?php if ($users) : ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead><tr><th class="text-left px-3 py-2">User</th><th class="text-left px-3 py-2">Role</th></tr></thead>
                        <tbody>
                        <?php foreach ($users as $u) : ?>
                            <tr>
                                <td class="px-3 py-2"><?= esc($u['username']) ?></td>
                                <td class="px-3 py-2"><?= getLevel($u['level']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p><?= (int) $user->level == 1 ? 'No operators matched.' : 'Operator search is Owner only.' ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
