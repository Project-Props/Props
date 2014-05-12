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
        </div> <!-- .field -->

        <div class="field">
          <select name="bought_for">
            <option value="">Købt til</option>
            <? foreach (Production::all() as $production): ?>
              <option value="<?= $production-id ?>"><?= $production->title ?></option>
            <? endforeach; ?>
          </select>

          <select name="used_in">
            <option value="">Brugt i</option>
            <? foreach (Production::all() as $production): ?>
              <option value="<?= $production-id ?>"><?= $production->title ?></option>
            <? endforeach; ?>
          </select>

          <select name="section">
            <option value="">Sektion</option>
            <? foreach (Section::all() as $section): ?>
              <option value="<?= $section-id ?>"><?= $section->name ?></option>
            <? endforeach; ?>
          </select>
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
