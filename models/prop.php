<?php

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
   ,"status" => "PropStatus"
   ,"period" => "Period"
  ];

  protected static $has_many = [
    "used_in" => [
      "class" => "Production",
      "table" => "Used_in"
    ]
  ];

  protected static $default_scope = "deleted = 0";

  public function __construct($params = []) {
    parent::__construct($params);
    $this->deleted = 0;
  }

  public function delete() {
    $this->deleted = true;
    $this->save();
  }
}
