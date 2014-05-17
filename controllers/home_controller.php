<?php

class HomeController {
  public function index() {
    $latest_props = array_reverse(array_slice(Prop::all(), -10, 10));

    $latest_productions = array_reverse(array_slice(Production::all(), -10, 10));

    $view = new View("home/index.php", ["props" => $latest_props,
                                        "productions" => $latest_productions]);
    $view->render();
  }
}
