Feature: Show Trends of supported Networks
	Show trends of supported networks is an important Use-Case, because it serves the main functionality of strebo.
	It gives the user the possibility to get trending content of all the available social networks.

Scenario: Open Trend Board the first time
Given There are social networks with a API strebo can use
And the user open the Trend Board for the first time
When the user opens the trend board
Then the system connects to the social networks
And the system searches in the single networks for trends
And the system embed the trending content into the trend board


Scenario: Open Trend Board another time
Given There are social networks with a API strebo can use
And strebo already has connected to the social networks
When the user opens the trend board
Then the system search in the single networks for trending content
And the system embed the the trending content into the trend board