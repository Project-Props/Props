<?php

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

  protected function has_one() {
    return [
      "status" => "ProductionStatus"
    ];
  }

  protected function has_many() {
    return [
      "props" => [
        "class" => "Prop",
        "table" => "Used_in"
      ]
    ];
  }

  protected function new_record_id() {
    return "'" . $this->id . "'";
  }

  protected function next_insert_id() {
    if (is_null($this->id)) throw new ProductionCannotGenerateIds();
    return $this->id;
  }
}
