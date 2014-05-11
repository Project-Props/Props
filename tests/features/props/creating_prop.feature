Feature: Creating a prop
  In order to verirfy that Behat works
  As a developer
  I need to run a test

  Scenario: Creating a prop
    Given I am on the homepage
    And I follow "Tilføj prop"
    And I fill in "category" with "stol"
    And I fill in "comment" with "kommentar"
    And I fill in "creditor" with "mads"
    And I fill in "description" with "Awesome stol"
    And I fill in "maintenance_time" with "10 min"
    And I fill in "old_prop_nr" with "42"
    And I fill in "price" with "100 kr"
    And I fill in "prop_nr" with "42"
    And I fill in "size" with "100 m"
    And I fill in "subcategory" with "stor stol"
    And I select "0000-2014" from "bought_for_id"
    And I select "1" from "period_id"
    And I select "1" from "section_id"
    And I select "1" from "status_id"
    And I select "1" from "supplier_id"
    And I press "Tilføj"
    Then I should see "Awesome stol"
    And I should see "Prop tilføjet!"

  Scenario: Creating an invalid prop
    Given I am on the homepage
    And I follow "Tilføj prop"
    And I press "Tilføj"
    Then I should see "Prop ikke tilføjet!"
