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

$app->get('/', 'HomeController:homeIndex');
$app->get('/library/{slug}', 'CourseController:courseIndex');
$app->get('/library/{course}/{lession}', 'LessionController:lessionIndex');
$app->get('/lecturers', 'LecturerController:lecturerListIndex');
$app->get('/lecturers/{id}', 'LecturerController:lecturerIndex');

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