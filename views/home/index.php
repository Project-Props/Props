<?php if (sizeof($props) == 0): ?>
  There are no props
<?php else: ?>
  <h1>Nyeste props</h1>

  <?php $this->render_partial("home/_prop_table.php", ["props" => $props]); ?>
<?php endif; ?>

<?php if (sizeof($productions) == 0): ?>
  There are no productions
<?php else: ?>
  <h1>Forestillinger i repertoire</h1>

  <?php $this->render_partial("home/_production_table.php", ["productions" => $productions]); ?>
<?php endif; ?>
