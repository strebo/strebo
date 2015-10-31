Feature: Connect to Supported Social Media Network Accounts

  Scenario: Clicking on a Social Network Symbol
    Given The user is already connected to that network
    When the symbol is clicked
    Then nothing happens

  Scenario Clicking on a Social Network Symbol
    Given The user is not yet connected to that network
    When the symbol is clicked
    Then a login-screen will open as pop-up

  Scenario: Login Screen
    Given The login-screen is shown
    When the user enters his login credentials
    And clicks 'Login'
    And the login was successful
    Then the Social Network Symbol changes to 'logged in' design
    And the Social Network is now available in the 'Personal Dashboard'

  Scenario: Login Screen
    Given The login screen is shown
    When the user enters his login credentials
    And clicks "Login"
    And the login was unsuccessful
    Then there is an error displayed by the social network
    And the user is not connected