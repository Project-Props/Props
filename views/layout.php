<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> <?php echo $this->title(); ?> </title>

    <!-- vendor css -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- our css -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- vendor js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.validator.js"></script>

    <!-- our css -->
    <script src="/assets/js/script.js"></script>
  </head>
  <body>

    <? if (Flash::has_notice() || Flash::has_alert()): ?>
      <div class="flash <? if (Flash::has_alert()) { echo "flash__alert"; } else { echo "flash__notice"; } ?>">
        <?= Flash::notice(); ?>
        <?= Flash::alert(); ?>
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
          <a class="navbar-brand" href="#">Props 2.0</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/props/new">Tilføj prop</a></li>
            <li><a href="/productions/new">Tilføj forestilling</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
      <?php $this->include_template(); ?>

      <footer class="main-footer">
        <p>Props (c) 2014, Props inc.</p>
      </footer> <!-- /.main-footer -->
    </div> <!-- /.container -->

  </body>
</html>
