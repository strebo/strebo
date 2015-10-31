Feature: Show Trends of supported Networks
	Show trends of supported networks is an important Use-Case, because it serve one of the main functions of strebo.
	This Use-Case is the main function of the trend  board and it gives the user the possibility to see the trends of
	all the aviable social networks by using the different specific APIs.

Scenario: Open Trend Board for the first time
Given The used APIs support the search for trending contents
And The user open the Trend Board for the first time
When a user opens the Trend Board
Then the system connects to the single social networks
And the system search in the single networks for trends
And the system embedd the found trends in the Trend Board


Scenario: Open Trend Board for another Time
Given The used APIs support the search for trending contents
And strebo already has conneted to the single social networks
When the user opens the Trend Board
Then the system search in the single networks for trends
And the system embedd the found trends in to the Trend Board