<?php
namespace Strebo;

abstract class AbstractSocialNetwork
{
    private $name;
    private $icon;
    private $apiKey;
    private $apiSecret;
    private $apiCallback;
    private $color;
    private $locationDE;
    private $locationUS;
    private $locationW;

    public function __construct($name, $icon, $color, $locationDE, $locationUS, $locationW)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->color = $color;
        $this->locationDE = $locationDE;
        $this->locationUS = $locationUS;
        $this->locationW = $locationW;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function encodeJSON($json)
    {
        return $json;
    }

    public function getLocationDE()
    {
        return $this->locationDE;
    }

    public function getLocationUS()
    {
        return $this->locationUS;
    }

    public function getLocationW()
    {
        return $this->locationW;
    }
}

?>
