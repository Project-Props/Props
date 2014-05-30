<?php

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

  public function __toString() {
    return $this->name;
  }
}
