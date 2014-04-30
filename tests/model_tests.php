<?php

require_once("models/prop.php");

class ModelTests extends PHPUnit_Framework_TestCase {
  public function test_finds_a_record(){
    $prop = Prop::find(1);

    $this->assertEquals($prop->id, 1);
    $this->assertEquals($prop->description, "en dejlig stol");
  }

  public function test_update_a_record() {
    $prop = Prop::find(1);
    $prop->description = "bar";
    $prop->save();

    $this->assertEquals("bar", Prop::find(1)->description);
  }

  public function test_finds_record_where_id_is_string() {
    $production = Production::find("0000-2014");

    $this->assertEquals($production->title, "en dejlig forestilling");
  }

  public function test_save_new_record() {
    $prop = new Prop();
    $prop->prop_nr = 28;
    $prop->section_id = 1;
    $prop->date_added = '2014-04-30 12:12:12';
    $prop->date_updated = '2014-04-30 12:12:12';
    $prop->status_id = 1;
    $prop->save();

    $this->assertNotNull($prop->id);
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

  public function test_finds_relation_ships() {
    $prop = Prop::find(1);
    $supplier = $prop->supplier();
    $bought_for_production = $prop->bought_for();

    $this->assertEquals("Netto", $supplier->name);
    $this->assertEquals("en dejlig forestilling", $bought_for_production->title);
  }
}

?>
