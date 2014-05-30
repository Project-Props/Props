<h1 class="main-headline">
  Søgning efter "<?php echo Request::instance()->param("search")["query"]; ?>"
</h1>

<div class="row">
  <div class="col-sm-6">
    <?php if (sizeof($props) == 0): ?>
      Ingen props matchede den søgning
    <?php else: ?>
      <h1 class="main-headline">Nyeste props</h1>

      <?php $this->render_partial("shared/_prop_table.php", ["props" => $props]); ?>
    <?php endif; ?>
  </div>

  <div class="col-sm-6">
    <?php if (sizeof($productions) == 0): ?>
      Ingen forestillinger matchede den søgning
    <?php else: ?>
      <h1 class="main-headline">Forestillinger i repertoire</h1>

      <?php $this->render_partial("shared/_production_table.php", ["productions" => $productions]); ?>
    <?php endif; ?>
  </div>
</div>
