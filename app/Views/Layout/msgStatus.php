<?php
$danger = session()->getFlashdata('msgDanger');
$success = session()->getFlashdata('msgSuccess');
$warning = session()->getFlashdata('msgWarning');
?>
<?php if ($danger) : ?>
    <div class="hud-alert bad" data-stamp="DENIED"><?= esc($danger) ?></div>
<?php elseif ($success) : ?>
    <div class="hud-alert ok bb-ok" data-stamp="LOCKED IN"><?= esc($success) ?></div>
<?php elseif ($warning) : ?>
    <div class="hud-alert warn" data-stamp="HOLD"><?= esc($warning) ?></div>
<?php elseif (isset($messages) && is_array($messages)) : ?>
    <div class="hud-alert <?= $messages[1] == 'success' ? 'ok' : ($messages[1] == 'danger' ? 'bad' : 'warn') ?>"><?= $messages[0] ?></div>
<?php endif; ?>
