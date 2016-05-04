<?php
namespace Strebo;
use Strebo;

class SocialNetworkFactory
{
    private $socialNetworks = array();

    function __construct(){
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

    function getInstances() {
        return $this->socialNetworks;
    }

    function getInstanceOf($network) {
        return $this->socialNetworks[$network];
    }
}