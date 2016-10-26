<?php

namespace Core\Containers;

use \Core\Options\OptionManager;

Class View{

	function __construct($res, $container)
	{
		$this->container = $container;
		$this->res = $res;
	}
	
	function __invoke($template, $model)
	{
		$this->container->view->render($this->res, $template, array_merge(OptionManager::getOptions(), $model));
		return $this->res;
	}
}