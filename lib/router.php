<?php

class NoRouteMatches extends Exception {}

class Router {
  private $routes;
  private static $instance;

  public static function instance() {
    if (!self::$instance) {
      self::$instance = new Router();
    }

    return self::$instance;
  }

  private function __construct() {
    $this->routes = [];
  }

  public function define_route($path, $fun) {
    $this->routes[$path] = new Route($path, $fun);
  }

  public function process_request($request) {
    $this->process_matching_route($request);
  }

  public function redirect_to($path) {
    header("Location: " . $path);
    exit();
  }

  private function process_matching_route($request) {
    foreach ($this->routes as $route){
      if ($route->matches($request)) {
        $route->run();
        return;
      }
    }

    throw new NoRouteMatches("No route matches '" . $request->uri() . "'");
  }
}