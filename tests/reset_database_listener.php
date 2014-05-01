<?php

class ResetDatabaseListener implements PHPUnit_Framework_TestListener {
  const DATABASE_NAME = "Props_2";
  const DATABASE_USERNAME = "root";
  const DATABASE_PASSWORD = "root";

  public function startTest(PHPUnit_Framework_Test $test) {
    $this->recreate_database();
    $this->add_test_data();
  }

  public function endTestSuite(PHPUnit_Framework_TestSuite $suite) {
    $this->recreate_database();
    $this->add_test_data();
  }

  public function endTest(PHPUnit_Framework_Test $test, $time) {}
  public function addError(PHPUnit_Framework_Test $test, Exception $e, $time) {}
  public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time) {}
  public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time) {}
  public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time) {}
  public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time) {}
  public function startTestSuite(PHPUnit_Framework_TestSuite $suite) {}

  private function recreate_database() {
    $db = new PDO("mysql:host=localhost;",
                  static::DATABASE_USERNAME,
                  static::DATABASE_PASSWORD);
    $drop_database_sql = "DROP DATABASE IF EXISTS " . static::DATABASE_NAME;
    $db->query($drop_database_sql);

    $create_sql = file_get_contents("db/probs_database.sql");
    $db->query($create_sql);
  }

  private function add_test_data() {
    $db = new PDO("mysql:host=localhost;dbname=" . static::DATABASE_NAME,
                  static::DATABASE_USERNAME,
                  static::DATABASE_PASSWORD);
    $add_test_data_sql = file_get_contents("db/test_data.sql");
    $db->query($add_test_data_sql);
  }
}
