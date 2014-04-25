<?php

class Router {
  private $routes;

  public function __construct() {
    $this->routes = [];
  }

  public function define_router($path, $fun) {
    $this->routes[$path] = $fun;
  }

  public function process_request($path) {
    foreach ($this->routes as $key => $fun) {
      if ($key == $path) {
        $fun();
        break;
      }
    }
  }
}

?>
