<?php

/**
 * The super class of all controllers.
 *
 * A controllers responsibility is to sit inbetween the view and the database,
 * pull data out of the database and give it to the view.
 */
class Controller {
  /**
   * Get the parameter with the specified name.
   *
   * This just delegates to the Request instance so read its documentation if you wanna know more.
   *
   * @param string $name the name of the parameter to return.
   */
  public function param($name) {
    return Request::instance()->param($name);
  }

  /**
   * Redirect to the specified url.
   *
   * This just delegates to the Router instance so read its documentation if you wanna know more.
   *
   * @param string $url the url to redirect to.
   */
  public function redirect_to($url) {
    return Router::instance()->redirect_to($url);
  }
}

?>
