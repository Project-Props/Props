<?php

class HomeController {
  public function index() {
    $latest_props = Prop::all();
    $latest_productions = Production::all();

    $view = new View("home/index.php", ["props" => $latest_props,
                                        "productions" => $latest_productions]);
    $view->render();
  }
}
