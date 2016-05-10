Feature: Show Trends of supported Networks
  As a User
  I want to view trending posts at the Trend Board

  @javascript
  Scenario: Server is avaiable
    Given I am on the homepage "http://strebo.net"
    When I press "Trend Board"
    Then I should see "loading..."

  @javascript
  Scenario: Server is not avaiable
    Given I am on the homepage "http://strebo.net"
    When I press "Trend Board"
    Then I should see "Server Not Found"