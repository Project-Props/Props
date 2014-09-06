<?php

class Searcher {
  /**
   * Search for props and productions
   *
   * @param string $text_query The query to search for.
   * @return SearchResult The results.
   */
  public static function search($text_query) {
    $query_with_plusses = static::add_plusses_between_words($text_query);

    $db = new Database(new LocalDatabaseConnection());

    $props = static::matching_props($db, $query_with_plusses);
    $productions = static::matching_productions($db, $query_with_plusses);

    return new SearchResult($props, $productions);
  }

  /**
   * Add plusses in between words in a string
   *
   * Formerly known as "the_plus_adder"
   *
   * @param string $string The string to add plusses to.
   * @return string The string with plusses.
   */
  private static function add_plusses_between_words($string) {
    $string_with_plusses = "";
    $exploded_string = explode(" ", $string);

    foreach ($exploded_string as $word) {
      $string_with_plusses .= '+' . $word . " ";
    }

    return $string_with_plusses;
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

  private static function props_sql($query_with_plusses) {
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
                  WHERE MATCH (p.description, p.comment, p.size, p.category, p.subcategory, p.creditor)
                        AGAINST ('$query_with_plusses' IN BOOLEAN MODE) OR
                        MATCH (Periods.name) AGAINST ('$query_with_plusses' IN BOOLEAN MODE) OR
                        MATCH (status.name) AGAINST ('$query_with_plusses' IN BOOLEAN MODE) OR
                        MATCH (Sections.name) AGAINST ('$query_with_plusses' IN BOOLEAN MODE) OR
                        MATCH (Suppliers.name) AGAINST ('$query_with_plusses' IN BOOLEAN MODE)";
    return $props_sql;
  }

  private static function productions_sql($query_with_plusses) {
    $productions_sql = "SELECT " . static::production_attributes() . " " .
                        "FROM Productions p
                          LEFT OUTER JOIN Production_statuses
                            ON p.status_id = Production_statuses.id
                        WHERE MATCH (p.title, p.venue, p.instructor, p.scenographer, p.choreographer,
                                     p.stage_manager, p.storage, p.comment)
                              AGAINST ('$query_with_plusses' IN BOOLEAN MODE) OR
                              MATCH (Production_statuses.name) AGAINST ('$query_with_plusses' IN BOOLEAN MODE)";
    return $productions_sql;
  }

  private static function matching_productions($db, $query_with_plusses) {
    $productions = [];

    foreach ($db->query(static::productions_sql($query_with_plusses)) as $row) {
      $production = new Production($row);
      array_push($productions, $production);
    }

    return $productions;
  }

  private static function matching_props($db, $query_with_plusses) {
    $props = [];

    foreach ($db->query(static::props_sql($query_with_plusses)) as $row) {
      $prop = new Prop($row);
      array_push($props, $prop);
    }

    return $props;
  }
}
