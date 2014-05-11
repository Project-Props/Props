<?php

/**
 * A generic controller class that right now does nothing.
 */
class Controller {
  public function param($name) {
    return Request::instance()->param($name);
  }

  public function redirect_to($url) {
    return Router::instance()->redirect_to($url);
  }
}

?>
