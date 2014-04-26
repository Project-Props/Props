<?php

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
