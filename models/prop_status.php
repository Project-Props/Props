<?php

class PropStatus extends Model {
  const TABLE_NAME = 'Prop_statuses';

  public $id, $name, $color;

  public function __toString() {
    return $this->name;
  }
}
