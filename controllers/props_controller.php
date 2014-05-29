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

  private function get_prop() {
    return Prop::find(Request::instance()->param("id"));
  }
}

?>
