<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("controllers/controller.php");
require_once("controllers/props_controller.php");
require_once("views/view.php");
require_once("router.php");

$router = new Router();

$router->define_router("/one", function() {
  $controller = new PropsController();
  $controller->show(42);
});

$router->define_router("/two", function() {
  echo "two";
});

$router->define_router("/", function() {
  echo "welcome to the home page";
});

$router->process_request($_SERVER["REQUEST_URI"]);

?>
