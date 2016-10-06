<?php

namespace Core\Controllers;

use Core\Tasks\TaskManager;
use Core\Tasks\Table;

class InstallerController extends Controller
{
    public function all($request, $response)
    {
    	$response->getBody()->write("Installing Database Tables");
    	$tm = TaskManager::getInstance()->installAll();
		return $response;
    }   
    public function table($request, $response, $args)
    {
 		$table = $request->getAttribute('table');
    	$response->getBody()->write("Installing Database Table: $table");
    	$tm = TaskManager::getInstance()->install($table);
		return $response;
    }
}