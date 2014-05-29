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

  public function edit() {
    $production = $this->get_production();

    $view = new View("productions/edit.php", ["production" => $production]);
    $view->render();
  }

  public function update() {
    $production = $this->get_production();

    try {
      $production->update(Request::instance()->param("production"));
      Flash::set_notice("Forestilling redigeret");
      $this->redirect_to("/productions/show?id=" . $production->id);
    } catch (InvalidQuery $e) {
      Flash::set_alert("Forestilling ikke redigeret");
      $this->redirect_to("/productions/edit?id=" . $production->id);
    }
  }

  private function get_production() {
    return Production::find(Request::instance()->param("id"));
  }
}
