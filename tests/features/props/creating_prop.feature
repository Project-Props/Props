Feature: Creating a prop
  In order keep track of props
  As a user
  I need to create props

  Scenario: Creating a prop
    Given I am on the homepage
    And I create a prop with description "Awesome stol"
    Then I should see "Awesome stol"
    And I should see "Prop tilføjet!"

  Scenario: Creating an invalid prop
    Given I am on the homepage
    And I follow "Tilføj prop"
    And I press "Tilføj"
    Then I should see "Prop ikke tilføjet!"
