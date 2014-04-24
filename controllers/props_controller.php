<?php

class PropsController extends Controller {
  public function show($id) {
    $prop_name = "Sofa";

    $view = new View("views/props/show.php", ["name" => $prop_name, "color" => "red"]);
    $view->render();
  }
}

?>
