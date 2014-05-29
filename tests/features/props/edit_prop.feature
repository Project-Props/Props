Feature: Edit a prop
  In order to update props
  As a user
  I need to be able to edit props

  Scenario: Updating a prop
    Given I am on the homepage
    And I create a prop with description "Awesome stol"
    And I follow "Awesome stol"
    And I follow "Rediger"
    And I fill in "prop[description]" with "Updated"
    And I press "Rediger"
    Then I should see "Updated"
    And I should see "Prop redigeret"
