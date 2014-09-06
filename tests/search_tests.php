<?php 

  class SearchTests extends PHPUnit_Framework_TestCase {


    public function test_search_amount_of_prop_elem() {
      $search_result = Searcher::search("dejlig stol");

      $this->assertEquals(2, sizeof($search_result->get_props()));
    }

    public function test_the_real_searcher_prop_id() {
      $search_result = Searcher::search("dejlig mindre");

      $this->assertEquals(27, $search_result->get_props()[0]->prop_nr);
    }
  }

?>
