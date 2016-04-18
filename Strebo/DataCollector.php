<?php
namespace Strebo;
use Strebo;

require __DIR__ . '/../vendor/autoload.php';

class DataCollector extends \Thread
{

    private $instagram;
    private $twitter;
    private $soundcloud;
	private $youtube;
    private $locations;
    private $publicFeedUS = [];
    private $publicFeedDE = [];
    private $publicFeedW = [];


    public function __construct()
    {
        $this->instagram = new SocialNetworks\Instagram();
        $this->twitter = new SocialNetworks\Twitter();
        $this->soundcloud = new SocialNetworks\SoundCloud();
		$this->youtube = new SocialNetworks\YouTube();
        $this->locations = ["YouTube" => ["DE" => "DE", "US" => "US", "W" => null], "Instagram" => ["DE" => [51.1656910, 10.4515260], "US" => [37.0902400, -95.7128910], "W" => [null, null]], "Twitter" => ["DE" => 23424829, "US" => 23424977, "W" => 1], "SoundCloud" => ["DE" => null, "US" => null, "W" => null]];
        $this->start();
    }

    public function collectPublicFeed()
    {
        $this->publicFeedUS[0] = json_decode($this->instagram->getPublicFeed($this->locations->Instagram->US));
        $this->publicFeedUS[1] = json_decode($this->twitter->getPublicFeed($this->locations->Twitter->US));
        $this->publicFeedUS[2] = json_decode($this->soundcloud->getPublicFeed(null));
        //$this->publicFeedUS[3] = json_decode($this->youtube->getPublicFeed($this->locations->YouTube->US));
        $this->publicFeedDE[0] = json_decode($this->instagram->getPublicFeed($this->locations->Instagram->DE));
        $this->publicFeedDE[1] = json_decode($this->twitter->getPublicFeed($this->locations->Twitter->DE));
        $this->publicFeedDE[2] = json_decode($this->soundcloud->getPublicFeed(null));
        //$this->publicFeedDE[3] = json_decode($this->youtube->getPublicFeed($this->locations->YouTube->DE));
        $this->publicFeedW[0] = json_decode($this->instagram->getPublicFeed($this->locations->Instagram->W));
        $this->publicFeedW[1] = json_decode($this->twitter->getPublicFeed($this->locations->Twitter->W));
        $this->publicFeedW[2] = json_decode($this->soundcloud->getPublicFeed(null));
        //$this->publicFeedW[3] = json_decode($this->youtube->getPublicFeed($this->locations->YouTube->W));

    }

    public function getPublicFeed($location)
    {
        $geo = strtoupper($location);

        switch ($geo) {
            case 'US':
                return json_encode(["type" => "data", "json" => $this->publicFeedUS]);
                break;
            case 'DE':
                return json_encode(["type" => "data", "json" => $this->publicFeedDE]);
                break;
            case 'W':
                return json_encode(["type" => "data", "json" => $this->publicFeedW]);
                break;
        }

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

    public function run()
    {
        while (true) {
            $this->collectPublicFeed();
			sleep(60);
        }
    }

}

?>
