Feature: Connect to Instagram
  As the System
  I want to connect to Instagram
  Using it's API

  Scenario: Connect to Instagram
    Given "strebo_instagram_1" environment variable is set to: "c12bbe37871f443ca257ef54a131a777"
    When |I connect to Instagram
    Then |I should be able to perform requests to Instagram
