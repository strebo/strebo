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

	public function __construct($name, $icon)
	{
		$this->name = $name;
		$this->icon = $icon;
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

	public function encodeJSON($json){
		return $json;
	}
}
?>