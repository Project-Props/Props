<?php

interface DatabaseConnection {
  public function server_connection();
  public function database_connection();
  public function database_name();
  public function database_username();
  public function database_password();
}

class LocalDatabaseConnection implements DatabaseConnection {
  public function server_connection() {
    return new PDO("mysql:host=localhost;",
                   $this->database_username(),
                   $this->database_password());
  }

  public function database_connection() {
    return new PDO("mysql:host=localhost;dbname=" . $this->database_name(),
                   $this->database_username(),
                   $this->database_password());
  }

  public function database_name() {
    return "Props_2";
  }

  public function database_username() {
    return "root";
  }

  public function database_password() {
    return "root";
  }
}

class Database {
  private $connection;

  public function __construct($connection) {
    $this->connection = $connection;
  }

  public function query($sql) {
    return $this->connection
      ->database_connection()
      ->query($sql)
      ->fetchAll();
  }

  public function drop_database() {
    $drop_database_sql = "DROP DATABASE IF EXISTS " . $this->connection->database_name();
    $this->connection
      ->database_connection()
      ->query($drop_database_sql);
  }

  public function create_schema() {
    $create_sql = file_get_contents("db/probs_database.sql");
    $this->connection
      ->server_connection()
      ->query($create_sql);
  }

  public function add_test_data() {
    $add_test_data_sql = file_get_contents("db/test_data.sql");
    $this->connection
      ->database_connection()
      ->query($add_test_data_sql);
  }
}
