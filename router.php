<?php

class Request {
  private static $instance;

  public static function instance() {
    if (!self::$instance) {
      self::$instance = new Request();
    }

    return self::$instance;
  }

  private function __construct() {}

  public function uri() {
    return explode("?", $_SERVER["REQUEST_URI"])[0];
  }

  public function params($param) {
    $all_params = $_POST + $_GET;
    return $all_params[$param];
  }
}

class NoRouteMatches extends Exception {}

class Route {
  private $path;
  private $fun;

  public function __construct($path, $fun) {
    $this->path = $path;
    $this->fun = $fun;
  }

  public function run() {
    $fun = $this->fun;
    $fun();
  }

  public function matches($request) {
    return $request->uri() == $this->path;
  }
}

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

?>
