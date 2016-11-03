<?php

// Class Curried{
// 	function __construct($fn){
// 		$this->fn = $fn;
// 	}
// 	function __invoke(){
// 		return is_callable($this->fn) ? new Curried(call_user_func($this->fn, func_get_args())) : $this->fn;
// 	}
// 	public function _(){		
// 		return is_callable($this->fn) ? new Curried(call_user_func($this->fn, func_get_args())) : new Curried($this->fn);
// 	}
// }
// $e = (new Curried(function(){return 1;}))->_(1)->_(1)->_(1);
// echo $e();
// die();

use Respect\Validation\Validator as v;
session_start();

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/config.php';

$app = new \Slim\App($settings);

$container = $app->getContainer();
$container['view'] = function ($c) {
    $mustache = new \Slim\Mustache\Mustache(
        '../resources/views', // Template path
        array('charset' => 'UTF-8'), array('extension' => '.html')
    );
    return $mustache;
};

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

\Core\Options\OptionManager::setOption('siteUrl', '/');
// \Core\Options\OptionManager::setOption('404-template', '404');
\Core\Options\OptionManager::setOption('colors', ['default', 'yellow', 'orange', 'red', 'violet', 'green', 'cyan', 'blue']);
\Core\Options\OptionManager::setOption('levels', ['Beginner', 'Intermediate', 'Advanced']);

$install = new \Core\Install\CoreInstaller; // create the Core install tasks

$container['InstallerController'] = function ($container) {
    return new \Core\Controllers\InstallerController($container);
};

$container['validator'] = function ($container) {
    return new \Core\Validation\Validator;
};
$container['AuthController'] = function ($container) {
    return new \Core\Controllers\AuthController($container);
};
$container['HomeController'] = function ($container) {
    return new \Core\Controllers\HomeController($container);
};
$container['CourseController'] = function ($container) {
    return new \Core\Controllers\CourseController($container);
};

$container['LecturerController'] = function ($container) {
    return new \Core\Controllers\LecturerController($container);
};

$container['LessionController'] = function ($container) {
    return new \Core\Controllers\LessionController($container);
};

v::with('Core\\Validation\\Rules\\');

require __DIR__ . '/../core/routes.php';