Feature: Viewing the homepage
  In order to view the latest props and productions
  As a user
  I need to view the homepage

  Scenario: Creating a prop
    Given I am on the homepage
    And I create a prop with description "Chair"
    And I create 10 props with description "Couch"
    Then I should not see "Chair"
    And I should see "Couch"
