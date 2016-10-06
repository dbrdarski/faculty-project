<?php 

namespace Core\Install;

use Core\Tasks\TaskManager;
use Core\Tasks\Table;



$tm = TaskManager::getInstance();
$tm->add(new Table('users', 
	function ($table){
		$table->increments('id');
		$table->string('email')->unique();
		$table->string('password');
		$table->string('firstName');
		$table->string('lastName');
		$table->string('gender');
		$table->string('type');
		$table->timestamps();
	})
)
->add(new Table('courses', 
	function ($table){
		$table->increments('id');
		$table->string('courseName');
		$table->timestamps();
	})
;