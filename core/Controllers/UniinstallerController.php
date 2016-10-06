<?php

namespace Core\Controllers;

use Core\Tasks\TaskManager;
use Core\Tasks\Table;

class UninstallerController extends Controller
{
    public function all($request, $response)
    {
    	$response->getBody()->write("Uninstalling Database Tables");
    	$tm = TaskManager::getInstance()->uninstallAll();
		return $response;
    }   
    public function table($request, $response, $args)
    {
 		$table = $request->getAttribute('table');
    	$response->getBody()->write("Uninstalling Database Table: $table");
    	$tm = TaskManager::getInstance()->uninstall($table);
		return $response;
    }
}