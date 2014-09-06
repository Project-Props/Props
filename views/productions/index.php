<div class="row">
  <div class="col-sm-12">
    <?php if (sizeof($productions) == 0): ?>
      Der er ingen forestillinger
    <?php else: ?>
      <h1 class="main-headline">Forestillinger</h1>

      <?php $this->render_partial("shared/_production_table.php", ["productions" => $productions]); ?>
    <?php endif; ?>
  </div>
</div>
