<?php
namespace Strebo;
use Strebo;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../Autoloader.php';
spl_autoload_register(array('Autoloader', 'autoload'));

class DataCollector extends \Thread
{

    private $instagram;
    private $twitter;
    private $soundcloud;
    private $locations;
    private $publicFeedUS = [];
    private $publicFeedDE = [];
    private $publicFeedWORLD = [];


    public function __construct()
    {
        $this->instagram = new SocialNetworks\Instagram();
        $this->twitter = new SocialNetworks\Twitter();
        $this->soundcloud = new SocialNetworks\SoundCloud();
        $this->locations = ["Instagram" => ["DE" => [51.1656910, 10.4515260], "US" => [37.0902400, -95.7128910], "WORLD" => [null, null]], "Twitter" => ["DE" => 23424829, "US" => 23424977, "WORLD" => 1], "SoundCloud" => ["DE" => null, "US" => null, "WORLD" => null]];
        $this->start();
    }

    public function collectPublicFeed()
    {
        $this->publicFeedUS[0] = json_decode($this->instagram->getPublicFeed($this->locations->Instagram->US));
        $this->publicFeedUS[1] = json_decode($this->twitter->getPublicFeed($this->locations->Twitter->US));
        $this->publicFeedUS[2] = json_decode($this->soundcloud->getPublicFeed(null));
        $this->publicFeedDE[0] = json_decode($this->instagram->getPublicFeed($this->locations->Instagram->DE));
        $this->publicFeedDE[1] = json_decode($this->twitter->getPublicFeed($this->locations->Twitter->DE));
        $this->publicFeedDE[2] = json_decode($this->soundcloud->getPublicFeed(null));
        $this->publicFeedWORLD[0] = json_decode($this->instagram->getPublicFeed($this->locations->Instagram->WORLD));
        $this->publicFeedWORLD[1] = json_decode($this->twitter->getPublicFeed($this->locations->Twitter->WORLD));
        $this->publicFeedWORLD[2] = json_decode($this->soundcloud->getPublicFeed(null));

    }

    public function getPublicFeed($location)
    {
        $geo = strtoupper($location);
        echo($geo);
        switch ($geo) {
            case 'US':
                return json_encode(["type" => "data", "json" => $this->publicFeedUS]);
                break;
            case 'DE':
                return json_encode(["type" => "data", "json" => $this->publicFeedDE]);
                break;
            case 'WORLD':
                return json_encode(["type" => "data", "json" => $this->publicFeedWORLD]);
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
            sleep(1);
            $this->collectPublicFeed();
        }
    }

}

?>
