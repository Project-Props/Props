<?php

class HomeController {
  public function index() {
    // TODO: make this load only the latest props
    $latest_props = Prop::all();

    // TODO: make this load only the latest productions
    $latest_productions = Production::all();

    $view = new View("home/index.php", ["props" => $latest_props,
                                        "productions" => $latest_productions]);
    $view->render();
  }
}
