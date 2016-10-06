<?php 

namespace Core\Tasks;

Class InstallTasks{

	public function __construct($name, $callback)
	{
		$this->name = $name;
		$this->callback = $callback;
	}

	private static $tasks = [];
	
	public static function run()
	{
		if(!Capsule::schema()->hasTable($this->name)){
			Capsule::schema()->create('users', $this->callback);		
		}    	
	}
}