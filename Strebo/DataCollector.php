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
        $this->collectingData = true;
        $this->socialNetworks = (new SocialNetworkFactory())->getInstances();
        $this->publicFeed = ["DE" => [], "US" => [], "W" => []];
        $this->start(PTHREADS_INHERIT_NONE);
    }

    public function collectPublicFeed()
    {
        foreach (array_keys((array)$this->publicFeed) as $location) {
            foreach ($this->socialNetworks as $network => $instance) {
                if ($instance instanceof PublicInterface) {
                    echo "\n----Collecting Feed of " . $network . ": " . $location . "\n";
                    $locationString = "getLocation";
                    $data = json_decode($instance->getPublicFeed($instance->$locationString($location)));
                    if ($data != null) {
                        $this->publicFeed[$location][$network] = $data;
                    }
                    if ($data == null) {
                        continue;
                    }
                }
            }
        }
        $this->collectingData = false;
    }

    public function getPublicFeed($location)
    {
        if ($this->collectingData) {
            return null;
        }
        if (!$this->collectingData) {
            return json_encode(["type" => "data", "json" => $this->publicFeed[$location]]);
        }
    }

    public function collectPersonalFeed($user)
    {
        $privateFeed = $user->getPrivateFeed();

        foreach (array_keys((array)$user->getClients()) as $network) {
            if (!isset($privateFeed[$network])) {
                $privateFeed[$network] = json_decode($this->socialNetworks[$network]->getPersonalFeed($user));
                $user->addPrivateFeed($network, $privateFeed[$network]);
                $user->setTimer(0);
            }
        }

        return json_encode(["type" => "data", "json" => $privateFeed]);
    }

    public function search($tag)
    {
        $results = [];
        foreach ($this->socialNetworks as $network => $instance) {
            if ($instance instanceof PublicInterface) {
                $data = json_decode($instance->search($tag));

                if ($data != null) {
                    $results[$network] = $data;
                }
                if ($data == null) {
                    continue;
                }
            }
        }

        return json_encode(["type" => "data", "json" => $results]);
    }

    public function getNetworksPrivate($user)
    {
        $networks = [];

        foreach ($this->socialNetworks as $instance) {
            if ($instance instanceof PrivateInterface) {
                $status = "disconnected";
                $instance->isTokenValid($user);
                if ($user->getAuthorizedToken($instance->getName()) != null) {
                    $status = "connected";
                }
                $networks[] = ["name" => $instance->getName(),
                    "icon" => $instance->getIcon(),
                    "color" => $instance->getColor(),
                    "status" => $status];
            }
        }
        return json_encode(["type" => "networks", "json" => $networks]);
    }

    public function connect($user, $network)
    {
        $oauth = $this->socialNetworks[$network]->connect($user->getToken($network));
        $user->addAuthorizedToken($network, $oauth[0]);
        $user->addClient($network, $oauth[1]);
    }

    public function run()
    {
        require __DIR__ . '/../vendor/autoload.php';
        while (true) {
            echo "\n++Public Feed Collection was triggered.\n";
            $this->collectPublicFeed();
            echo "\n++Public Feed was successfully collected.\n";
            sleep(240);
        }
    }
}
