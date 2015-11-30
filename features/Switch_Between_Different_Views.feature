Feature: Switch between different Views
  As a User
  I want to switch views

  Scenario: Click on the Button for view switch
    Given |I am on |the homepage strebo.net
    And |I am on "Deck View"
    When |I press "switch View"
    Then |I am on "Feed View"

  Scenario: Click on the Button for view switch
    Given |I am on |the homepage strebo.net
    And |I am on "Feed View"
    When |I press "switch View"
    Then |I am on "Deck View"