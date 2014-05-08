<?php

require_once("lib/quoter.php");
require_once("lib/database.php");

class RecordNotFound extends Exception {}

abstract class Model {
  protected static $db;

  public static function find($id) {
    if (is_null($id)) throw new RecordNotFound("Cannot find record without id");

    $records = static::db()->query(static::find_sql_for_id($id));

    if ($records == []) {
      throw new RecordNotFound("Record with id = $id does not exist");
    } else {
      return static::new_with_assoc_array_as_attributes($records[0]);
    }
  }

  // TODO: test for default scope and that it can be disabled
  public static function all($options = ["ignore_scope" => false]) {
    $sql = "SELECT * FROM " . static::TABLE_NAME;

    if (!is_null(static::default_scope()) && !$options["ignore_scope"]) {
      $sql .= " WHERE " . static::default_scope();
    }

    $records = static::db()->query($sql);

    $instances = [];

    foreach ($records as $record) {
      $instance = static::new_with_assoc_array_as_attributes($record);
      array_push($instances, $instance);
    }

    return $instances;
  }

  protected static function default_scope() {
    return NULL;
  }

  public function __call($method, $args) {
    $name_of_association = $method;

    if ($this->has_has_one_association($name_of_association)) {
      return $this->associated_object($name_of_association);
    } else if ($this->has_has_many_association($name_of_association)) {
      return $this->all_associated_objects($name_of_association);
    }

    $this->throw_undefined_method($method);
  }

  private function new_record() {
    try {
      static::find($this->id);

      return false;
    } catch (RecordNotFound $e) {
      return true;
    }
  }

  private function instance_vars() {
    $vars = (array) $this;
    $acc = [];

    foreach ($vars as $key => $value) {
      if (!is_numeric($key)) {
        $acc[$key] = $value;
      }
    }

    return $acc;
  }

  private function update_sql() {
    $date = $this->datetime();
    $vars = $this->instance_vars();

    if (array_key_exists('date_updated', $vars)) {
      $sql = 'UPDATE ' . static::TABLE_NAME . " SET date_updated = '" . $date . "', ";
      $this->date_updated = $date;
    } else {
      $sql = 'UPDATE ' . static::TABLE_NAME . ' SET ';
    }

    foreach ($vars as $key => $value) {
      if ($key != "date_updated") {
        $sql .= $key . ' = ' . Quoter::quote_if_string($value) . ', ';
      }
    }

    $sql .= 'WHERE id = ' . $this->id;
    $sql = str_replace(', WHERE', ' WHERE', $sql);

    return $sql;
  }

  private function insert_sql() {
    $date = $this->datetime();
    $vars = $this->instance_vars();

    if (array_key_exists('date_added', $vars) && array_key_exists('date_updated', $vars)) {
      $sql = 'INSERT INTO ' . static::TABLE_NAME . '(date_added, date_updated, id';
      $this->date_added = $date;
      $this->date_updated = $date;
    } else {
      $sql = 'INSERT INTO ' . static::TABLE_NAME . '(id';
    }

    foreach ($vars as $key => $value) {
      if ($key != "id" && $value) {
        $sql .= ', ' . $key;
      }
    }

    if (array_key_exists('date_added', $vars) && array_key_exists('date_updated', $vars)) {
      $sql .= ") VALUES ('" . $date . "', '" . $date . "', " . $this->new_record_id();
    } else {
      $sql .= ') VALUES (' . $this->new_record_id();
    }

    foreach ($vars as $key => $value) {
      if ($key != "id" && $value) {
        $sql .= ', ' . Quoter::quote_if_string($value);
      }
    }

    $sql .= ')';
    $this->id = $this->next_insert_id();

    return $sql;
  }

  public function save() {
    $sql = NULL;

    if ($this->new_record()) {
      $sql .= $this->insert_sql();
    } else {
      $sql .= $this->update_sql();
    }

    static::db()->query($sql);
  }
  private function datetime() {
    $dateTime = new DateTime("now", new DateTimeZone('Europe/Copenhagen'));
    $mysqldate = $dateTime->format("Y-m-d H:i:s");

    return $mysqldate;
  }

  protected function has_one() {
    return [];
  }

  protected function next_insert_id() {
    $sql = "SELECT id FROM " . static::TABLE_NAME . " ORDER BY id DESC LIMIT 1";
    $last_id = static::db()->query($sql)[0]["id"];
    return $last_id + 1;
  }

  protected function new_record_id() {
    return 'NULL';
  }

  protected function has_many() {
    return [];
  }

  protected static function database_connection() {
    return new LocalDatabaseConnection();
  }

  private function associated_object($name) {
    $class = $this->has_one()[$name];
    return $class::find($this->{$name . "_id"});
  }

  private function has_has_one_association($method) {
    return array_key_exists($method, $this->has_one());
  }

  private function throw_undefined_method($method) {
    $class = get_class($this);
    $trace = debug_backtrace();
    $file = $trace[0]['file'];
    $line = $trace[0]['line'];
    trigger_error("Call to undefined method $class::$method() in $file on line $line",
      E_USER_ERROR);
  }

  private static function db() {
    if (!static::$db) {
      static::$db = new Database(static::database_connection());
    }

    return static::$db;
  }

  private function all_associated_objects($name) {
    $data = $this->has_many()[$name];
    $id_column = strtolower(get_class($this)) ."_id";
    $ids_sql = "SELECT ". strtolower($data["class"]) ."_id"
      ." FROM ". $data["table"]
      ." WHERE ". $id_column ." = ". Quoter::quote_if_string($this->id);

    $related_ids_sql = "SELECT * FROM ". $data["class"]::TABLE_NAME ." WHERE id IN (". $ids_sql .")";

    $records = static::db()->query($related_ids_sql);

    $instances = [];
    foreach ($records as $record) {
      // this process is basically a sligtly changed version of new_with_assoc_array_as_attributes
      // the difference is that we are creating objects of another class and not our own class
      $instance = new $data["class"];

      foreach ($record as $key => $value) {
        $instance->{$key} = $value;
      }

      array_push($instances, $instance);
    }

    return $instances;
  }

  private static function new_with_assoc_array_as_attributes($record) {
    $instance = new static;

    foreach ($record as $key => $value) {
      $instance->{$key} = $value;
    }

    return $instance;
  }

  private function has_has_many_association($name) {
    return array_key_exists($name, $this->has_many());
  }

  private static function find_sql_for_id($id) {
    return 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE id = ' . Quoter::quote_if_string($id);
  }
}

?>
