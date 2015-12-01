Feature: Show Item in a Details View
  As a User
  I Want to get Detailed Information about a post

  Scenario: Klick on a single Post
    Given |I am on |the homepage strebo.net
    When |I press a single "post" in a view of my choice
    Then |I should see "details" for that post