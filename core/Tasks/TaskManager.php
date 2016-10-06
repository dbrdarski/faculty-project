<?php 

namespace Core\Tasks;

Class TaskManagerInstance{

	private $tasks = [];

	public function add($task)
	{
		$this->tasks[$task->name] = $task;		
		return $this;
	}
	public function install($name)
	{
		$this->tasks[$name]->up();
		return $this;
	}
	public function uninstall($name)
	{
		$this->tasks[$name]->down();
		return $this;
	}
	public function reinstall($name)
	{
		$this->tasks[$name]->down()->up();
		return $this;
	}
	public function installAll()
	{
		return array_map(function($t){
			$t->up();
		}, $this->tasks);
	}
	public function uninstallAll()
	{
		return array_map(function($t){
			$t->down();
		}, $this->tasks);
	}
	public function reinstallAll()
	{
		return array_map(function($t){
			$t->down()->up();
		}, $this->tasks);
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