Feature: Show Items by Social Networks as Decks
  As the System
  I want to show Posts as Deck

  Scenario: Successful: show Posts as Decks
    Given |I am on |the homepage strebo.net
    When |I press "Deck View"
    Then | I get posts of the single social networks
    And | I successfully fetch the dare from server
    And | I create feed date with received data
    And | I shuffle the posts
    And | I embed the feed in the Trend Board
    And |I should see "the Posts as Decks"

  Scenario: Unsuccessful: show Posts as Decks
    Given |I am on |the homepage strebo.net
    When |I press "Deck View"
    Then | I get posts of the single social networks
    Then | I get posts of the single social networks
    And | There is an Error while fetching Data
    And | I show an Error Message