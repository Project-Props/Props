<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("controllers/controller.php");
require_once("controllers/props_controller.php");
require_once("views/view.php");
require_once("router.php");

$router = Router::instance();

$router->define_route("/prop", function() use ($router) {
  $router->redirect_to("/");
});

$router->define_route("/", function() {
  echo "home";
});

$router->process_request(Request::instance());

?>
