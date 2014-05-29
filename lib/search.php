<?php

class Searcher {

  /**
   * extra mellemrum bliver tilføjet til strengen
   */
  private static function the_plus_adder($string) {
    $string_with_plusses = "";
    $exploded_string = explode(" ", $string);

    foreach ($exploded_string as $word) {
      $string_with_plusses .= '+' . $word . " ";
    }

  return $string_with_plusses;
  }

  public static function search($string) {
    $plus_string = static::the_plus_adder($string);

    $prop_attributes = "p.bought_for_id, p.category, p.comment, p.creditor, p.date_added, p.date_updated, p.deleted, " . 
                       "p.description, p.id, p.maintenance_time, p.old_prop_nr, p.period_id, p.price, p.prop_nr, p.section_id, " .
                       "p.size, p.status_id, p.subcategory, p.supplier_id";

    $production_attributes = "p.choreographer, p.comment, p.date_added, p.id, p.instructor, p.premiere_date, p.scenographer, " .
                             "p.stage_manager, p.status_id, p.storage, p.title, p.venue";

    $props_sql = "SELECT $prop_attributes
                  FROM Props p 
                    LEFT OUTER JOIN Periods
                      ON p.period_id = Periods.id
                    LEFT OUTER JOIN Prop_statuses status
                      ON p.status_id = status.id
                    LEFT OUTER JOIN Sections
                      ON p.section_id = Sections.id
                    LEFT OUTER JOIN  Suppliers
                      ON p.supplier_id = Suppliers.id
                  WHERE MATCH (p.description, p.comment, p.size, p.category, p.subcategory, p.creditor)
                        AGAINST ('$plus_string' IN BOOLEAN MODE) OR
                        MATCH (Periods.name) AGAINST ('$plus_string' IN BOOLEAN MODE) OR
                        MATCH (status.name) AGAINST ('$plus_string' IN BOOLEAN MODE) OR
                        MATCH (Sections.name) AGAINST ('$plus_string' IN BOOLEAN MODE) OR
                        MATCH (Suppliers.name) AGAINST ('$plus_string' IN BOOLEAN MODE)";
                
    $productions_sql = "SELECT $production_attributes
                        FROM Productions p 
                          LEFT OUTER JOIN Production_statuses
                            ON p.status_id = Production_statuses.id
                        WHERE MATCH (p.title, p.venue, p.instructor, p.scenographer, p.choreographer,
                                     p.stage_manager, p.storage, p.comment)
                              AGAINST ('$plus_string' IN BOOLEAN MODE) OR 
                              MATCH (Production_statuses.name) AGAINST ('$plus_string' IN BOOLEAN MODE)";

    $props_array = [];
    $productions_array = [];

  $db = new Database(new LocalDatabaseConnection());

    foreach ($db->query($props_sql) as $row) {
      $prop = new Prop($row);
      array_push($props_array, $prop);
    }

    foreach ($db->query($productions_sql) as $row) {
      $production = new Production($row);
      array_push($productions_array, $production);
    }

    $search_result = new SearchResult($props_array, $productions_array);
    return $search_result;
  }


}
?>