<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("lib/require_all.php");
require_all_in("lib");
require_all_in("controllers");
require_all_in("models");

$router = Router::instance();

$router->define_route("/prop", function() use ($router) {
  $router->redirect_to("/");
});

$router->define_route("/", function() {
  $view = new View("props/show.php");
  $view->render();
});

$router->process_request(Request::instance());

?>
