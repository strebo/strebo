<?php
namespace Strebo;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../Autoloader.php';
spl_autoload_register (array ('Autoloader', 'autoload'));

abstract class AbstractSocialNetwork {
	private $name;
	private $icon;
	private $apiKey;
	private $apiSecret;
	private $apiCallback;
	private $color;

	public function __construct($name, $icon, $color)
	{
		$this->name = $name;
		$this->icon = $icon;
		$this->color= $color;
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
		$this->color=$color;
	}

	public function encodeJSON($json)
	{
		return $json;
	}
}
?>