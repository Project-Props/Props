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
    return $this->all_params()[$param];
  }

  public function has_param($param) {
    return array_key_exists($param, $this->all_params());
  }

  private function all_params() {
    return $_POST + $_GET;
  }
}
