<h1 class="main-headline">
  Søgning efter "<?php echo Request::instance()->param("search")["query"]; ?>"
</h1>

<h4 class="secondary-headline">
  <?php
  $info = [];
  if (array_key_exists("bought_for_id", $filters)) {
    array_push($info, "købt til \"" . Production::find($filters["bought_for_id"])->title . "\"");
  }

  if (array_key_exists("used_in", $filters)) {
    array_push($info, "brugt i \"" . Production::find($filters["used_in"])->title . "\"");
  }

  if (array_key_exists("section_id", $filters)) {
    array_push($info, "i sektionen \"" . Section::find($filters["section_id"])->name . "\"");
  }

  echo join($info, ", ");
  ?>
</h4>

<div class="row">
  <div class="col-sm-6">
    <?php if (sizeof($props) == 0): ?>
      Ingen props matchede den søgning
    <?php else: ?>
      <h1 class="main-headline">Props</h1>

      <?php $this->render_partial("shared/_prop_table.php", ["props" => $props]); ?>
    <?php endif; ?>
  </div>

  <div class="col-sm-6">
    <?php if (sizeof($productions) == 0): ?>
      Ingen forestillinger matchede den søgning
    <?php else: ?>
      <h1 class="main-headline">Forestillinger</h1>

      <?php $this->render_partial("shared/_production_table.php", ["productions" => $productions]); ?>
    <?php endif; ?>
  </div>
</div>
