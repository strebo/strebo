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

  private $soundCloud;

  /**
   * @Given :arg1 environment variable is set to: :arg2
   */
  public function environmentVariableIsSetTo($arg1, $arg2)
  {
      putenv($arg1=$arg2);
  }

  /**
   * @When I connect to soundCloud
   */
  public function iConnectToSoundCloud()
  {
    $this->soundcloud=new Strebo\SocialNetworks\Soundcloud();
  }

  /**
   * @Then I should be able to perform requests
   */
  public function iShouldBeAbleToPerformRequests()
  {
    $this->soundcloud->getPublicFeed();
  }

    public function __construct()
    {
    }
}
