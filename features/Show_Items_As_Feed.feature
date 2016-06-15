Feature: Show Items as Feed
  As the System
  I want to show Posts by Social Networks

  @javascript
  Scenario: Successful: show Posts as Feed
    Given I am on the homepage "http://strebo.net"
    When I press "view-switch"
    Then I should see "feed-view"

 Scenario: Unsuccessful: show Posts as Feed
    Given |I am on |the homepage strebo.net
    When |I press "Feed View"
    Then | I get posts of the single social networks
    And | There is an Error while fetching Data
    And | I should see an Error Message