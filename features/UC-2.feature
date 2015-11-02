Feature: Connect to Supported Social Media Network Accounts
  as a User
  I want to get access to the Personal Dashboard by connecting my Social Media Account to strebo

  Scenario: Clicking on a Social Network Symbol
    Given The user is already connected to that network
    When The symbol is clicked
    Then Nothing happens

  Scenario: Clicking on a Social Network Symbol
    Given The user is not yet connected to that network
    When The symbol is clicked
    Then A login-screen will open as pop-up

  Scenario: Login Screen
    Given The login-screen is shown
    When The user enters his login credentials
    And Clicks "Login"
    And The login was successful
    Then The Social Network Symbol changes to "logged in" design
    And The Social Network is now available from the "Personal Dashboard"

  Scenario: Login Screen
    Given The login-screen is shown
    When The user enters his login credentials
    And Clicks "Login"
    And The login was unsuccessful
    Then There is an error displayed
    And The user is not connected