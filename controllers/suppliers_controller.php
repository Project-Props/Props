<?php

class SuppliersController extends Controller {
  public function index() {
    $suppliers = Supplier::all();

    $view = new View("suppliers/index.php", ["suppliers" => $suppliers]);
    $view->render();
  }

  public function make_new() {
    $supplier = new Supplier();

    $view = new View("suppliers/new.php", ["supplier" => $supplier]);
    $view->render();
  }

  public function create() {
    $supplier = new Supplier($this->param("supplier"));

    try {
      $supplier->save();

      Flash::set_notice("Leverandør tilføjet!");

      $this->redirect_to("/suppliers/show?id=" . $supplier->id);
    } catch (InvalidQuery $e) {
      Flash::set_alert("Leverandør ikke tilføjet!");

      $this->redirect_to("/suppliers/new");
    }
  }

  public function show() {
    $supplier = $this->get_supplier();

    $view = new View("suppliers/show.php", ["supplier" => $supplier]);
    $view->render();
  }

  public function edit() {
    $supplier = $this->get_supplier();

    $view = new View("suppliers/edit.php", ["supplier" => $supplier]);
    $view->render();
  }

  public function update() {
    $supplier = $this->get_supplier();

    try {
      $supplier->update(Request::instance()->param("supplier"));
      Flash::set_notice("Leverandør redigeret");
      $this->redirect_to("/suppliers/show?id=" . $supplier->id);
    } catch (InvalidQuery $e) {
      Flash::set_alert("Leverandør ikke redigeret");
      $this->redirect_to("/suppliers/edit?id=" . $supplier->id);
    }
  }

  private function get_supplier() {
    return Supplier::find(Request::instance()->param("id"));
  }
}
