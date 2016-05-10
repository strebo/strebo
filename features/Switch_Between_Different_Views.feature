Feature: Switch between different Views
  As a User
  I want to switch views

  @javascript
  Scenario: Click on the Button for view switch
    Given I am on "http://strebo.net"
    Given I see "deck-view"
    When I press "view-switch"
    Then I should see "feed-view"

  @javascript
  Scenario: Click on the Button for view switch
    Given I am on "http://strebo.net"
    Given I see "feed-view"
    When I press "view-switch"
    Then I should see "deck-view"