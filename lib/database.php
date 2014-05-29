<?php

require_once "database_config.php";

/**
 * Interface describing class that can connect to a database.
 */
interface DatabaseConnection {
  public function server_connection();
  public function database_connection();
  public function database_name();
  public function database_username();
  public function database_password();
}

/**
 * Connection to a local database.
 */
class LocalDatabaseConnection implements DatabaseConnection {
  /**
   * Get the connection to the local database server.
   *
   * @return PDO PDO connection object.
   */
  public function server_connection() {
    return new PDO("mysql:host=localhost;",
                   $this->database_username(),
                   $this->database_password());
  }

  /**
   * Get the connection to the local database itself.
   *
   * @return PDO PDO connection object.
   */
  public function database_connection() {
    return new PDO("mysql:host=localhost;dbname=" . $this->database_name(),
                   $this->database_username(),
                   $this->database_password());
  }

  /**
   * Method that simply returns the name of the database.
   *
   * A method is used instead of a constant because constants can't be specified in interfaces.
   *
   * @return string the name of the database.
   */
  public function database_name() {
    return $GLOBALS["database_config"]["name"];
  }

  /**
   * Method that simply returns the username of the database.
   *
   * A method is used instead of a constant because constants can't be specified in interfaces.
   *
   * @return string the username of the database.
   */
  public function database_username() {
    return $GLOBALS["database_config"]["username"];
  }

  /**
   * Method that simply returns the password of the database.
   *
   * A method is used instead of a constant because constants can't be specified in interfaces.
   *
   * @return string the password of the database.
   */
  public function database_password() {
    return $GLOBALS["database_config"]["password"];
  }
}

/**
 * Exception that will be thrown when trying to run an invalid query on the database.
 */
class InvalidQuery extends Exception {}

/**
 * A class representing the database.
 */
class Database {
  private $connection;

  /**
   * Constructs a new database given a connection.
   *
   * @param DatabaseConnection $connection the connection to use.
   */
  public function __construct($connection) {
    $this->connection = $connection;
  }

  /**
   * Send query to database.
   *
   * Will throw InvalidQuery if the query is invalid.
   *
   * @param string $sql to run on the database.
   * @return array results of running query.
   */
  public function query($sql) {
    $query_response = $this->connection
      ->database_connection()
      ->query($sql);

    if (!$query_response) throw new InvalidQuery("The query \"$sql\" is invalid");

    return $query_response->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Drop the  database.
   */
  public function drop_database() {
    $drop_database_sql = "DROP DATABASE IF EXISTS " . $this->connection->database_name();
    $this->connection
      ->database_connection()
      ->query($drop_database_sql);
  }

  /**
   * Recreate the schema of the database.
   */
  public function create_schema() {
    $create_sql = file_get_contents("db/probs_database.sql");
    $this->connection
      ->server_connection()
      ->query($create_sql);
  }

  /**
   * Add test data to database.
   */
  public function add_test_data() {
    $add_test_data_sql = file_get_contents("db/test_data.sql");
    $this->connection
      ->database_connection()
      ->query($add_test_data_sql);
  }
}
