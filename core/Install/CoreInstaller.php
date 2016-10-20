<?php 

namespace Core\Install;

use Core\Tasks\TaskManager;
use Core\Tasks\Task;
use Core\Tasks\Table;
use Core\Models\Lecturer;

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
			    $lecturer = new \Core\Models\Lecturer;
			    $student = new \Core\Models\Student;
			    $student->add('student@course.plus', 'Pepe', 'Biserov', 'qwertybanana');
			    $dane = $lecturer->add('me@course.plus', 'Dane', 'Brdarski', 'qwertybanana');
			    $alex = $lecturer->add('alex@course.plus', 'Alex', 'Pffeipher', 'qwertybanana');
			    $jack = $lecturer->add('jack@course.plus', 'Jack', 'Dunham', 'qwertybanana');
			    $kirby = $lecturer->add('kirby@course.plus', 'Kirby', 'Jones', 'qwertybanana');
			    $larry = $lecturer->add('larry@course.plus', 'Larry', 'Smith', 'qwertybanana');

			    $course = new \Core\Models\Course;

			    Lecturer::find($alex)->createCourse([
			    	'title'=>'Laravel 101',
			    	'slug' => 'laravel-101',
			    	'description' => 'Dive into the Laravel essentials with this course by one of the core contributors.',
			 		'level' => 0,
			 		'color' => 3,
			 		'image' => 'laravel.png'
			    ]);
			    Lecturer::find($jack)->createCourse([
			 		'title' => 'Laravel Database Essentials',
			    	'slug' => 'laravel-database-essentials',
			 		'description' => 'Learn how take advantage of Laravel\'s built in model classes, schema builder and migration manager.',
			 		'level' => 1,
			 		'color' => 1,
			 		'image' => 'database.png'
		    	]);
			    Lecturer::find($kirby)->createCourse([
			 		'title' => 'ZURB Foudation Fundamentals',
			    	'slug' => 'zurb-foudation-fundamentals',
			 		'description' => 'Build responsive websites with one of the most advanced front end mobile frameworks.',
			 		'level' => 0,
			 		'color' => 6,
			 		'image' => 'zurb.png'
		    	]);
			    Lecturer::find($jack)->createCourse([
			 		'title' => 'Laravel Templates',
			    	'slug' => 'laravel-templates',
			 		'description' => 'Laravel templating done right. Authored by the godfather of Laravel\'s own Blade templating engine.',
			 		'level' => 1,
			 		'color' => 4,
			 		'image' => 'laravel.png'
		    	]);
			    Lecturer::find($alex)->createCourse([
			 		'title' => 'Laravel 401',
			    	'slug' => 'laravel-401',
			 		'description' => 'Dive into the Laravel essentials with this course by one of the core contributors.',
			 		'level' => 1,
			 		'color' => 2,
			 		'image' => 'grunt.png'
		    	]);
			    Lecturer::find($kirby)->createCourse([
			 		'title' => 'SaSS is awesome!',
			    	'slug' => 'sass-is-awesome',
			 		'description' => 'Build responsive websites with one of the most advanced front end mobile frameworks.',
			 		'level' => 1,
			 		'color' => 4,
			 		'image' => 'sass.png'
		    	]);
			    Lecturer::find($larry)->createCourse([
			 		'title' => 'Angular Pet Shop',
			    	'slug' => 'angular-pet-shop',
			 		'description' => 'Build your first Angular app. Dive into the most popular application framework developed by Google.',
			 		'level' => 2,
			 		'color' => 2,
			 		'image' => 'angular.png'
		    	]);
			    Lecturer::find($larry)->createCourse([
			 		'title' => 'Advanced Angular Directives',
			    	'slug' => 'advanced-angular-directives',
			 		'description' => 'This course will teach you everything you need to know about directives in Angular.',
			 		'level' => 2,
			 		'color' => 1,
			 		'image' => 'angular.png'
		    	]);
			})
		);
	}
}