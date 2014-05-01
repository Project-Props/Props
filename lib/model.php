<?php

require_once("lib/quoter.php");

class RecordNotFound extends Exception {}

abstract class Model {
  const DATABASE_NAME = "Props_2";
  const DATABASE_USERNAME = "root";
  const DATABASE_PASSWORD = "root";

  protected static $connection;

  public static function find($id) {
    if (!$id) throw new RecordNotFound("Cannot find record without id");

    $sql = 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE id = ' . Quoter::quote_if_string($id);
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

  public function __call($method, $args) {
    if ($this->has_association($method)) {
      $class = $this->has_one()[$method];
      return $class::find($this->{$method . "_id"});
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
      $this->id = mysql_insert_id();
    }

    static::connection()->query($sql);
  }

  protected function has_one() {}

  protected function new_record_id() {
    return 'NULL';
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

  private static function connection() {
    if (!static::$connection) {
      static::$connection = new PDO("mysql:host=localhost;dbname=" . static::DATABASE_NAME,
                                    static::DATABASE_USERNAME,
                                    static::DATABASE_PASSWORD);
    }

    return static::$connection;
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
