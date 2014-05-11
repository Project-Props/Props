<?php

class HomeController {
  public function index() {
    // TODO: make this load only the latest props
    $latest_props = array_reverse(Prop::all());

    // TODO: make this load only the latest productions
    $latest_productions = array_reverse(Production::all());

    $view = new View("home/index.php", ["props" => $latest_props,
                                        "productions" => $latest_productions]);
    $view->render();
  }
}
