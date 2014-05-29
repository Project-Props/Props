<div class="row">
  <div class="col-sm-6">
    <?php if (sizeof($props) == 0): ?>
      There are no props
    <?php else: ?>
      <h1 class="main-headline">Nyeste props</h1>

      <?php $this->render_partial("home/_prop_table.php", ["props" => $props]); ?>
    <?php endif; ?>
  </div>

  <div class="col-sm-6">
    <?php if (sizeof($productions) == 0): ?>
      There are no productions
    <?php else: ?>
      <h1 class="main-headline">Forestillinger i repertoire</h1>

      <?php $this->render_partial("home/_production_table.php", ["productions" => $productions]); ?>
    <?php endif; ?>
  </div>
</div>
