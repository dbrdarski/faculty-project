<?php

namespace Core\Containers;

class Environment{
	static private $options = [];
	
	static function setGlobal($name, $value)
	{		
		self::$options[$name] = $value;
	}
	static function getGlobal($name)
	{
		return self::$options[$name];
	}
	static function getGlobals()
	{
		return self::$options;
	}
}