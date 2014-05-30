<form class="clearfix validate" method="POST" action="/props/update?id=<?php echo $prop->id; ?>">
  <?php $this->render_partial("props/_form.php", ["prop" => $prop]); ?>

  <button class="btn btn-primary right" type="submit">Rediger</button>
</form>
