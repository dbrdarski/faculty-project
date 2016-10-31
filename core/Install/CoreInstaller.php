<?php 

namespace Core\Install;

use Core\Tasks\TaskManager;
use Core\Tasks\Task;
use Core\Tasks\Table;
use Core\Models\User;
use Core\Models\Course;

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
				$table->string('lession_slug');
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
			    $lecturer = (new \Core\Models\User)->lecturer();
			    $student = (new \Core\Models\User)->student();
			    $student->add('student@course.plus', 'Pepe', 'Biserov', 'qwertybanana');
			    $dane = $lecturer->add('me@course.plus', 'Dane', 'Brdarski', 'qwertybanana');
			    $alex = $lecturer->add('alex@course.plus', 'Alex', 'Pffeipher', 'qwertybanana');
			    $jack = $lecturer->add('jack@course.plus', 'Jack', 'Dunham', 'qwertybanana');
			    $kirby = $lecturer->add('kirby@course.plus', 'Kirby', 'Jones', 'qwertybanana');
			    $larry = $lecturer->add('larry@course.plus', 'Larry', 'Smith', 'qwertybanana');

			    $course = new \Core\Models\Course;

			    $c = User::find($alex)->createCourse([
			    	'title'=>'Laravel 101',
			    	'slug' => 'laravel-101',
			    	'description' => 'Dive into the Laravel essentials with this course by one of the core contributors.',
			 		'level' => 'Begginer',
			 		'color' => 'red',
			 		'image' => 'laravel.png',
			 		'video' => 'lnf1GdNxDbc'
			    ]);

			    Course::find($c->id)->createLession([
			    	'title'=>'Introduction', 
			    	'lession_slug' => 'introduction', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'lnf1GdNxDbc'
			    ]);

			    Course::find($c->id)->createLession([
			    	'title'=>'Composer & Laravel Installer', 
			    	'lession_slug' => 'composer-and-laravel-installer', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'FKUAAZSJiGY'
			    ]);

			    Course::find($c->id)->createLession([
			    	'title'=>'Laravel File Structure', 
			    	'lession_slug' => 'laravel-file-structure', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'qmkAkoT9fjc'
			    ]);

			    Course::find($c->id)->createLession([
			    	'title'=>'Routing',
			    	'lession_slug' => 'routing', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'UyuVR1a1lRM'
			    ]);

			    Course::find($c->id)->createLession([
			    	'title'=>'Models',
			    	'lession_slug' => 'models', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'TZNr_ZvYp-A'
			    ]);

			    Course::find($c->id)->createLession([
			    	'title'=>'Relations',
			    	'lession_slug' => 'relations', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'fZO19FGOLUU'
			    ]);
			    Course::find($c->id)->createLession([
			    	'title'=>'Views',
			    	'lession_slug' => 'views', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => '_SlJJi_cLng'
			    ]);
			    Course::find($c->id)->createLession([
			    	'title'=>'Blade Templating',
			    	'lession_slug' => 'blade-templating', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'kTPM2ynqZoc'
			    ]);
			    Course::find($c->id)->createLession([
			    	'title'=>'Controllers',
			    	'lession_slug' => 'controllers', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'Yuku0C89jpw'
			    ]);
			    Course::find($c->id)->createLession([
			    	'title'=>'Authentication',
			    	'lession_slug' => 'authentication', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'bqkt6eSsRZs'
			    ]);
			    Course::find($c->id)->createLession([
			    	'title'=>'Middleware',
			    	'lession_slug' => 'middleware', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'bWhJJJwMvco'
			    ]);
			    Course::find($c->id)->createLession([
			    	'title'=>'Migrations',
			    	'lession_slug' => 'migrations', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.',
			    	'video' => 'IQnSruWG5O4'
			    ]);
			    Course::find($c->id)->createLession([
			    	'title'=>'Put it all together!',
			    	'lession_slug' => 'put-it-all-together', 'description' => 'Lorem ispum dor sit amet, essentials with this course by one of the core contributors.', 'video' => 'xDiqf74nfE0'
			    ]);

			    $c->publish()->save();

			    User::find($jack)->createCourse([
			 		'title' => 'Laravel Database Essentials',
			    	'slug' => 'laravel-database-essentials',
			 		'description' => 'Learn how take advantage of Laravel\'s built in model classes, schema builder and migration manager.',
			 		'level' => 'Intermediate',
			 		'color' => 'yellow',
			 		'image' => 'database.png'
		    	])->publish()->save();
			    User::find($kirby)->createCourse([
			 		'title' => 'ZURB Foudation Fundamentals',
			    	'slug' => 'zurb-foudation-fundamentals',
			 		'description' => 'Build responsive websites with one of the most advanced front end mobile frameworks.',
			 		'level' => 'Begginer',
			 		'color' => 'cyan',
			 		'image' => 'zurb.png'
		    	])->publish()->save();
			    User::find($jack)->createCourse([
			 		'title' => 'Laravel Templates',
			    	'slug' => 'laravel-templates',
			 		'description' => 'Laravel templating done right. Authored by the godfather of Laravel\'s own Blade templating engine.',
			 		'level' => 'Intermediate',
			 		'color' => 'violet',
			 		'image' => 'laravel.png'
		    	])->publish()->save();
			    User::find($alex)->createCourse([
			 		'title' => 'Laravel 401',
			    	'slug' => 'laravel-401',
			 		'description' => 'Dive into the Laravel essentials with this course by one of the core contributors.',
			 		'level' => 'Intermediate',
			 		'color' => 'orange',
			 		'image' => 'grunt.png'
		    	])->publish()->save();
			    User::find($kirby)->createCourse([
			 		'title' => 'SaSS is awesome!',
			    	'slug' => 'sass-is-awesome',
			 		'description' => 'Build responsive websites with one of the most advanced front end mobile frameworks.',
			 		'level' => 'Intermediate',
			 		'color' => 'violet',
			 		'image' => 'sass.png'
		    	])->publish()->save();
			    User::find($larry)->createCourse([
			 		'title' => 'Angular Pet Shop',
			    	'slug' => 'angular-pet-shop',
			 		'description' => 'Build your first Angular app. Dive into the most popular application framework developed by Google.',
			 		'level' => 'Advanced',
			 		'color' => 'orange',
			 		'image' => 'angular.png'
		    	])->publish()->save();
			    User::find($larry)->createCourse([
			 		'title' => 'Advanced Angular Directives',
			    	'slug' => 'advanced-angular-directives',
			 		'description' => 'This course will teach you everything you need to know about directives in Angular.',
			 		'level' => 'Advanced',
			 		'color' => 'yellow',
			 		'image' => 'angular.png'
		    	])->publish()->save();
			})
		);
	}
}