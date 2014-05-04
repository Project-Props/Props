<?php

require_once("lib/database.php");

class DatabaseTests extends PHPUnit_Framework_TestCase {
  public function tests_it_throws_when_the_query_is_not_valid() {
    $this->setExpectedException("InvalidQuery", "The query \"foo bar\" is invalid");

    $db = new Database(new LocalDatabaseConnection());

    $db->query("foo bar");
  }
}
