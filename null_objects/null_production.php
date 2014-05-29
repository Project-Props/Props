<?php

class NullProduction {
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
        ,$date_added
        ,$date_updated;


  public function __construct() {
    $this->title = "Ingen forestilling";
    $this->status_id = "Ingen";
    $this->premiere_date = "Ingen";
    $this->venue = "Ingen";
    $this->instructor = "Ingen";
    $this->scenographer = "Ingen";
    $this->choreographer = "Ingen";
    $this->stage_manager = "Ingen";
    $this->storage = "Ingen";
    $this->comment = "Ingen";
    $this->date_added = "Ingen";
    $this->date_updated = "Ingen";
  }
}
