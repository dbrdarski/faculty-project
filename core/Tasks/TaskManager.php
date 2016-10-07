<?php 

namespace Core\Tasks;

Class TaskManagerInstance{

	private $tasks = [];
	function getTasks(){
		return $this->tasks;
	}
	function getTask($name){
		$t = $this->tasks;
		if(isset($t[$name])){
			return $t[$name];
		} else{
			die('Burn in hell!!!!!!!!!!!!');
		}
	}
	public function add($task)
	{
		$this->tasks[$task->name] = $task;
		return $this;
	}
	public function install($name)
	{
		$this->getTask($name)->up();
		return $this;
	}
	public function uninstall($name)
	{
		$this->getTask($name)->down();
		return $this;
	}
	public function reinstall($name)
	{
		$this->getTask($name)->down()->up();
		return $this;
	}
	public function installAll()
	{
		array_map(function($t){
			$t->up();
		}, $this->tasks);
		return $this;

	}
	public function uninstallAll()
	{
		array_map(function($t){
			$t->down();
		}, $this->tasks);
		return $this;
	}
	public function reinstallAll()
	{
		array_map(function($t){
			$t->down()->up();
		}, $this->tasks);
		return $this;
	}
}

Class TaskManager{

	public function __construct(){
        if (null === self::$instance) {
            self::$instance = new TaskManagerInstance();
        }
	}

	private static $instance;

	public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new TaskManagerInstance();
        }
        return self::$instance;
    }
	
    private function __clone(){}
    private function __wakeup(){}	
}