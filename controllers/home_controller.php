<?php

class HomeController {
  public function index() {
    $latest_props = array_reverse(Prop::all_limit(10));

    $latest_productions = array_reverse(Production::all_limit(10));

    $view = new View("home/index.php", ["props" => $latest_props,
                                        "productions" => $latest_productions]);
    $view->render();
  }
}
