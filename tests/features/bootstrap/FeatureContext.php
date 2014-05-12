<?php

require_once("lib/database.php");

error_reporting(E_ALL);
ini_set('display_errors', '1');

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext {
  /**
   * Initializes context.
   * Every scenario gets it's own context object.
   *
   * @param array $parameters context parameters (set them up through behat.yml)
   */
  public function __construct(array $parameters) {
    // Initialize your context here
  }

  /**
   * @Given /^I create a prop with description "([^"]*)"$/
   */
  public function iCreateAPropWithDescription($description) {
    $this->clickLink("Tilføj prop");

    $this->fillField("prop[category]", "stol");
    $this->fillField("prop[comment]", "kommentar");
    $this->fillField("prop[creditor]", "mads");
    $this->fillField("prop[description]", $description);
    $this->fillField("prop[maintenance_time]", "10 min");
    $this->fillField("prop[old_prop_nr]", "42");
    $this->fillField("prop[price]", "100 kr");
    $this->fillField("prop[prop_nr]", "42");
    $this->fillField("prop[size]", "100 m");
    $this->fillField("prop[subcategory]", "stor stol");

    $this->selectOption("prop[bought_for_id]", "0000-2014");
    $this->selectOption("prop[period_id]", "1");
    $this->selectOption("prop[section_id]", "1");
    $this->selectOption("prop[status_id]", "1");
    $this->selectOption("prop[supplier_id]", "1");

    $this->pressButton("Tilføj");
  }

  /**
   * @Given /^I create (\d+) props with description "([^"]*)"$/
   */
  public function iCreatePropsWithDescription($count, $description) {
    for ($i = 0; $i < $count; $i++) {
      $this->iCreateAPropWithDescription($description);
    }
  }

  /**
   * @AfterSuite
   */
  public static function teardown($event) {
    static::reset_db();
  }

  /** @BeforeFeature */
  public static function setupFeature($event) {
    static::reset_db();
  }

  private static function reset_db() {
    $db = new Database(new LocalDatabaseConnection());
    $db->drop_database();
    $db->create_schema();
    $db->add_test_data();
  }
}
