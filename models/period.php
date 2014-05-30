<?php

class Period extends Model {
  const TABLE_NAME = 'Periods';

  public $id, $name;

  public function __toString() {
    return $this->name;
  }
}
