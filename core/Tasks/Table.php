<?php 

namespace Core\Tasks;

use Illuminate\Database\Capsule\Manager as Capsule;

Class Table{

	public function __construct($name, $callback)
	{
		$this->name = $name;
		$this->callback = $callback;
	}

	private $name;
	private $task;
	
	public function up()
	{
		if(!Capsule::schema()->hasTable($this->name)) {
			Capsule::schema()->create('users', $this->callback);
		}    	
	}

	public function down()
	{
		if(Capsule::schema()->hasTable($this->name)) {
			Capsule::schema()->dropTable($this->name);
		}    			
	}
}