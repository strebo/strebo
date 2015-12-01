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
}
