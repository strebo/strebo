<?php
namespace Strebo;

abstract class AbstractSocialNetwork {
	private $name;
	private $icon;

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
}
?>