<?php

class ProductionsController extends Controller {
  public function make_new() {
    $production = new Production();

    $view = new View("productions/new.php", ["production" => $production]);
    $view->render();
  }

  public function create() {
    $production = new Production($this->param("production"));

    try {
      $production->save();
      Flash::set_notice("Forestilling tilføjet!");
      $this->redirect_to("/productions/show?id=" . $production->id);
    } catch (InvalidQuery $e) {
      Flash::set_alert("Forestilling ikke tilføjet!");
      $this->redirect_to("/productions/new");
    }
  }
}
