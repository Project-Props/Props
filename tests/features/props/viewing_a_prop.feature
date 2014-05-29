Feature: Viewing a prop
  In order keep track of props
  As a user
  I need to view the props I have made

  Scenario: Creating a prop
    Given I am on the homepage
    And I create a prop with description "Another prop"
    And I create a prop with description "Awesome stol"
    Then I should see "Awesome stol"
    And I should not see "Another prop"
