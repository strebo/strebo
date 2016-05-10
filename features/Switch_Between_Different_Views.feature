Feature: Switch between different Views
  As a User
  I want to switch views

  @javascript
  Scenario: Click on the Button for view switch
    Given I am on "http://strebo.net"
    When I press "view-switch"
    Then I should see "Feed View"

  @javascript
  Scenario: Click on the Button for view switch
    Given I am on "http://strebo.net"
    And I press "view-switch"
    When I press "view-switch"
    Then I should see "Deck View"