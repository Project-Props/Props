<?php

/* TODO: add feature tests */

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

  public function show() {
    $production = $this->get_production();

    $view = new View("productions/show.php", ["production" => $production]);
    $view->render();
  }

  private function get_production() {
    return Production::find(Request::instance()->param("id"));
  }
}
