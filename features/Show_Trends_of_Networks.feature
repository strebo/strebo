Feature: Show Trends of supported Networks
  As a User
  I want to view trending posts at the Trend Board

  @javascript
  Scenario: Server is avaiable
    Given I am on the homepage "http://strebo.net"
    When I press "trend-board-button"
    Then I should see "loading-view"

  @javascript
  Scenario: Server is not available
    Given I am on the homepage "http://strebo.net"
    When I press "trend-board-button"
    Then I should see "error-message"