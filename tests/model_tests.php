<?php

require_once("models/prop.php");

class ModelTests extends PHPUnit_Framework_TestCase {
  public function test_finds_a_record(){
    $prop = Prop::find(1);

    $this->assertEquals($prop->id, 1);
    $this->assertEquals($prop->description, "en dejlig stol");
  }

  public function test_finds_record_where_id_is_string() {
    $production = Production::find("0000-2014");

    $this->assertEquals($production->title, "en dejlig forestilling");
  }

  public function test_find_when_id_does_not_exist() {
    $id = 999999999;
    $this->setExpectedException("RecordNotFound", "Record with id = $id does not exist");

    Prop::find($id);
  }

  public function test_it_doesnt_treat_id_0_as_null() {
    $id = 0;
    $this->setExpectedException("RecordNotFound", "Record with id = $id does not exist");

    Prop::find($id);
  }

  public function test_find_without_id() {
    $this->setExpectedException("RecordNotFound", "Cannot find record without id");

    Prop::find(null);
  }

  public function test_update_a_record() {
    $prop = Prop::find(1);
    $prop->description = "bar";
    $date = $prop->date_updated;
    $prop->save();

    $this->assertEquals("bar", Prop::find(1)->description);
    $this->assertNotEquals($date, $prop->date_updated);
  }

  public function test_save_new_record() {
    $number_of_props_before = sizeof(Prop::all());

    $prop = new Prop();
    $prop->prop_nr = 28;
    $prop->description = "!!!!!!A NEW PROP!!!!!!!";
    $prop->section_id = 1;
    // $prop->date_added = '2014-04-30 12:12:12';
    // $prop->date_updated = '2014-04-30 12:12:12';
    $prop->status_id = 1;
    $prop->save();

    $this->assertNotNull($prop->id);
    $this->assertEquals(sizeof(Prop::all()), $number_of_props_before + 1);
    $this->assertEquals(1, Prop::find($prop->id)->status_id);
  }

  public function test_save_new_production() {
    $prod = new Production();
    $prod->id = '0002-2014';
    $prod->title = "det spiller";
    $prod->status_id = 1;
    // $prod->date_added = '2014-04-30 12:12:12';
    $prod->save();

    $this->assertEquals("0002-2014", $prod->id);
    $this->assertEquals("det spiller", Production::find('0002-2014')->title);

  }

  public function test_production_cannot_generate_their_ids() {
    $this->setExpectedException("ProductionCannotGenerateIds");

    $prod_2 = new Production();
    $prod_2->title = "det spiller";
    $prod_2->status_id = 1;
    // $prod_2->date_added = '2014-04-30 12:12:12';
    $prod_2->save();
  }

  public function test_find_all() {
    $props = Prop::all();

    $this->assertEquals(sizeof($props), 2);
    $this->assertEquals($props[0]->description, "en dejlig stol");
    $this->assertEquals($props[1]->description, "en mindre dejlig stol");
  }

  public function test_finds_has_one_relationships() {
    $prop = Prop::find(1);
    $supplier = $prop->supplier();
    $bought_for_production = $prop->bought_for();

    $this->assertEquals("Netto", $supplier->name);
    $this->assertEquals("en dejlig forestilling", $bought_for_production->title);
  }

  public function test_finds_has_many_relationships() {
    $prod = Production::find("0000-2014");
    $props = $prod->props();

    $this->assertEquals(sizeof($props), 2);
    $this->assertEquals($props[0]->comment, "hej hej");
    $this->assertEquals($props[1]->comment, "hej hej hej");

    $prop = Prop::find(1);
    $prods = $prop->used_in();

    $this->assertEquals(sizeof($prods), 2);
    $this->assertEquals($prods[0]->title, "en dejlig forestilling");
    $this->assertEquals($prods[1]->title, "en mindre dejlig forestilling");
  }
}

?>
