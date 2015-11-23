<?php
namespace Strebo;
use Strebo;

class DataCollector
{

    private $instagram;
    private $twitter;
    private $soundcloud;

    public function __construct()
    {
        $this->instagram = new SocialNetworks\Instagram();
        $this->twitter = new SocialNetworks\Twitter();
        $this->soundcloud = new SocialNetworks\Soundcloud();
    }

    public function collectPublicFeed()
    {

        $publicFeed = [];
        $publicFeed[] = json_decode($this->instagram->getPublicFeed());
        $publicFeed[] = json_decode($this->twitter->getPublicFeed());
        $publicFeed[] = json_decode($this->soundcloud->getPublicFeed());

        return json_encode($publicFeed);

    }

    public function collectPersonalFeed()
    {
        $personalFeed = [];
        $personalFeed[] = json_decode($this->instagram->getPersonalFeed());
        $personalFeed[] = json_decode($this->twitter->getPersonalFeed());
        $personalFeed[] = json_decode($this->soundcloud->getPersonalFeed());

        return json_encode($personalFeed);
    }

    public function searchNetworks($tag)
    {

        $results = [];
        $results[] = json_decode($this->instagram->search($tag));
        $results[] = json_decode($this->twitter->search($tag));
        $results[] = json_decode($this->soundcloud->search($tag));

        return json_encode($results);

    }


}

?>
