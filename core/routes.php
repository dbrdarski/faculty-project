<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', 'HomeController:homeIndex');

$app->get('/user', 'UserController:userIndex')->setName('user');
$app->get('/user/{username}', 'UserController:userIndex');

$app->get('/asd', function($req, $res){
	// $admins = \Core\Models\Role::find(1);
	echo "<pre>";
	var_dump(\Core\Models\User::with(['roles' => function($q){ $q->with('permissions'); }])->find(1)->toArray());
	die();
});

$app->get('/library/{slug}', 'CourseController:courseIndex');
$app->get('/library/{course}/{lession}', 'LessionController:lessionIndex');
$app->get('/lecturers', 'LecturerController:lecturerListIndex');
$app->get('/lecturers/{id}', 'LecturerController:lecturerIndex');

$app->get('/signup', 'AuthController:signUpIndex');
$app->post('/signup', 'AuthController:signUp');
$app->get('/signup/v', 'AuthController:signUpValidator');
$app->post('/signup/v', 'AuthController:signUpValidator');

$app->post('/course/new', 'CourseController:createCourse');
$app->get('/course/new', 'CourseController:createCourseIndex');
$app->post('/course/{slug}', 'CourseController:editCourse');
$app->post('/course/{slug}/publish', 'CourseController:publishCourse');
$app->get('/course/{slug}', 'CourseController:editCourseIndex');

$app->get('/install', 'InstallerController:installAll')->setName('install');
$app->get('/install/{table}', 'InstallerController:install')->setName('install');
$app->get('/reinstall', 'InstallerController:reinstallAll')->setName('reinstall');
$app->get('/reinstall/{table}', 'InstallerController:reinstall')->setName('reinstall');
$app->get('/uninstall', 'InstallerController:uninstallAll')->setName('uninstall');
$app->get('/uninstall/{table}', 'InstallerController:uninstall')->setName('uninstall');

$app->run();