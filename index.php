<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("lib/require_all.php");
require_all_in("lib");
require_all_in("controllers");
require_all_in("models");
require_all_in("null_objects");

$router = Router::instance();

$router->define_route("/", "Home#index");

$router->define_route("/props/new", "Props#make_new");
$router->define_route("/props/create", "Props#create");
$router->define_route("/props/show", "Props#show");
$router->define_route("/props/delete", "Props#delete");
$router->define_route("/props/edit", "Props#edit");
$router->define_route("/props/update", "Props#update");

$router->define_route("/productions/new", "Productions#make_new");
$router->define_route("/productions/create", "Productions#create");
$router->define_route("/productions/show", "Productions#show");
$router->define_route("/productions/delete", "Productions#delete");
$router->define_route("/productions/edit", "Productions#edit");
$router->define_route("/productions/update", "Productions#update");

$router->process_request(Request::instance());

?>
