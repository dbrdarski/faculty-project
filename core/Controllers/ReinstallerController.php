<?php

namespace Core\Controllers;

use Core\Tasks\TaskManager;
use Core\Tasks\Table;

class ReinstallerController extends Controller
{
    public function all($request, $response)
    {
    	$response->getBody()->write("Reinstalling Database Tables");
    	$tm = TaskManager::getInstance()->reinstallAll();
		return $response;
    }   
    public function table($request, $response, $args)
    {
 		$table = $request->getAttribute('table');
    	$response->getBody()->write("Reinstalling Database Table: $table");
    	$tm = TaskManager::getInstance()->reinstall($table);
		return $response;
    }
}