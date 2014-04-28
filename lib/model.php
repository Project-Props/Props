<?php

abstract class Model {
  private static function connection() {
    try {
      $con = new PDO("mysql:host=localhost;dbname=Props_2", 'root', 'root');
    } catch (PDOException $e) {
      echo 'Error: ' . $e;
    }
    return $con;
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