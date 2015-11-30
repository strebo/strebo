Feature: Connect to Twitter
  As the System
  I want to connect to Twitter
  Using it's API

  Scenario: Connect to Twitter
    Given "strebo_twitter_1" environment variable is set to: "3872089625-xRvrn2Qb8QG5GDtrskVFy1E1wQAgQPpX5xsFKZa"
    And "strebo_twitter_2" environment variable is set to: "rnGWYxMdQJmj4Q5YdddNC2EUPhKffSvcj3WhBzOjSiO8a"
    And "strebo_twitter_3" environment variable is set to: "BspGfBzzXbBKtdWpl0eL1cihi"
    And "strebo_twitter_4" environment variable is set to: "I3ht3hDmG0vY2uTb32WaupyKQq7Rv0htaGW8x2DDhd5ExrNij9"
    When I connect to Twitter
    Then I should be able to perform requests
