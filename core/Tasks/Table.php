<?php 

namespace Core\Tasks;

use Illuminate\Database\Capsule\Manager as Capsule;

Class Table{

	public function __construct($name, $callback)
	{
		$this->name = $name;
		$this->callback = $callback;
	}

	public $name;
	public $task;
	
	public function up()
	{
		if(!Capsule::schema()->hasTable($this->name)) {
			Capsule::schema()->create($this->name, $this->callback);
		}
		return $this;
	}

	public function down()
	{
		if(Capsule::schema()->hasTable($this->name)) {
			Capsule::schema()->drop($this->name);
		}    			
		return $this;
	}
}