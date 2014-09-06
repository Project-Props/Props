<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> <?php echo $this->title(); ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- vendor css -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/chosen.min.css">

    <!-- our css -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- vendor js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.17.0/jquery.tablesorter.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="/assets/js/chosen.jquery.min.js"></script>
    <script src="/assets/js/jquery.validator.js"></script>

    <!-- our js -->
    <script src="/assets/js/script.js"></script>
  </head>
  <body>

    <? if (Flash::present()): ?>
      <div class="flash alert <? if (Flash::has_alert()) echo "alert-danger";
                                 else echo "alert-success"; ?>">
        <?php echo Flash::notice(); ?>
        <?php echo Flash::alert(); ?>
      </div>
    <? endif; ?>

    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Props 2.0</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/props/new">Tilføj prop</a></li>
            <li><a href="/productions/new">Tilføj forestilling</a></li>
            <li><a href="/suppliers/new">Tilføj leverandør</a></li>
            <li><a href="/suppliers">Alle leverandører</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
      <div class="search">
        <form action="/search" method="GET">
          <div class="row">
            <div class="col-sm-9 form-group">
              <input type="search" name="search[query]" class="form-control input-lg" placeholder="Søg...">
            </div>

            <div class="col-sm-3">
              <button type="submit" class="btn btn-primary btn-lg btn-block">Søg</button>
            </div>
          </div>

          <div class="row advanced-search">
            <div class="col-xs-4">
              <?php $this->render_partial("shared/_select_production.php",
                [
                  "name" => "search[bought_for_id]",
                  "placeholder" => "Købt i"
                ]);
              ?>
            </div>

            <div class="col-xs-4">
              <?php $this->render_partial("shared/_select_production.php",
                [
                  "name" => "search[used_in]",
                  "placeholder" => "Brugt i"
                ]);
              ?>
            </div>

            <div class="col-xs-4">
              <?php $this->render_partial("shared/_select_section.php",
                [
                  "name" => "search[section_id]",
                  "placeholder" => "Vælg en sektion"
                ]);
              ?>
            </div>
          </div>
        </form>
      </div>

      <?php $this->include_template(); ?>

      <footer class="main-footer">
        <p>Props (c) 2014, Props inc.</p>
      </footer> <!-- /.main-footer -->
    </div> <!-- /.container -->

  </body>
</html>
