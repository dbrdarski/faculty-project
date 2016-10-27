<?php

namespace Core\Containers;

use \Core\Options\OptionManager;

Class Model{

	private $model;

	function __invoke()
	{
		return $this->model;
	}

	function __construct($model = [])
	{
		return $this->model = $this->toArray($model);
	}

	private function toArray($data)
	{
		return is_object($data) && method_exists($data, 'toArray') ? $data->toArray() : $data;
	}

	function append($name, $value)
	{
		$this->model[$name] = $this->toArray($value);
		return $this;
	}
}