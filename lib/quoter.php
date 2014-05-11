<?php

/**
 * A class for adding additional quotes around values but only if they strings.
 *
 * This class is useful for building SQL queries.
 */
class Quoter {
  /**
   * Convert a value to a string and add an additional pair of quotes around it, but only
   * if it was a string to being with.
   *
   * It defaults to adding single quotes but can be configured to add double quotes.
   *
   * @param mixed $val the value to maybe quote.
   * @param array $options options. If it has a key pointing to the string "single" or "double" then
   * that style of quotes will be used.
   * @return string the value turned to a string and possibly quoted.
   */
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
