Feature: Connect to Supported Social Media Network Accounts
  as a User
  I want to get access to the Personal Dashboard by connecting my Social Media Account to strebo

  Scenario: Clicking on a Social Network Symbol – already connected
    Given |I am on |strebo.net
    And | I am connected to Twitter
    When | I press the "Twitter Symbol"
    Then |I should not see "Login"

  Scenario: Clicking on a Social Network Symbol – not connected
    Given |I am on |the homepage strebo.net
    And |I am not connected to Twitter
    When |I press "the Twitter Symbol"
    Then |I should see an "Login" element

  Scenario: Login Screen – success
    Given |I am on |the homepage strebo.net
    And |I see an "Login" element
    When |I fill in the following: username and password
    And |I press "login" | it should pass
    Then |I should see an "Twitter Logged In" element
    And |I should see "Twitter" in the "Personal Dashboard" element

  Scenario: Login Screen – no success
    Given |I am on |the homepage strebo.net
    And |I see an "Login" element
    When |I fill in the following: username and password
    And |I press "login" | it should fail
    Then |I should not see an "Twitter Logged In" element
    And |I should not see "Twitter" in the "Personal Dashboard" element