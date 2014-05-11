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
