<?php

require_once("lib/model.php");

class Prop extends Model {
  const TABLE_NAME = 'Props';

  public $id,
         $prop_nr,
         $section_id,
         $description,
         $comment,
         $date_added,
         $date_updated,
         $supplier_id,
         $price,
         $bought_for_id,
         $status_id,
         $size,
         $period_id,
         $deleted,
         $creditor_id,
         $maintenance_time;
}

class ModelTests extends PHPUnit_Framework_TestCase {
  public function test_finds_a_record(){
    $prop = Prop::find(1);
    $this->assertEquals($prop->id, 1);
  }

  
}

?>
