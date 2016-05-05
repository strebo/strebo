<?php
namespace Strebo;

use Strebo;

class DataCollector extends \Thread
{
    private $socialNetworks;
    private $publicFeed;
    private $collectingData;

    public function __construct()
    {
        $pattern = '/[A-Za-z]*/';
        $match = [];
        $this->collectingData = true;
        $this->socialNetworks = (new SocialNetworkFactory())->getInstances();
        $this->publicFeed = ["DE" => [], "US" => [], "W" => []];
        $this->start();
    }

    public function collectPublicFeed()
    {
        echo "public";
        foreach ($this->publicFeed as $location => $value) {
            echo $location;
            foreach ($this->socialNetworks as $network => $instance) {
                echo $network;
                $locationString = "getLocation" . $location;
                $data = json_decode($instance->getPublicFeed($instance->$locationString()));

                if ($data != null) {
                    $this->publicFeed[$location][$network] = $data;
                } else {
                   // next;
                }
            }
        }
        $this->collectingData = false;
    }

    public function getPublicFeed($location)
    {
        if ($this->collectingData) {
            return null;
        } else {
            return json_encode(["type" => "data", "json" => $this->publicFeed[$location]]);
        }
    }

    public function collectPersonalFeed($tokens)
    {
        $personalFeed = [];

        foreach ($tokens as $network => $token) {
            $personalFeed[$network] = json_decode($this->socialNetworks[$network]->getPersonalFeed($token));
        }

        return json_encode(["type" => "data", "json" => $personalFeed]);
    }

    public function search($tag)
    {
        $results = [];
        foreach ($this->socialNetworks as $network => $instance) {

            $data = json_decode($instance->search($tag));

            if ($data != null) {
                $results[$network] = $data;
            } else {
                next;
            }
        }

        return json_encode(["type" => "data", "json" => $results]);
    }


    public function run()
    {
        while (true) {
            $this->collectPublicFeed();
            sleep(90);
        }
    }

}
