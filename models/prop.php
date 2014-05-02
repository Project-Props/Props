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

  protected function has_one() {
    return [
      "supplier" => "Supplier"
     ,"bought_for" => "Production"
    ];
  }
}

class Supplier extends Model {
  const TABLE_NAME = 'Suppliers';

  public $id
        ,$name
        ,$email
        ,$web_page
        ,$phone
        ,$street
        ,$city
        ,$zip_code
        ,$country
        ,$comment;
}

class ProductionCannotGenerateIds extends Exception {}

class Production extends Model {
  const TABLE_NAME = 'Productions';

  public $id
        ,$title
        ,$status_id
        ,$premiere_date
        ,$venue
        ,$instructor
        ,$scenographer
        ,$choreographer
        ,$stage_manager
        ,$storage
        ,$comment
        ,$date_added;

  protected function new_record_id() {
    return "'" . $this->id . "'";
  }

  protected function next_insert_id() {
    if (is_null($this->id)) throw new ProductionCannotGenerateIds();
    return $this->id;
  }
}

?>
