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

$router->resource("props");

$router->define_route("/productions", "Productions#index");
$router->resource("productions");

$router->define_route("/suppliers", "Suppliers#index");
$router->resource("suppliers");

$router->define_route("/search", "Searches#show");

$router->process_request(Request::instance());

?>
