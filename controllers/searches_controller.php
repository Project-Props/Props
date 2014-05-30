<?php

class SearchesController extends Controller {
  public function show() {
    $results = Searcher::search($this->param("search")["query"]);
    $props = $results->get_props();
    $productions = $results->get_productions();

    $view = new View("searches/show.php", ["props" => $props,
                                           "productions" => $productions]);
    $view->render();
  }
}
