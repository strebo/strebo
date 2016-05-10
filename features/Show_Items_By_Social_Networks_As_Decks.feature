Feature: Show Items by Social Networks as Decks
  As the System
  I want to show Posts as Deck

  @javascript
  Scenario: Successful: show Posts as Decks
    Given I am on the homepage "http://strebo.net"
    Then I should see "Posts as Decks"

  Scenario: Unsuccessful: show Posts as Decks
    Given |I am on |the homepage strebo.net
    When |I press "Deck View"
    Then | I get posts of the single social networks
    Then | I get posts of the single social networks
    And | There is an Error while fetching Data
    And | I show an Error Message