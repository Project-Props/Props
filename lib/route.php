<?php

/**
 * A route
 *
 * A route consists of a path (or url) and a function to run when that route is hit.
 * This class is used internally by the Router.
 */
class Route {
  /**
   * The path of the route.
   */
  private $path;

  /**
   * A function that the route can run.
   */
  private $fun;

  /**
   * Make a new route given a path and a function.
   *
   * @param string $path the path of the route.
   * @param function $fun the function the route can run.
   */
  public function __construct($path, $fun) {
    $this->path = $path;
    $this->fun = $fun;
  }

  /**
   * Run the route.
   *
   * This will simply execute the function.
   */
  public function run() {
    $fun = $this->fun;
    $fun();
  }

  /**
   * Test if the path of a route matches the path of an incoming request.
   *
   * @param the request to match against.
   * @return boolean if there is match.
   */
  public function matches($request) {
    return $request->uri() == $this->path;
  }
}
