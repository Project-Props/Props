<?php

class Flash {
  private static $notice;
  private static $alert;
  private static $prepared = false;
  private static $store;

  public static function set_notice($message) {
    static::store()->set("flash_notice", $message);
  }

  public static function set_alert($message) {
    static::store()->set("flash_alert", $message);
  }

  public static function notice() {
    if (!static::$prepared) {
      static::prepare();
    }

    $notice = static::$notice;
    static::$notice = NULL;
    return $notice;
  }

  public static function alert() {
    if (!static::$prepared) {
      static::prepare();
    }

    $alert = static::$alert;
    static::$alert = NULL;
    return $alert;
  }

  public static function has_notice() {
    return !is_null(static::get_notice());
  }

  public static function has_alert() {
    return !is_null(static::get_alert());
  }

  public static function prepare() {
    static::$prepared = true;

    static::$notice = static::get_notice();
    static::$alert = static::get_alert();

    static::set_notice(NULL);
    static::set_alert(NULL);
  }

  private static function get_notice() {
    if (static::has_flash("notice")) {
      return static::store()->get("flash_notice");
    } else {
      return NULL;
    }
  }

  private static function get_alert() {
    if (static::has_flash("alert")) {
      return static::store()->get("flash_alert");
    } else {
      return NULL;
    }
  }

  private static function has_flash($type) {
    return static::store()->has_key("flash_$type");
  }

  public static function set_store($store) {
    static::$prepared = false;
    return static::$store = $store;
  }

  private static function store() {
    if (is_null(static::$store)) {
      static::$store = new CookieStore();
    }

    return static::$store;
  }
}

class CookieStore {
  public function set($key, $value) {
    setcookie($key, $value, time()+3600, "/");
  }

  public function get($key) {
    return $_COOKIE[$key];
  }

  public function has_key($key) {
    return array_key_exists($key, $_COOKIE);
  }
}

class InMemoryStore {
  private $values;

  public function __construct() {
    $this->values = [];
  }

  public function set($key, $value) {
    $this->values[$key] = $value;
  }

  public function get($key) {
    return $this->values[$key];
  }

  public function has_key($key) {
    return array_key_exists($key, $this->values);
  }
}
