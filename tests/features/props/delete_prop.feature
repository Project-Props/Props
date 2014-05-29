Feature: Deleting a prop
  In order to remove old props
  As a user
  I need to be able to delete props

  Scenario: Creating a prop
    Given I am on the homepage
    And I create a prop with description "Awesome stol"
    And I follow "Awesome stol"
    And I follow "Slet"
    Then I should not see "Awesome stol"
    And I should see "Prop slettet"
