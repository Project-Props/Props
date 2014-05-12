<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> <?php echo $this->title(); ?> </title>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="/assets/js/script.js"></script>
  </head>
  <body>

    <? if (Flash::has_notice() || Flash::has_alert()): ?>
      <div class="flash <? if (Flash::has_alert()) { echo "flash__alert"; } else { echo "flash__notice"; } ?>">
        <?= Flash::notice(); ?>
        <?= Flash::alert(); ?>
      </div>
    <? endif; ?>

    <header class="main-header">
      <h1><a href="/">Props 2.0</a></h1>

      <nav>
        <a href="/props/new">Tilføj prop</a>
        <a href="/productions/new">Tilføj forestilling</a>
      </nav>

      <form action="/search" method="GET">
        <div class="field">
          <input type="search" name="query" placeholder="Søge tekst">
          <input type="submit" value="Søg">

          <button class="js-toggle-advanced-search" type="button">Advanceret søgning</button>
        </div> <!-- .field -->

        <div class="field advanced-search hide">
          <? $this->render_partial("shared/_select_production.php",
            ["name" => "bought_for",
             "placeholder" => "Købt til"]); ?>

          <? $this->render_partial("shared/_select_production.php",
            ["name" => "used_in",
             "placeholder" => "Brugt i"]); ?>

          <? $this->render_partial("shared/_select_section.php",
            ["name" => "section",
             "placeholder" => "Sektion"]); ?>
        </div> <!-- .field -->
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
