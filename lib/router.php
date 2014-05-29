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
 * This is a singleton. Use `Router::instance()` to get to the instance.
 *
 * Here is an example of how to use it:
 *
 * <pre>
 * // get the instance
 * $router = Router::instance();
 *
 * // define a new route
 * // when the URL "/" is hit, the router will run the callback
 * $router->define_route("/", function() {
 *   // instantiate controller, render view, whatever...
 * });
 *
 * // tell the router to process the incoming request
 * $router->process_request(Request::instance());
 * </pre>
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
  // TODO: write tests for new method signature and method path stuff
  public function define_route($path, $lambda_or_method_path) {
    $fun;

    if (is_string($lambda_or_method_path)) {
      $controller = explode("#", $lambda_or_method_path)[0] . "Controller";
      $method = explode("#", $lambda_or_method_path)[1];

      $fun = function() use ($controller, $method) {
        $c = new $controller;
        $c->{$method}();
      };
    } else {
      $fun = $lambda_or_method_path;
    }

    $this->routes[$path] = new Route($path, $fun);
  }

  /**
   * Process an incoming request.
   *
   * @param Request $request the incoming request.
   */
  public function process_request($request) {
    if (session_id() == '') {
      session_start();
    }

    $this->process_matching_route($request);

    Flash::clear();
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

  public function resource($name) {
    $class_name = ucfirst($name);
    $this->define_route("/$name/new", "$class_name#make_new");
    $this->define_route("/$name/create", "$class_name#create");
    $this->define_route("/$name/show", "$class_name#show");
    $this->define_route("/$name/delete", "$class_name#delete");
    $this->define_route("/$name/edit", "$class_name#edit");
    $this->define_route("/$name/update", "$class_name#update");
  }
}
