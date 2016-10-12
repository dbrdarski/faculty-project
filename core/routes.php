<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    // ->setName('hello');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/', function($req, $res){
    // $course = new \Core\Models\Course;
    // $user = new \Core\Models\Lecturer;
    // $r = $user->add('me2@admin.com', 'Dane', 'Brdarski', 'qwertybanana');
    // $c = $course->addCourse('New Course', 'This is a course');
    // $r = $user->createCourse("New Course 2", "This a course also.");
    $s = new \Core\Models\Student;
    $s->find(2)->courses()->find(1)->subscriptions()->create([]);
    return $res->withJson($s);
});

$app->get('/install', 'InstallerController:installAll')->setName('install');
$app->get('/install/{table}', 'InstallerController:install')->setName('install');
$app->get('/reinstall', 'InstallerController:reinstallAll')->setName('reinstall');
$app->get('/reinstall/{table}', 'InstallerController:reinstall')->setName('reinstall');
$app->get('/uninstall', 'InstallerController:uninstallAll')->setName('uninstall');
$app->get('/uninstall/{table}', 'InstallerController:uninstall')->setName('uninstall');

$app->run();