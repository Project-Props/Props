<h1 class="main-headline">Lav ny prop</h1>

<form class="clearfix validate" method="POST" action="/props/create">
  <?php $this->render_partial("props/_form.php", ["prop" => $prop]); ?>

  <button class="btn btn-primary right" type="submit">Tilføj</button>
</form>
