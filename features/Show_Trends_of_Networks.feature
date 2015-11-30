Feature: Show Trends of supported Networks
  As a User
  I want to view trending posts at the Trend Board#

  Scenario: Open Trend Board the first time
    Given |I am on |the homepage strebo.net
    When |I press "Trend Board"
    Then the system connects to the social networks
    And the system searches in the single networks for trends
    And the system embed the trending content into the trend board

  Scenario: Open Trend Board another time
    Given There are social networks with a API strebo can use
    And strebo already has connected to the social networks
    When the user opens the trend board
    Then the system search in the single networks for trending content
    And the system embed the the trending content into the trend board