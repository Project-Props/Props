<?php

require_once("lib/quoter.php");
require_once("lib/database.php");

class RecordNotFound extends Exception {}

abstract class Model {
  protected static $db;

  public static function find($id) {
    if (is_null($id)) throw new RecordNotFound("Cannot find record without id");

    $sql = 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE id = ' . Quoter::quote_if_string($id);
    $records = static::db()->query($sql);

    if ($records == []) {
      throw new RecordNotFound("Record with id = $id does not exist");
    } else {
      $instance = static::new_with_assoc_array_as_attributes($records[0]);
      return $instance;
    }
  }

  public static function all() {
    $sql = "SELECT * FROM " . static::TABLE_NAME;
    $records = static::db()->query($sql);
    $instances = [];

    foreach ($records as $record) {
      $instance = static::new_with_assoc_array_as_attributes($record);
      array_push($instances, $instance);
    }

    return $instances;
  }

  public function __call($method, $args) {
    $name_of_association = $method;

    if ($this->has_association($name_of_association)) {
      return $this->associated_object($name_of_association);
    }

    $this->throw_undefined_method($method);
  }

  public function save() {
    $vars = (array)$this;

    try {
      static::find($this->id);

      $sql = 'UPDATE ' . static::TABLE_NAME . ' SET ';

      foreach ($vars as $key => $value) {
        if (!is_numeric($key)) {
          $sql .= $key . ' = ' . Quoter::quote_if_string($value) . ', ';
        }
      }

      $sql .= 'WHERE id = ' . $this->id;
      $sql = str_replace(', WHERE', ' WHERE', $sql);
    } catch (RecordNotFound $e) {
      $sql = 'INSERT INTO ' . static::TABLE_NAME . '(id';

      foreach ($vars as $key => $value) {
        if ($key != "id" && $value) {
          $sql .= ', ' . $key;
        }
      }

      $sql .= ') VALUES (' . $this->new_record_id();

      foreach ($vars as $key => $value) {
        if ($key != "id" && $value) {
          $sql .= ', ' . Quoter::quote_if_string($value);
        }
      }

      $sql .= ')';
      $this->id = static::next_insert_id();
    }

    static::db()->query($sql);
  }

  public static function database_connection() {
    return new LocalDatabaseConnection();
  }

  protected function has_one() {
    return [];
  }

  protected static function next_insert_id() {
    $sql = "SELECT id FROM " . static::TABLE_NAME . " ORDER BY id DESC LIMIT 1";
    return static::db()->query($sql)[0]["id"] + 1;
  }

  protected function new_record_id() {
    return 'NULL';
  }

  private function associated_object($name) {
    $class = $this->has_one()[$name];
    return $class::find($this->{$name . "_id"});
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

  private static function db() {
    if (!static::$db) {
      static::$db = new Database(static::database_connection());
    }

    return static::$db;
  }

  private static function new_with_assoc_array_as_attributes($record) {
    $instance = new static;

    foreach ($record as $key => $value) {
      $instance->{$key} = $value;
    }

    return $instance;
  }
}

?>
