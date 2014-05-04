<?php

/**
 * A request that comes into the app.
 *
 * This class is a singleton class. There can only be one instance of this class.
 * To get it use `Request::instance()`. `new Request()` won't work.
 */
class Request {
  /**
   * object The cached instance that will be returned by `::instance()`.
   */
  private static $instance;

  /**
   * Get the instance. Will be the same instance every time.
   *
   * @return object the instance.
   */
  public static function instance() {
    if (!static::$instance) {
      static::$instance = new Request();
    }

    return static::$instance;
  }

  private function __construct() {}

  /**
   * Get the request url.
   *
   * This will return the url without URL (GET) parameters.
   * So if the requested url is `http://props.com/props?id=10`. Then this would return `/props`.
   *
   * @return mixed the requested url.
   */
  public function url() {
    return explode("?", $_SERVER["REQUEST_URI"])[0];
  }

  /**
   * Get a parameter by key.
   *
   * Will raise an exception if the key is not found.
   *
   * @param string $param the name of the parameter.
   * @return mixed the parameter.
   */
  public function param($param) {
    $param = $this->all_params()[$param];

    if ($param == "false") return false;
    if ($param == "true") return true;

    if (is_numeric($param)) {
      if (preg_match("/\./", $param)) {
        return (float) $param;
      } else {
        return (int) $param;
      }
    }

    return $param;
  }

  /**
   * Check if the parameter is there or not.
   *
   * @param string $param the parameter looking for.
   * @return boolean if the parameter exists or not.
   */
  public function has_param($param) {
    return array_key_exists($param, $this->all_params());
  }

  private function all_params() {
    return $_POST + $_GET;
  }
}
