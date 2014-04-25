<?php

class NoRouteMatches extends Exception {}

class Route {
  private $path;
  private $fun;

  public function __construct($path, $fun) {
    $this->path = $path;
    $this->fun = $fun;
  }

  public function matches($path) {
    return $this->path == $path;
  }

  public function run() {
    $fun = $this->fun;
    $fun();
  }
}

class Router {
  private $routes;

  public function __construct() {
    $this->routes = [];
  }

  public function define_route($path, $fun) {
    $this->routes[$path] = new Route($path, $fun);
  }

  public function process_request($path) {
    $this->process_matching_route($path);
  }

  private function process_matching_route($path) {
    foreach ($this->routes as $route){
      if ($route->matches($path)) {
        $route->run();
        return;
      }
    }

    throw new NoRouteMatches("No route matches '" . $path . "'");
  }
}

?>
