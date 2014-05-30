<?php

class ProductionStatus extends Model {
  const TABLE_NAME = 'Production_statuses';

  public $id, $name, $color;

  public function __toString() {
    return $this->name;
  }
}
