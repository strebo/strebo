<?php

require __DIR__.'/../../../autoload.php';
require __DIR__.'/../../../../Autoloader.php';
spl_autoload_register (array ('Autoloader', 'autoload'));


use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

private $dataCollector;
private $result;
private $instagram;
private $soundCloud;
private $twitter;

  /**
   * @Given :arg1 environment variable is set to: :arg2
   */
  public function environmentVariableIsSetTo($arg1, $arg2)
  {
      putenv($arg1=$arg2);
  }

  /**
   * @When |I collect all Trends
   */
  public function iCollectAllTrends()
  {
    $this->dataCollector=new Strebo\DataCollector();
      $this->result=$this->dataCollector->collectPublicFeed();
  }

  /**
   * @When |I connect to Instagram
   */
  public function iConnectToInstagram()
  {
    $this->instagram=new Strebo\SocialNetworks\Instagram();
  }

  /**
   * @When |I connect to soundCloud
   */
  public function iConnectToSoundCloud()
  {
    $this->soundcloud=new Strebo\SocialNetworks\Soundcloud();
  }

  /**
   * @When |I connect to Twitter
   */
  public function iConnectToTwitter()
  {
    $this->twitter=new Strebo\SocialNetworks\Twitter();
  }

  /**
   * @Then |the result should contain :arg1
   */
  public function theResultShouldContain($arg1)
  {

    foreach (json_decode($this->result) as $i) {
      if($i->name==$arg1){
        return true;
      } else{return false;}
    }
  }

  /**
   * @Then |I should be able to perform requests to Instagram
   */
  public function iShouldBeAbleToPerformRequestsToInstagram()
  {
    $this->instagram->getPublicFeed();
  }

  /**
   * @Then |I should be able to perform requests to Twitter
   */
  public function iShouldBeAbleToPerformRequestsToTwitter()
  {
    $this->twitter->getPublicFeed();
  }

  /**
   * @Then |I should be able to perform requests to SoundCloud
   */
  public function iShouldBeAbleToPerformRequestsToSoundCloud()
  {
    $this->soundcloud->getPublicFeed();
  }


   public function __construct()
    {
    }
//////////////////////////////////////////////////////////////////
    /**
     * @Given |I am on |strebo.net
     */
    public function iAmOnStreboNet()
    {

    }

    /**
     * @Given | I am connected to Twitter
     */
    public function iAmConnectedToTwitter()
    {

    }

    /**
     * @When | I press the :arg1
     */
    public function iPressThe($arg1)
    {

    }

    /**
     * @Then |I should not see :arg1
     */
    public function iShouldNotSee($arg1)
    {

    }

    /**
     * @Given |I am on |the homepage strebo.net
     */
    public function iAmOnTheHomepageStreboNet()
    {
         
    }

    /**
     * @Given |I am not connected to Twitter
     */
    public function iAmNotConnectedToTwitter()
    {

    }

    /**
     * @When |I press :arg1
     */
    public function iPress($arg1)
    {

    }

    /**
     * @Then |I should see an :arg1 element
     */
    public function iShouldSeeAnElement($arg1)
    {

    }

    /**
     * @Given |I see an :arg1 element
     */
    public function iSeeAnElement($arg1)
    {

    }

    /**
     * @When |I fill in the following: username and password
     */
    public function iFillInTheFollowingUsernameAndPassword()
    {

    }

    /**
     * @When |I press :arg1 | it should pass
     */
    public function iPressItShouldPass($arg1)
    {

    }

    /**
     * @Then |I should see :arg1 in the :arg2 element
     */
    public function iShouldSeeInTheElement($arg1, $arg2)
    {

    }

    /**
     * @When |I press :arg1 | it should fail
     */
    public function iPressItShouldFail($arg1)
    {

    }

    /**
     * @Then |I should not see an :arg1 element
     */
    public function iShouldNotSeeAnElement($arg1)
    {

    }

    /**
     * @Then |I should not see :arg1 in the :arg2 element
     */
    public function iShouldNotSeeInTheElement($arg1, $arg2)
    {

    }

    /**
     * @Then | I get posts of the single social networks
     */
    public function iGetPostsOfTheSingleSocialNetworks()
    {

    }

    /**
     * @Then | I successfully fetch the dare from server
     */
    public function iSuccessfullyFetchTheDareFromServer()
    {

    }

    /**
     * @Then | I sort the Posts by Networks
     */
    public function iSortThePostsByNetworks()
    {

    }

    /**
     * @Then | I embed the feed in the Trend Board
     */
    public function iEmbedTheFeedInTheTrendBoard()
    {

    }

    /**
     * @Then |I should see :arg1
     */
    public function iShouldSee($arg1)
    {

    }

    /**
     * @Then | There is an Error while fetching Data
     */
    public function thereIsAnErrorWhileFetchingData()
    {

    }

    /**
     * @Then | I show an Error Message
     */
    public function iShowAnErrorMessage()
    {

    }

    /**
     * @Then | I create feed date with received data
     */
    public function iCreateFeedDateWithReceivedData()
    {

    }

    /**
     * @Then | I shuffle the posts
     */
    public function iShuffleThePosts()
    {

    }

    /**
     * @When |I press a single :arg1 in a view of my choice
     */
    public function iPressASingleInAViewOfMyChoice($arg1)
    {

    }

    /**
     * @Then |I should see :arg1 for that post
     */
    public function iShouldSeeForThatPost($arg1)
    {

    }

    /**
     * @Then |The system connects to the social networks
     */
    public function theSystemConnectsToTheSocialNetworks()
    {

    }

    /**
     * @Then |The system searches in the single networks for trends
     */
    public function theSystemSearchesInTheSingleNetworksForTrends()
    {

    }

    /**
     * @Then |The system embed the trending content into the Trend Board
     */
    public function theSystemEmbedTheTrendingContentIntoTheTrendBoard()
    {

    }

    /**
     * @Given |The system already has connected to the social networks
     */
    public function theSystemAlreadyHasConnectedToTheSocialNetworks()
    {

    }

    /**
     * @Then |The system search in the single networks for trending content
     */
    public function theSystemSearchInTheSingleNetworksForTrendingContent()
    {

    }

    /**
     * @Then |The system embed the the trending content into the Trend Board
     */
    public function theSystemEmbedTheTheTrendingContentIntoTheTrendBoard()
    {

    }

    /**
     * @Given |I am on :arg1
     */
    public function iAmOn($arg1)
    {

    }
}
