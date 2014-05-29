<?php

  class SearchResult {
    private $props;
    private $productions;

    public function __construct($props, $productions) {
      $this->props = $props;
      $this->productions = $productions;
    }

    public function get_props() {
      return $this->props;
    }

    public function get_productions() {
      return $this->productions;
    }
  }
?>