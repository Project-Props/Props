<?php

class Quoter {
  public static function quote_if_string($val, $options = ["style" => "single"]) {
    if (is_string($val)) {
      if ($options["style"] == "single") {
        return "'$val'";
      } else {
        return '"' . $val . '"';
      }
    } else {
      return "$val";
    }
  }
}
