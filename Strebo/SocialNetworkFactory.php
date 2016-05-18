<?php
namespace Strebo;

use Strebo;

class SocialNetworkFactory
{
    private $socialNetworks = array();

    public function __construct()
    {
        $pattern = '/[A-Za-z]*/';
        $match = [];
        foreach (scandir(__DIR__ . '/SocialNetworks') as $file) {
            preg_match($pattern, $file, $match);
            if ($match[0] != "") {
                $this->socialNetworks[$match[0]] = (array)[];
                $createInstance = "Strebo\\SocialNetworks\\" . $match[0];
                $this->socialNetworks[$match[0]] = new $createInstance();
            }
        }
    }

    public function getInstances()
    {
        return $this->socialNetworks;
    }

    public function getInstanceOf($network)
    {
        return $this->socialNetworks[$network];
    }
}
