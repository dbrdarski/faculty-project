<?php 

namespace Core\Install;

use Core\Tasks\TaskManager;
use Core\Tasks\Table;

class CoreInstaller{

	function __construct(){
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
				$table->boolean('active');
				$table->timestamps();
			})
		)
		->add(new Table('courses', 
			function ($table){
				$table->increments('id');
				$table->integer('owner');
				$table->foreign('owner')->references('id')->on('users');
				$table->string('name');
				$table->boolean('active');
				$table->timestamps();
			})
		)
		->add(new Table('subscriptions', 
			function ($table){
				$table->increments('id');
				$table->integer('userId');
				$table->foreign('userId')->references('id')->on('users');
				$table->integer('courseId');
				$table->foreign('courseId')->references('id')->on('courses');
				$table->integer('grade');
				$table->integer('rating');
				$table->timestamps();
			})
		);
	}
}