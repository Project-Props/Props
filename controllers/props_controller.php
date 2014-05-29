<?php

class PropsController extends Controller {
  public function show() {
    $prop = $this->get_prop();

    $view = new View("props/show.php", ["prop" => $prop]);
    $view->render();
  }

  public function make_new() {
    $prop = new Prop();

    $view = new View("props/new.php", ["prop" => $prop]);
    $view->render();
  }

  public function create() {
    $prop = new Prop($this->param("prop"));

    try {
      $prop->save();

      Flash::set_notice("Prop tilføjet!");

      $this->redirect_to("/");
    } catch (InvalidQuery $e) {
      Flash::set_alert("Prop ikke tilføjet!");

      $this->redirect_to("/props/new");
    }
  }

  public function edit() {
    $prop = $this->get_prop();

    $view = new View("props/edit.php", ["prop" => $prop]);
    $view->render();
  }

  public function update() {
    $prop = $this->get_prop();

    try {
      $prop->update(Request::instance()->param("prop"));

      Flash::set_notice("Prop redigeret");

      $this->redirect_to("/");
    } catch (InvalidQuery $e) {
      Flash::set_alert("Prop ikke redigeret");

      $this->redirect_to("/props/new");
    }
  }

  public function delete() {
    $prop = $this->get_prop();
    $prop->delete();
    Flash::set_notice("Prop slettet!");
    $this->redirect_to("/");
  }

  private function get_prop() {
    return Prop::find(Request::instance()->param("id"));
  }
}

?>
