<?php

namespace Core\Options;

class OptionManager{
	static private $options = [];
	
	static function setOption($name, $value)
	{		
		self::$options[$name] = $value;
	}
	static function getOption($name)
	{
		return self::$options[$name];
	}
	static function getOptions()
	{
		return self::$options;
	}
}