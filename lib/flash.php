<?php

/**
 * Class for showing flash messages.
 *
 * A flash message is a message that appears at the top of the page
 * when the user performs some action.
 * This could be a message like "Congratulations, new prop added!" or "Oh sorry something went wrong
 * in creating that prop". Messages like these should only be shown once so when the user
 * goes to another page or reloads the current page the message should be gone.
 */
class Flash {
  private static $notice;
  private static $alert;
  private static $prepared = false;
  private static $store;

  /**
   * Set the flash to be a notice.
   *
   * @param string $message the message to set as the notice.
   */
  public static function set_notice($message) {
    static::store()->set("flash_notice", $message);
  }

  /**
   * Set the flash to be an alert.
   *
   * @param string $message the message to set as the alert.
   */
  public static function set_alert($message) {
    static::store()->set("flash_alert", $message);
  }

  /**
   * Get the flash notice.
   *
   * @return string the notice.
   */
  public static function notice() {
    if (!static::$prepared) {
      static::prepare();
    }

    $notice = static::$notice;
    static::$notice = NULL;
    return $notice;
  }

  /**
   * Get the flash alert.
   *
   * @return string the alert.
   */
  public static function alert() {
    if (!static::$prepared) {
      static::prepare();
    }

    $alert = static::$alert;
    static::$alert = NULL;
    return $alert;
  }

  /**
   * Check if there is a notice in the flash.
   *
   * @return boolean if there is a notice or not.
   */
  public static function has_notice() {
    return !is_null(static::get_notice());
  }

  /**
   * Check if there is an alert in the flash.
   *
   * @return boolean if there is an alert or not.
   */
  public static function has_alert() {
    return !is_null(static::get_alert());
  }

  /**
   * Prepare the flash for being displayed.
   *
   * This method should be called before any HTML is rendered.
   * Would make sense to do this before the view is rendered.
   */
  public static function prepare() {
    static::$prepared = true;

    static::$notice = static::get_notice();
    static::$alert = static::get_alert();

    static::set_notice(NULL);
    static::set_alert(NULL);
  }

  /**
   * Specify which kind of storage to use for storing the flash messages.
   *
   * This defaults to using a CookieStore which will store the messages in a cookie.
   */
  public static function set_store($store) {
    static::$prepared = false;
    return static::$store = $store;
  }

  /** @access private */
  private static function get_notice() {
    if (static::has_flash("notice")) {
      return static::store()->get("flash_notice");
    } else {
      return NULL;
    }
  }

  /** @access private */
  private static function get_alert() {
    if (static::has_flash("alert")) {
      return static::store()->get("flash_alert");
    } else {
      return NULL;
    }
  }

  /** @access private */
  private static function has_flash($type) {
    return static::store()->has_key("flash_$type");
  }

  /** @access private */
  private static function store() {
    if (is_null(static::$store)) {
      static::$store = new CookieStore();
    }

    return static::$store;
  }
}

/**
 * A key value store using cookies.
 *
 * This is used internally by Flash class
 * @access private
 */
class CookieStore {
  /**
   * Set a key/value pair.
   *
   * @param mixed $key the key.
   * @param mixed $value the value.
   */
  public function set($key, $value) {
    setcookie($key, $value, time()+3600, "/");
  }

  /**
   * Get a the value for the specified key.
   *
   * @param mixed $key the key.
   * @return mixed the value.
   */
  public function get($key) {
    return $_COOKIE[$key];
  }

  /**
   * Check if a value exists for the specified key.
   *
   * @param mixed $key the key.
   * @return boolean if its there or not.
   */
  public function has_key($key) {
    return array_key_exists($key, $_COOKIE);
  }
}

/**
 * A key value store in memory.
 *
 * This is used for testing the Flash class.
 */
class InMemoryStore {
  private $values;

  public function __construct() {
    $this->values = [];
  }

  /**
   * Set a key/value pair.
   *
   * @param mixed $key the key.
   * @param mixed $value the value.
   */
  public function set($key, $value) {
    $this->values[$key] = $value;
  }

  /**
   * Get a the value for the specified key.
   *
   * @param mixed $key the key.
   * @return mixed the value.
   */
  public function get($key) {
    return $this->values[$key];
  }

  /**
   * Check if a value exists for the specified key.
   *
   * @param mixed $key the key.
   * @return boolean if its there or not.
   */
  public function has_key($key) {
    return array_key_exists($key, $this->values);
  }
}