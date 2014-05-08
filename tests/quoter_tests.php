<?php

require_once("lib/quoter.php");

class QuoterTests extends PHPUnit_Framework_TestCase {
  public function test_add_quotes_on_strings() {
    $val = "foo";

    $this->assertEquals("'foo'", Quoter::quote_if_string($val));
  }

  public function test_doe_not_add_quotes_on_ints() {
    $val = 1;

    $this->assertEquals("1", Quoter::quote_if_string($val));
  }

  public function test_can_also_add_double_quotes() {
    $val = "foo";

    $this->assertEquals('"foo"', Quoter::quote_if_string($val, ["style" => "double"]));
  }
}
