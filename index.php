<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("controllers/controller.php");
require_once("controllers/props_controller.php");
require_once("views/view.php");

$controller = new PropsController();
$controller->show(42);

?>
