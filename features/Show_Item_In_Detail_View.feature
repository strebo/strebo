Feature: Show Item in a Details View
  As a User
  I Want to get Detailed Information about a post

  @javascript
  Scenario: Klick on a single Post
    Given I am on the homepage "http://strebo.net"
    When I press on a "social-media-content-container-feed"
    Then I should see "deck-view"