Feature: Get Trends of supported Networks
  As the system
  I want to connect to get the trends of the single Networks

  Scenario: Get Trends of supported Networks
    Given "strebo_instagram_1" environment variable is set to: "c12bbe37871f443ca257ef54a131a777"
    And "strebo_twitter_1" environment variable is set to: "3872089625-xRvrn2Qb8QG5GDtrskVFy1E1wQAgQPpX5xsFKZa"
    And "strebo_twitter_2" environment variable is set to: "rnGWYxMdQJmj4Q5YdddNC2EUPhKffSvcj3WhBzOjSiO8a"
    And "strebo_twitter_3" environment variable is set to: "BspGfBzzXbBKtdWpl0eL1cihi"
    And "strebo_twitter_4" environment variable is set to: "I3ht3hDmG0vY2uTb32WaupyKQq7Rv0htaGW8x2DDhd5ExrNij9"
    When |I collect all Trends
    Then |the result should contain "SoundCloud"
    And |the result should contain "Instagram"
    And |the result should contain "Twitter"
