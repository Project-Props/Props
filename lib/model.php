<?php

require_once("lib/quoter.php");
require_once("lib/database.php");

function p($x) {
  echo "<pre>";
  var_dump($x);
  echo "</pre>";
}

/**
 * Exception that will be thrown when attempting to find a record that doesn't exist
 */
class RecordNotFound extends Exception {}

/**
 * Model class
 *
 * A model class is a class that represents an entity in the application domain. This could a prop, a production, a status and so on. Model objects also have methods for persisting themselves in a database.
 */
abstract class Model {
  /**
   * A pointer to the database. This is used for caching internally.
   */
  protected static $db;

  /**
   * The default scope. This is a "where" clause that will be included when using the ::all() method. This can be used to ignore records that matches a certain param.
   */
  protected static $default_scope = NULL;

  /**
   * Used to specify has one associations. See the prop class for an example.
   */
  protected static $has_one = [];

  /**
   * Used to specify has many associations. See the prop class for an example.
   */
  protected static $has_many = [];

  /**
   * Find the element with the specified id.
   *
   * Throws RecordNotFound if no matching record is found or id is null.
   *
   * @param mixed $id the id of the object to look for. This can be a numeric string on an int.
   * @return Model the model object with the matching id.
   */
  public static function find($id) {
    if (is_null($id)) throw new RecordNotFound("Cannot find record without id");

    $records = static::db()->query(static::find_sql_for_id($id));

    if ($records == []) {
      throw new RecordNotFound("Record with id = $id does not exist");
    } else {
      return static::new_with_assoc_array_as_attributes($records[0]);
    }
  }

  /**
   * Find all objects of type.
   *
   * @param array $options If this associative array contains the key "ignore_scope" and that points to false then the query will ignore the default scope. This parameter is optional and will be default not ignore the default scope.
   * @return array Array of model objects.
   */
  public static function all($options = ["ignore_scope" => false]) {
    $sql = "SELECT * FROM " . static::TABLE_NAME;

    if (static::should_be_scoped($options)) {
      $sql .= " WHERE " . static::$default_scope;
    }

    $records = static::db()->query($sql);

    $instances = [];

    foreach ($records as $record) {
      $instance = static::new_with_assoc_array_as_attributes($record);
      array_push($instances, $instance);
    }

    return $instances;
  }

  /**
   * This method does magic. It makes associations work.
   */
  public function __call($method, $args) {
    $name_of_association = $method;

    if ($this->has_has_one_association($name_of_association)) {
      return $this->associated_object($name_of_association);
    } else if ($this->has_has_many_association($name_of_association)) {
      return $this->all_associated_objects($name_of_association);
    }

    $this->throw_undefined_method($method);
  }

  /**
   * Save the model object to the database.
   *
   * Throws InvalidQuery is the save doesn't work.
   */
  public function save() {
    $sql = NULL;
    $date = $this->datetime();

    if ($this->new_record()) {
      $this->id = $this->next_insert_id();

      if ($this->has_timestamps()) {
        $this->date_added = $date;
        $this->date_updated = $date;
      }

      $columns = join(", ", array_keys($this->sql_columns_and_values()));
      $values = join(", ", array_values($this->sql_columns_and_values()));
      $sql = "INSERT INTO ". static::TABLE_NAME ." (". $columns .") VALUES (". $values .")";
    } else {
      if ($this->has_timestamps()) {
        $this->date_updated = $date;
      }

      $assigns = [];

      foreach ($this->sql_columns_and_values() as $key => $value) {
        array_push($assigns, "$key = $value");
      }

      $sql = "UPDATE ". static::TABLE_NAME ." SET ". join(", ", $assigns) ." WHERE id = " . Quoter::quote_if_string($this->id);
    }

    /* echo $sql; */
    static::db()->query($sql);
  }

  /**
   * Construct a new object and set parameters right away.
   *
   * @param array $params The parameters to be set on the object. This argument defaults to an empty array and is not required.
   */
  public function __construct($params = []) {
    $this->set_attributes($params);
  }

  /**
   * Update record, then save it.
   *
   * @param array $params The parameters to be updated on the object. This argument defaults to an empty array and is not required.
   */
  public function update($params = []) {
    $this->set_attributes($params);
    $this->save();
  }

  /**
   * Create a record, then save it.
   *
   * @param array $params The parameters to be set on the object. This argument defaults to an empty array and is not required.
   */
  public static function create($params) {
    $record = new static($params);
    $record->save();
    return $record;
  }

  /**
   * Find the id of the next object to be inserted.
   *
   * @return int the id of the next object to be inserted.
   */
  protected function next_insert_id() {
    $sql = "SELECT id FROM " . static::TABLE_NAME . " ORDER BY id DESC LIMIT 1";
    $last_id = static::db()->query($sql)[0]["id"];
    return $last_id + 1;
  }

  /**
   * Value used for new record's ids.
   *
   * @return string the id.
   */
  protected function new_record_id() {
    return 'NULL';
  }

  /**
   * Get the database connection.
   *
   * @return LocalDatabaseConnection the database connection.
   */
  protected static function database_connection() {
    return new LocalDatabaseConnection();
  }

  private function associated_object($name) {
    $class = static::$has_one[$name];
    $id = $name . "_id";

    try {
      return $class::find($this->{$id});
    } catch (RecordNotFound $e) {
      $null_class = "Null" . $class;
      return new $null_class;
    }
  }

  private function sql_columns_and_values() {
    $acc = [];

    foreach ($this->instance_vars() as $key => $value) {
      if (is_null($value)) {
        $acc[$key] = 'NULL';
      } else {
        $acc[$key] = Quoter::quote_if_string($value);
      }
    }

    return $acc;
  }

  private function has_has_one_association($method) {
    return array_key_exists($method, static::$has_one);
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
    $data = static::$has_many[$name];
    $id_column = strtolower(get_class($this)) ."_id";
    $ids_sql = "SELECT ". strtolower($data["class"]) ."_id"
      ." FROM ". $data["table"]
      ." WHERE ". $id_column ." = ". Quoter::quote_if_string($this->id);

    $related_ids_sql = "SELECT * FROM ". $data["class"]::TABLE_NAME ." WHERE id IN (". $ids_sql .")";

    $records = static::db()->query($related_ids_sql);

    $instances = [];
    foreach ($records as $record) {
      $instance = new $data["class"];
      $instance->set_attributes($record);
      array_push($instances, $instance);
    }

    return $instances;
  }

  private static function new_with_assoc_array_as_attributes($record) {
    $instance = new static;
    $instance->set_attributes($record);
    return $instance;
  }

  private function has_has_many_association($name) {
    return array_key_exists($name, static::$has_many);
  }

  private static function find_sql_for_id($id) {
    return 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE id = ' . Quoter::quote_if_string($id);
  }

  private function new_record() {
    try {
      static::find($this->id);

      return false;
    } catch (RecordNotFound $e) {
      return true;
    }
  }

  private function datetime() {
    $dateTime = new DateTime("now", new DateTimeZone('Europe/Copenhagen'));
    $mysqldate = $dateTime->format("Y-m-d H:i:s");

    return $mysqldate;
  }

  private function has_timestamps() {
    $vars = $this->instance_vars();

    return array_key_exists('date_added', $vars) &&
           array_key_exists('date_updated', $vars);
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

  private static function should_be_scoped($options) {
    return !is_null(static::$default_scope) && !$options["ignore_scope"];
  }

  private function set_attributes($attrs) {
    foreach ($attrs as $key => $value) {
      if ($value == "") {
        $this->{$key} = null;
      } else if (is_numeric($value)) {
        $this->{$key} = (int) $value;
      } else {
        $this->{$key} = $value;
      }
    }
  }
}

?>
