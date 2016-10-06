<?php 

namespace Core\Tasks;

Class TaskManager{

 	private function __invoke() {
 		if(self::$instance == null){
 			self::$instance = new TaskManager;
 		}
 		return self::$instance;
    }

	private $tasks = [];
	private static $instance;
	
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