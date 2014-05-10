<? if (sizeof($props) == 0): ?>
  There are no props
<? else: ?>
  <h1>Nyeste props</h1>

  <? $this->render_partial("home/_prop_table.php", ["props" => $props]); ?>
<? endif; ?>

<? if (sizeof($productions) == 0): ?>
  There are no productions
<? else: ?>
  <h1>Forestillinger i repertoire</h1>

  <? $this->render_partial("home/_production_table.php", ["productions" => $productions]); ?>
<? endif; ?>
