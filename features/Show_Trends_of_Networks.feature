Feature: Show Trends of supported Networks
  As a User
  I want to view trending posts at the Trend Board

  Scenario: Open Trend Board the first time
    Given |I am on |the homepage strebo.net
    When |I press "Trend Board"
    Then |The system connects to the social networks
    And |The system searches in the single networks for trends
    And |The system embed the trending content into the Trend Board
    And |I should see "trending posts at the Trend Board"

  Scenario: Open Trend Board another time
    Given||I am on |the homepage strebo.net
    And |The system already has connected to the social networks
    When |I press "Trend Board"
    Then |The system search in the single networks for trending content
    And |The system embed the the trending content into the Trend Board
    And |I should see "trending posts at the Trend Board"