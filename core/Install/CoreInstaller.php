<?php 

namespace Core\Install;

use Core\Tasks\TaskManager;
use Core\Tasks\Task;
use Core\Tasks\Table;

class CoreInstaller{

	function __construct(){
		$tm = TaskManager::getInstance();
		$tm->add(new Table('users',
			function ($table){
				$table->increments('id');
				$table->string('email')->unique();
				$table->string('password');
				$table->string('first_name');
				$table->string('last_name');
				// $table->string('gender');
				$table->integer('type');
				$table->boolean('active');
				$table->timestamps();
			})
		)
		->add(new Table('courses', 
			function ($table){
				$table->increments('id');
				$table->integer('lecturer_id')->unsigned();
				// $table->foreign('owner')->references('id')->on('users')->onDelete('cascade');;
				$table->string('title');
				$table->string('slug');
				$table->text('description');
				$table->string('video');
				$table->string('image');
				$table->integer('level');
				$table->integer('color');
				$table->boolean('active');
				$table->timestamps();
			})
		)
		->add(new Table('course_student', 
			function ($table){
				$table->increments('id');
				$table->integer('student_id')->unsigned();
				// $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
				$table->integer('course_id')->unsigned();
				// $table->foreign('courseId')->references('id')->on('courses')->onDelete('cascade');
				$table->integer('grade');
				$table->integer('rating');
				$table->timestamps();
			})
		)
		->add(new Table('lessions', 
			function ($table){
				$table->increments('id');
				$table->integer('course_id')->unsigned();
				$table->string('title');
				$table->string('description');
				$table->string('video');
				$table->timestamps();
			})
		)
		->add(new Table('lession_student',
			function ($table){
				$table->increments('id');
				$table->integer('student_id')->unsigned();
				// $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
				$table->integer('course_id')->unsigned();
				// $table->foreign('courseId')->references('id')->on('courses')->onDelete('cascade');
				$table->boolean('complete');
				$table->integer('grade');
				$table->timestamps();
			})
		)
		->add(new Task('add_users_and_courses',
			function(){
			    $user1 = new \Core\Models\Lecturer;
			    $user2 = new \Core\Models\Student;
			    $user1->add('me@admin.com', 'Dane', 'Brdarski', 'qwertybanana');
			    $user2->add('student@admin.com', 'Pepe', 'Biserov', 'qwertybanana');
			    $course = new \Core\Models\Course;
			    $user1->createCourse([
			    	'title'=>'New Course',
			    	'slug' => 'new_course',
			    	'description' => 'This is a course'
			    ]);
			    $user1->createCourse([
			    	'title'=> 'New Course 2',
			    	'slug' => 'new_course_2',
			    	'description' => 'This is a course'
		    	]);
			})
		);
	}
}