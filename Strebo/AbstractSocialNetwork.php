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
    private $locations;

    public function __construct(
        $name,
        $icon,
        $color,
        $locations,
        $apiKey,
        $apiSecret,
        $apiCallback
    ) {
        $this->name = $name;
        $this->icon = $icon;
        $this->color = $color;
        $this->locations = $locations;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->apiCallback = $apiCallback;
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

    public function getLocation($location)
    {
        return $this->locations[$location];
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    public function getApiCallback()
    {
        return $this->apiCallback;
    }

    public function formatTime($time)
    {
        $formattedTime = date('d m Y H i s', $time);

        $timeJSON = array('day' => substr($formattedTime, 0, 2),
            'month' => substr($formattedTime, 3, 2),
            'year' => substr($formattedTime, 5, 5),
            'hour' => substr($formattedTime, 11, 2),
            'minute' => substr($formattedTime, 14, 2),
            'second' => substr($formattedTime, 17)
        );

        return json_encode($timeJSON);
    }
}
