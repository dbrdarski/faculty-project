<?php

namespace Core\Controllers;

// use Slim\Views\Twig as View;
use Illuminate\Database\Capsule\Manager as Capsule;

class InstallerController extends Controller
{
    public function index($request, $response)
    {
    	$response->getBody()->write("Installing Database Tables");
    
    	Capsule::schema()->create('users', function ($table){
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('firstName');
			$table->string('lastName');
			$table->string('gender');
			$table->string('type');
			$table->timestamps();
		});

		return $response;
    }
}