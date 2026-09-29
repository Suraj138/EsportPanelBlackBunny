<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script>
window.tailwind = window.tailwind || {};
tailwind.config = { corePlugins: { preflight: false } };
</script>
<script src="https://cdn.tailwindcss.com"></script>
<title><?= BASE_NAME ?> - <?= isset($title) ? $title : 'Panel' ?></title>
<link rel="stylesheet" href="<?= base_url('assets/css/natacode.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/natacode.css') ?: time() ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/blackbunny.css') ?>?v=<?= @filemtime(FCPATH . 'assets/css/blackbunny.css') ?: time() ?>">
<script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
<?= $this->renderSection('css') ?>
</head>
<body>
<div class="bb-stage">
    <div class="bb-aurora"></div>
    <div class="bb-grid"></div>
    <div class="bb-orb a"></div>
    <div class="bb-orb b"></div>
    <div class="bb-vignette"></div>
    <div class="bb-film"></div>
</div>
<?= $this->include('Layout/Header') ?>
<main class="min-h-screen">
    <?= $this->renderSection('content') ?>
</main>
<footer class="py-4 mt-8">
    <div class="container">
        <div class="text-center"><small>&copy; <?= date('Y') ?> - <?= BASE_NAME ?> | All Rights Reserved</small></div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.all.min.js" crossorigin="anonymous"></script>
<?= script_tag('assets/js/natacode.js') ?>
<?= script_tag('assets/js/blackbunny.js') ?>
<?= $this->renderSection('js') ?>
</body>
</html>
