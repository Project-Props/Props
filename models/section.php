<?php

class Section extends Model {
  const TABLE_NAME = 'Sections';

  public $id, $name;

  public function __toString() {
    return $this->name;
  }
}
