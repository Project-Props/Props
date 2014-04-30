<?php

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
    $sql = 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE id = ' . $id;
    $record = static::connection()->query($sql)->fetch();
    $instance = new static;

    foreach ($record as $key => $value) {
      $instance->{$key} = $value;
    }

    return $instance;
  }
}

?>
