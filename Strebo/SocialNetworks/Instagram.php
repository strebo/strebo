<?php
namespace Strebo\SocialNetworks;
use Strebo;

class Instagram
    extends Strebo\AbstractSocialNetwork
    implements  Strebo\PrivateInterface,
                Strebo\PublicInterface {

    function __construct()
    {
        parent::__construct('Facebook', 'facebook');
    }

    public function connect()
    {
        // TODO: Implement connect() method.
    }

    public function getPersonalFeed()
    {
        // TODO: Implement getPersonalFeed() method.
    }

    public function search()
    {
        // TODO: Implement search() method.
    }

    public function getPublicFeed()
    {
        // TODO: Implement getPublicFeed() method.
    }
}
?>