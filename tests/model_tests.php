<?php

require_once("models/prop.php");

class ModelTests extends PHPUnit_Framework_TestCase {
  public function test_finds_a_record(){
    $prop = Prop::find(1);

    $this->assertEquals($prop->id, 1);
    $this->assertEquals($prop->description, "en dejlig stol");
  }
}

?>
