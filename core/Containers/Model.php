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

	private function toArray($model)
	{
		return is_array($model) ? $model : ( method_exists($model, 'toArray') ? $model->toArray() : (array) $model );
	}

	function append($name, $value)
	{
		$this->model[$name] = $this->toArray($value);
		return $this;
	}
}