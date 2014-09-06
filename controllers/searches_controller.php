<?php

class SearchesController extends Controller {
  public function show() {
    $search_params = $this->param("search");

    $filters = [];

    if ($search_params["bought_for_id"] != "")
      $filters["bought_for_id"] = $search_params["bought_for_id"];

    if ($search_params["used_in"] != "")
      $filters["used_in"] = $search_params["used_in"];

    if ($search_params["section_id"] != "")
      $filters["section_id"] = $search_params["section_id"];

    $results = Searcher::search($search_params["query"], $filters);
    $props = $results->get_props();
    $productions = $results->get_productions();

    $view = new View("searches/show.php", ["props" => $props,
                                           "productions" => $productions]);
    $view->render();
  }
}
