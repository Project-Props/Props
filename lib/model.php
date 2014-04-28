<?php

abstract class Model {
  private static $connection;

  private static function connection() {
    if (!self::$connection) {
      try {
        self::$connection = new PDO("mysql:host=localhost;dbname=Props_2", 'root', 'root');
      } catch (PDOException $e) {
        echo 'Error: ' . $e;
      }
    }

    return self::$connection;
  }

  public static function find($id) {
    $sql = 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE id = ' . $id;
    $record = self::connection()->query($sql)->fetch();
    $instance = new static;

    foreach ($record as $key => $value) {
      $instance->{$key} = $value;
    }

    return $instance;
  }

  public function save() {}

  public function delete() {}
}

?>
