<?php

namespace Core\Controllers;

use Core\Tasks\TaskManager;
use Core\Tasks\Table;

class InstallerController extends Controller{
    
    // private $messages = [
    //     "installAll" => "Installing Database Tables\n",
    //     "reinstallAll" => "Reinstalling Database Tables\n",
    //     "uninstallAll" => "Uninstalling Database Tables\n",
    //     "installTable" => "Installing Database Table: %s",
    //     "reinstallTable" => "Reinstalling Database Table: %s",
    //     "uninstallTable" => "Uninstalling Database Table: %s"
    // ];

    function __call($name, $args){
        $request = array_shift($args);
        $response = array_shift($args);
        $response->getBody()->write(printf($this->messages[$name], $name));
        $tm = TaskManager::getInstance();
        return $response;
    }
    public function installAll($request, $response)
    {
    	$response->getBody()->write("Installing Database Tables\n");
    	$tm = TaskManager::getInstance()->installAll();
		return $response;
    }
    public function install($request, $response, $args)
    {
 		$table = $request->getAttribute('table');
    	$response->getBody()->write("Installing Database Table: $table\n");
    	$tm = TaskManager::getInstance()->install($table);
		return $response;
    }
    public function uninstallAll($request, $response)
    {
        $response->getBody()->write("Uninstalling Database Tables");
        $tm = TaskManager::getInstance()->uninstallAll();
        return $response;
    }
    public function uninstall($request, $response, $args)
    {
        $table = $request->getAttribute('table');
        $response->getBody()->write("Uninstalling Database Table: $table");
        $tm = TaskManager::getInstance()->uninstall($table);
        return $response;
    }
    public function reinstallAll($request, $response)
    {
        $response->getBody()->write("Reinstalling Database Tables");
        $tm = TaskManager::getInstance()->reinstallAll();
        return $response;
    }
    public function reinstall($request, $response, $args)
    {
        $table = $request->getAttribute('table');
        $response->getBody()->write("Reinstalling Database Table: $table");
        $tm = TaskManager::getInstance()->reinstall($table);
        return $response;
    }
}


// <?php

// namespace Core\Controllers;

// use Core\Tasks\TaskManager;
// use Core\Tasks\Table;

// class InstallerController extends Controller{
    
//     private $messages = [
//         "installAll" => "Installing Database Tables\n",
//         "reinstallAll" => "Reinstalling Database Tables\n",
//         "uninstallAll" => "Uninstalling Database Tables\n",
//         "installTable" => "Installing Database Table: %s",
//         "reinstallTable" => "Reinstalling Database Table: %s",
//         "uninstallTable" => "Uninstalling Database Table: %s"
//     ];
//     private function createResponse($name, $table)
//     {
//         return $table ? sprintf($this->messages[$name], $table) : $this->messages[$name];
//     }

//     function __call($name, $args){
//         $request = $args[0];
//         $response = $args[1];
//         // echo "<pre>";
//         // var_dump($request);
//         // echo "</pre>";
//         // die();
//         $r = new $request;
//         $table = $r->getArgument('table');
//         $response->getBody()->write($this->createResponse($name, $table));
//         $tm = TaskManager::getInstance();
//         // var_dump($tm);
//         return $response;
//     }

//     public static function __callStatic($name, $args){
//         $request = array_shift($args);
//         $response = array_shift($args);
//         $table = $request->getArgument('table');
//         $response->getBody()->write($this->createResponse($name, $table));
//         $tm = TaskManager::getInstance();
//         // var_dump($tm);
//         return $response;
//     }   
// }