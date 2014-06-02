<?php

class ResetDatabaseListener implements PHPUnit_Framework_TestListener {
  public function startTest(PHPUnit_Framework_Test $test) {
    $this->reset_db();
  }

  public function endTestSuite(PHPUnit_Framework_TestSuite $suite) {
    $this->reset_db();
  }

  public function endTest(PHPUnit_Framework_Test $test, $time) {}
  public function addError(PHPUnit_Framework_Test $test, Exception $e, $time) {}
  public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time) {}
  public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time) {}
  public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time) {}
  public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time) {}
  public function startTestSuite(PHPUnit_Framework_TestSuite $suite) {}

  private function reset_db() {
    $db = new Database(new LocalDatabaseConnection());
    $db->drop_database();
    $db->create_schema();
    $db->add_test_data();
  }
}
