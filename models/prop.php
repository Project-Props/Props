<?php

require_once("lib/model.php");

class Prop extends Model {
  const TABLE_NAME = 'Props';

  public $id
        ,$prop_nr
        ,$old_prop_nr
        ,$section_id
        ,$description
        ,$comment
        ,$date_added
        ,$date_updated
        ,$supplier_id
        ,$price
        ,$bought_for_id
        ,$status_id
        ,$size
        ,$category
        ,$subcategory
        ,$period_id
        ,$deleted
        ,$creditor
        ,$maintenance_time;

  protected static $has_one = [
    "supplier" => "Supplier"
   ,"bought_for" => "Production"
   ,"section" => "Section"
  ];

  protected static $has_many = [
    "used_in" => [
      "class" => "Production",
      "table" => "Used_in"
    ]
  ];

  public function delete() {
    $this->deleted = true;
    $this->save();
  }

  protected static function default_scope() {
    return "deleted = 0";
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

class Section extends Model {
  const TABLE_NAME = 'Sections';

  public $id, $name;
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

  protected static $has_many = [
    "props" => [
      "class" => "Prop",
      "table" => "Used_in"
    ]
  ];

  protected function new_record_id() {
    return "'" . $this->id . "'";
  }

  protected function next_insert_id() {
    if (is_null($this->id)) throw new ProductionCannotGenerateIds();
    return $this->id;
  }
}

?>
