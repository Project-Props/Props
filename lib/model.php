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
    if (!$id) throw new RecordNotFound("Cannot find record without id");

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

  public function __call($method, $args) {
    if ($this->has_association($method)) {
      $class = $this->has_one()[$method];
      return $class::find($this->{$method . "_id"});
    }

    $this->throw_undefined_method($method);
  }

  protected function has_one() {}

  public function save() {
    $vars = (array)$this;

    try {
      static::find($this->id);

      $sql = 'UPDATE ' . static::TABLE_NAME . ' SET ';

      foreach ($vars as $key => $value) {
        if (!is_numeric($key)) {
          if (is_numeric($value)) {
            $sql .= $key . ' = ' . $value . ', ';
          } else {
            $sql .= $key . " = '" . $value . "', ";
          }
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
          if (is_numeric($value)) {
            $sql .= ', ' . $value;
          } else {
            $sql .= ", '" . $value . "'";
          }
        } 
      }

      $sql .= ')';
      $this->id = mysql_insert_id();
    }

    static::connection()->query($sql);
  }

  protected function new_record_id() {
    return 'NULL';
  }
}



?>
