<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

function indexArr($arr){
	return array_map(function($v, $k){
		$v['index'] = $k + 1;
		return $v;
	}, $arr, array_keys($arr));
}

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    // ->setName('hello');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->post('/course/new', 'CourseController:createCourse');
$app->get('/course/new', 'CourseController:createCourseIndex');
$app->get('/course/{slug}', 'CourseController:editCourseIndex');


// $app->get('/course/new', function($req, $res){
// 	$this->view->render($res, "newcourse", []);
// });

$app->get('/course', function($req, $res){

	$this->view->render($res, "course", [
 		'name' => 'Laravel 101',
 		'courseURL' => '#',
 		'description' => 'Dive into the Laravel essentials with this course by one of the core contributors.',
 		'author' => 'Alex Pffeipher',
 		'level' => 'Beginner',
 		'bg' => 'red',
 		'img' => 'laravel.png',
 		'video' => 'lnf1GdNxDbc',
 		'lessions' => indexArr([
 			['url'=>"#", 'title' => 'Introduction'],
 			['url'=>"#", 'title' => 'Composer & Laravel Installer'],
 			['url'=>"#", 'title' => 'Laravel File Structure'],
 			['url'=>"#", 'title' => 'Routing'],
 			['url'=>"#", 'title' => 'Models'],
 			['url'=>"#", 'title' => 'Relationships'],
 			['url'=>"#", 'title' => 'Views'],
 			['url'=>"#", 'title' => 'Blade Templating'],
 			['url'=>"#", 'title' => 'Controllers'],
 			['url'=>"#", 'title' => 'Authentication'],
 			['url'=>"#", 'title' => 'Middleware'],
 			['url'=>"#", 'title' => 'Put it all together!'], 			
 		])
	]);
	return $res;
});
$app->get('/', function($req, $res){

    // // $course = \Core\Models\Course::find(1);
    // $student = \Core\Models\Student::find(1);
    // $student->courses()->attach(1);

    // return $res->withJson($student);
	 $this->view->render($res, "index", ["courses" => [
	 	[
	 		'name' => 'Laravel 101',
	 		'courseURL' => '#',
	 		'description' => 'Dive into the Laravel essentials with this course by one of the core contributors.',
	 		'author' => 'Alex Pffeipher',
	 		'level' => 'Beginner',
	 		'bg' => 'red',
	 		'img' => 'laravel.png'
	 	],
	 	[
	 		'name' => 'Laravel Database Essentials',
	 		'courseURL' => '#',
	 		'description' => 'Learn how take advantage of Laravel\'s built in model classes, schema builder and migration manager.',
	 		'author' => 'Jack Dunham',
	 		'level' => 'Intermediate',
	 		'bg' => 'yellow',
	 		'img' => 'database.png'
	 	],
	 	[
	 		'name' => 'ZURB Foudation Fundamentals',
	 		'courseURL' => '#',
	 		'description' => 'Build responsive websites with one of the most advanced front end mobile frameworks.',
	 		'author' => 'Kirby Jones',
	 		'level' => 'Beginner',
	 		'bg' => 'cyan',
	 		'img' => 'zurb.png'
	 	],
	 	[
	 		'name' => 'Laravel Templates',
	 		'courseURL' => '#',
	 		'description' => 'Learn how take advantage of Laravel\'s built in model classes, schema builder and migration manager.',
	 		'author' => 'Jack Dunham',
	 		'level' => 'Intermediate',
	 		'bg' => 'violet',
	 		'img' => 'laravel.png'
	 	],
	 	[
	 		'name' => 'Laravel 401',
	 		'courseURL' => '#',
	 		'description' => 'Dive into the Laravel essentials with this course by one of the core contributors.',
	 		'author' => 'Alex Pffeipher',
	 		'level' => 'Beginner',
	 		'bg' => 'orange',
	 		'img' => 'grunt.png'
	 	],
	 	[
	 		'name' => 'SaSS is awesome!',
	 		'courseURL' => '#',
	 		'description' => 'Build responsive websites with one of the most advanced front end mobile frameworks.',
	 		'author' => 'Kirby Jones',
	 		'level' => 'Beginner',
	 		'bg' => 'violet',
	 		'img' => 'sass.png'
	 	],
	 	[
	 		'name' => 'Angular Pet Shop',
	 		'courseURL' => '#',
	 		'description' => 'Build your first Angular app. Dive into the most popular application framework developed by Google.',
	 		'author' => 'Larry Smith',
	 		'level' => 'Advanced',
	 		'bg' => 'orange',
	 		'img' => 'angular.png'
	 	],
	 	[
	 		'name' => 'Advanced Angular Directives',
	 		'courseURL' => '#',
	 		'description' => 'Build your first Angular app. Dive into the most popular application framework developed by Google.',
	 		'author' => 'Larry Smith',
	 		'level' => 'Advanced',
	 		'bg' => 'yellow',
	 		'img' => 'angular.png'
	 	]
	 ]]);
	 return $res;
});

$app->get('/install', 'InstallerController:installAll')->setName('install');
$app->get('/install/{table}', 'InstallerController:install')->setName('install');
$app->get('/reinstall', 'InstallerController:reinstallAll')->setName('reinstall');
$app->get('/reinstall/{table}', 'InstallerController:reinstall')->setName('reinstall');
$app->get('/uninstall', 'InstallerController:uninstallAll')->setName('uninstall');
$app->get('/uninstall/{table}', 'InstallerController:uninstall')->setName('uninstall');

$app->run();