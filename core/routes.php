<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name')->setName('hello');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/install', 'InstallerController:all')->setName('install');
$app->get('/install/{table}', 'InstallerController:table')->setName('install');

$app->run();