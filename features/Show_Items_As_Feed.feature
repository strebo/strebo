Feature: Show Items as Feed
  As the System
  I want to show Posts by Social Networks

  Scenario: Successful: show Posts as Feed
    Given |I am on |the homepage strebo.net
    When |I press "Feed View"
    Then | I get posts of the single social networks
    And | I successfully fetch the dare from server
    And | I sort the Posts by Networks
    And | I embed the feed in the Trend Board
    And |I should see "the Posts by Decks"

 Scenario: Unsuccessful: show Posts as Feed
    Given |I am on |the homepage strebo.net
    When |I press "Feed View"
    Then | I get posts of the single social networks
    And | There is an Error while fetching Data
    And | I show an Error Message