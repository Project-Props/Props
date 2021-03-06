<?php

class Searcher {
  /**
   * A pointer to the database. This is used for caching internally.
   */
  protected static $db;

  /**
   * Search for props and productions
   *
   * @param string $text_query The query to search for.
   * @return SearchResult The results.
   */
  public static function search($text_query, $filters = []) {
    $props = NULL;
    $productions = NULL;

    if ($text_query == "") {
      $props = Prop::all_limit(1000);
      $productions = ($filters == []) ? Production::all_limit(1000) : [];
    } else {
      $query_with_plusses_and_stars = static::prepare_query($text_query);

      $props = static::matching_props($query_with_plusses_and_stars);
      $productions = ($filters == []) ? static::matching_productions($query_with_plusses_and_stars) : [];
    }

    $filtered_props = static::filter_props($props, $filters);

    return new SearchResult($filtered_props, $productions);
  }

  private static function filter_props($props, $filters) {
    if ($filters == []) {
      return $props;
    } else {
      $size = sizeof($props);

      if (array_key_exists("bought_for_id", $filters)) {
        for ($i = 0; $i < $size; $i++) {
          if ($props[$i]->bought_for_id != $filters["bought_for_id"]) {
            unset($props[$i]);
          }
        }

        unset($filters["bought_for_id"]);
        return static::filter_props(array_values($props), $filters);
      }

      if (array_key_exists("section_id", $filters)) {
        for ($i = 0; $i < $size; $i++) {
          if ($props[$i]->section_id != $filters["section_id"]) {
            unset($props[$i]);
          }
        }

        unset($filters["section_id"]);
        return static::filter_props(array_values($props), $filters);
      }

      if (array_key_exists("used_in", $filters)) {
        for ($i = 0; $i < $size; $i++) {
          $productions_used_in = $props[$i]->used_in();
          $match = false;

          foreach ($productions_used_in as $production) {
            if ($production->id == $filters["used_in"]) {
              $match = true;
            }
          }

          if (!$match) {
            unset($props[$i]);
          }
        }

        unset($filters["used_in"]);
        return static::filter_props(array_values($props), $filters);
      }
    }
  }

  /**
   * Add plusses before words in a string
   * Add stars after words in a string
   *
   * Formerly known as "the_plus_adder"
   *
   * @param string $string The string to add plusses to.
   * @return string The string with plusses.
   */
  private static function prepare_query($string) {
    $string_with_plusses_and_stars = "";
    $exploded_string = explode(" ", $string);

    foreach ($exploded_string as $word) {
      $string_with_plusses_and_stars .= '+' . $word . "*" . " ";
    }

    return $string_with_plusses_and_stars;
  }

  private static function prop_attributes() {
    return "p.bought_for_id, p.category, p.comment, p.creditor, p.date_added, p.date_updated, p.deleted, " .
           "p.description, p.id, p.maintenance_time, p.old_prop_nr, p.period_id, p.price, p.prop_nr, p.section_id, " .
           "p.size, p.status_id, p.subcategory, p.supplier_id";
  }

  private static function production_attributes() {
    return "p.choreographer, p.comment, p.date_added, p.id, p.instructor, p.premiere_date, p.scenographer, " .
           "p.stage_manager, p.status_id, p.storage, p.title, p.venue";

  }

  private static function props_sql($query_with_plusses_and_stars) {
    $props_sql = "SELECT " . static::prop_attributes() . " " .
                 "FROM Props p
                    LEFT OUTER JOIN Periods
                      ON p.period_id = Periods.id
                    LEFT OUTER JOIN Prop_statuses status
                      ON p.status_id = status.id
                    LEFT OUTER JOIN Sections
                      ON p.section_id = Sections.id
                    LEFT OUTER JOIN  Suppliers
                      ON p.supplier_id = Suppliers.id
                  WHERE MATCH (p.description, p.comment, p.size, p.category, p.subcategory, p.creditor,
                        Periods.name, status.name, Sections.name, Suppliers.name)
                        AGAINST ('$query_with_plusses_and_stars' IN BOOLEAN MODE)";
    return $props_sql;
  }

  private static function productions_sql($query_with_plusses_and_stars) {
    $productions_sql = "SELECT " . static::production_attributes() . " " .
                       "FROM Productions p
                          LEFT OUTER JOIN Production_statuses
                            ON p.status_id = Production_statuses.id
                        WHERE MATCH (p.title, p.venue, p.instructor, p.scenographer, p.choreographer,
                                     p.stage_manager, p.storage, p.comment)
                              AGAINST ('$query_with_plusses_and_stars' IN BOOLEAN MODE) OR
                              MATCH (Production_statuses.name) AGAINST ('$query_with_plusses_and_stars' IN BOOLEAN MODE)";
    return $productions_sql;
  }

  private static function matching_productions($query_with_plusses_and_stars) {
    $productions = [];

    foreach (static::db()->query(static::productions_sql($query_with_plusses_and_stars)) as $row) {
      $production = new Production($row);
      array_push($productions, $production);
    }

    return $productions;
  }

  private static function matching_props($query_with_plusses_and_stars) {
    $props = [];

    foreach (static::db()->query(static::props_sql($query_with_plusses_and_stars)) as $row) {
      $prop = new Prop($row);
      array_push($props, $prop);
    }

    return $props;
  }

  private static function db() {
    if (!static::$db) {
      static::$db = new Database(new LocalDatabaseConnection());
    }

    return static::$db;
  }
}
