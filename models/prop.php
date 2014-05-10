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

  public function delete() {
    $this->deleted = true;
    $this->save();
  }

  protected function has_one() {
    return [
      "supplier" => "Supplier"
     ,"bought_for" => "Production"
     ,"section" => "Section"
     ,"status" => "PropStatus"
    ];
  }

  protected function has_many() {
    return [
      "used_in" => [
        "class" => "Production",
        "table" => "Used_in"
      ]
    ];
  }

  protected static function default_scope() {
    return "deleted = 0";
  }
}

?>
