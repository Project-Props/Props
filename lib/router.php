<?php

/**
 * Exception class that will be thrown when a route doesn't match.
 */
class NoRouteMatches extends Exception {}

/**
 * A class that redirects to another URL.
 */
class Redirecter {
  /**
   * Redirect to a url.
   *
   * @param string $path the url to redirect to.
   */
  public function redirect_to($path) {
    header("Location: " . $path);
    exit();
  }
}

/**
 * A route that maps requested URLs to code.
 *
 * This is a singleton.
 */
class Router {
  /**
   * array the defined routes.
   */
  private $routes;

  /**
   * object the cached instance.
   */
  private static $instance;

  /**
   * Get the instance of this class.
   *
   * This will be the same instance everytime.
   *
   * @return object the instance.
   */
  public static function instance() {
    if (!static::$instance) {
      static::$instance = new Router();
    }

    return static::$instance;
  }

  /**
   * Create a new instance with no routes defined.
   */
  private function __construct() {
    $this->routes = [];
  }

  /**
   * Define a new route.
   *
   * If another route with the same URL is defined then it will be overriden.
   *
   * @param string $path the URL of the route.
   * @param function $fun the function to be executed when the URL gets hit.
   */
  public function define_route($path, $fun) {
    $this->routes[$path] = new Route($path, $fun);
  }

  /**
   * Process an incoming request.
   *
   * @param Request $request the incoming request.
   */
  public function process_request($request) {
    $this->process_matching_route($request);
  }

  private function process_matching_route($request) {
    foreach ($this->routes as $route){
      if ($route->matches($request)) {
        $route->run();
        return;
      }
    }

    throw new NoRouteMatches("No route matches '" . $request->url() . "'");
  }

  /**
   * Redirect to a given URL.
   *
   * @param string $path the URL to redirect to.
   * @param object $redirecter the redirecter to use. This parameter is optional and defaults to a new Redirecter instance.
   */
  public function redirect_to($path, $redirecter = null) {
    if (!$redirecter) {
      $redirecter = new Redirecter();
    }

    $redirecter->redirect_to($path);
  }
}
