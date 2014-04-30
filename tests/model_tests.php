<?php

require_once("models/prop.php");

class ModelTests extends PHPUnit_Framework_TestCase {
  public function test_finds_a_record(){
    $prop = Prop::find(1);

    $this->assertEquals($prop->id, 1);
    $this->assertEquals($prop->description, "en dejlig stol");
  }

  public function test_find_when_id_does_not_exist() {
    $id = 999999999;
    $this->setExpectedException("RecordNotFound", "Record with id = $id does not exist");

    Prop::find($id);
  }

  public function test_find_all() {
    $props = Prop::all();

    $this->assertEquals(sizeof($props), 2);
    $this->assertEquals($props[0]->description, "en dejlig stol");
    $this->assertEquals($props[1]->description, "en mindre dejlig stol");
  }
}

?>
