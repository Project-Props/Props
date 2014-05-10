<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> <?php echo $this->title(); ?> </title>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
  </head>
  <body>

    <header class="main-header">
      <h1>Props 2.0</h1>

      <nav>
        <a href="/productions/new">Tilføj forestilling</a>
        <a href="/props/new">Tilføj prop</a>
      </nav>

      <form action="/search" method="GET">
        <input type="search" name="query" placeholder="Søge tekst">
        <input type="submit" value="Søg">
      </form>
    </header>

    <div class="main-content">
      <?php $this->include_template(); ?>
    </div>

    <footer class="main-footer">
      <p>Footeren er her</p>
    </footer>

  </body>
</html>
