<?php

class RecordNotFound extends Exception {}

abstract class Model {
  const DATABASE_NAME = "Props_2";
  const DATABASE_USERNAME = "root";
  const DATABASE_PASSWORD = "root";

  protected static $connection;

  private static function connection() {
    if (!static::$connection) {
      static::$connection = new PDO("mysql:host=localhost;dbname=" . static::DATABASE_NAME,
                                    static::DATABASE_USERNAME,
                                    static::DATABASE_PASSWORD);
    }

    return static::$connection;
  }

  public static function find($id) {
    $sql = "";

    if (is_string($id)) {
      $sql .= "SELECT * FROM " . static::TABLE_NAME . " WHERE id = '" . $id . "'";
    } else {
      $sql .= 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE id = ' . $id;
    }
    $record = static::connection()->query($sql)->fetch();

    if ($record) {
      $instance = static::new_with_assoc_array_as_attributes($record);
      return $instance;
    } else {
      throw new RecordNotFound("Record with id = $id does not exist");
    }
  }

  public static function all() {
    $sql = "SELECT * FROM " . static::TABLE_NAME;
    $records = static::connection()->query($sql)->fetchAll();
    $instances = [];

    foreach ($records as $record) {
      $instance = static::new_with_assoc_array_as_attributes($record);
      array_push($instances, $instance);
    }

    return $instances;
  }

  private static function new_with_assoc_array_as_attributes($record) {
    $instance = new static;

    foreach ($record as $key => $value) {
      $instance->{$key} = $value;
    }

    return $instance;
  }

  private function __call($method, $args) {
    if ($this->has_association($method)) {
      $class = $this->has_one()[$method];
      return $class::find($this->{$method . "_id"});
    }

    $this->throw_undefined_method($method);
  }

  private function has_association($method) {
    return array_key_exists($method, $this->has_one());
  }

  private function throw_undefined_method($method) {
    $class = get_class($this);
    $trace = debug_backtrace();
    $file = $trace[0]['file'];
    $line = $trace[0]['line'];
    trigger_error("Call to undefined method $class::$method() in $file on line $line",
                  E_USER_ERROR);
  }

  protected function has_one() {}
}

?>
