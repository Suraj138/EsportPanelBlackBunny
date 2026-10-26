<?php
$hudPhrases = isset($hudPhrases) ? array_values($hudPhrases) : ['BLACK BUNNY HUD ONLINE.'];
$hudShape   = $hudShape ?? 'icosa';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
window.HUD3D = {
  canvas: 'hud3d',
  torch: 'hudTorch',
  hero: 'hudHero',
  orbit: 'hudOrbit',
  type: 'hudTyped',
  clock: 'hudClock',
  shape: <?= json_encode($hudShape) ?>,
  phrases: <?= json_encode($hudPhrases) ?>
};
</script>
<script src="<?= base_url('assets/js/hud3d.js') ?>?v=<?= @filemtime(FCPATH . 'assets/js/hud3d.js') ?: time() ?>"></script>
