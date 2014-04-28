<?php

abstract class Model {
  const DATABASE_NAME = "Props_2";
  const DATABASE_USERNAME = "root";
  const DATABASE_PASSWORD = "root";

  private static $connection;

  private static function connection() {
    if (!self::$connection) {
      try {
        self::$connection = new PDO("mysql:host=localhost;dbname=" . self::DATABASE_NAME, self::DATABASE_USERNAME, self::DATABASE_PASSWORD);
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
