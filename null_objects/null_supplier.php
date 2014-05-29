<?php

class NullSupplier {
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

  public function __construct() {
    $this->name = "Ingen leverandør";
    $this->email = "Ingen";
    $this->web_page = "Ingen";
    $this->phone = "Ingen";
    $this->street = "Ingen";
    $this->city = "Ingen";
    $this->zip_code = "Ingen";
    $this->country = "Ingen";
    $this->comment = "Ingen";
  }
}
