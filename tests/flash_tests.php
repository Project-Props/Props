<?php

class FlashTests extends PHPUnit_Framework_TestCase {
  public function test_resets_it_self_after_being_echoed() {
    Flash::set_notice("message");

    $this->assertEquals("message", Flash::notice());
    $this->assertNull(Flash::notice());
  }

  public function test_notice() {
    Flash::set_alert("message");

    $this->assertEquals("message", Flash::alert());
    $this->assertNull(Flash::alert());
    $this->assertNull(Flash::notice());
  }

  public function test_alert() {
    Flash::set_notice("message");

    $this->assertEquals("message", Flash::notice());
    $this->assertNull(Flash::alert());
    $this->assertNull(Flash::notice());
  }

  public function test_has_notice() {
    Flash::set_notice("message");

    $this->assertTrue(Flash::has_notice());
  }

  public function test_has_no_notice() {
    $this->assertFalse(Flash::has_notice());
  }

  public function test_has_alert() {
    Flash::set_alert("message");

    $this->assertTrue(Flash::has_alert());
  }

  public function test_has_no_alert() {
    $this->assertFalse(Flash::has_alert());
  }

  public function setup() {
    Flash::set_store(new InMemoryStore());
  }
}
