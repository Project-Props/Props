<?php

class HomeController {
  public function index() {
    $view = new View("props/all.php", ["props" => Prop::all(),
                                       "productions" => Production::all()]);
    $view->render();
  }
}
