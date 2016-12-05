<?php

// Class Curried{
// 	function __construct($fn){
// 		$this->fn = $fn;
// 	}
// 	function __invoke(){
// 		return is_callable($this->fn) ? new Curried(call_user_func($this->fn, func_get_args())) : $this->fn;
// 	}
// 	public function _(){		
// 		return is_callable($this->fn) ? new Curried(call_user_func($this->fn, func_get_args())) : $this;
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

\Core\Containers\Environment::setGlobal('siteUrl', '/');
// \Core\Containers\Environment::setGlobal('404-template', '404');
\Core\Containers\Environment::setGlobal('colors', ['default', 'yellow', 'orange', 'red', 'violet', 'green', 'cyan', 'blue']);
\Core\Containers\Environment::setGlobal('levels', ['Beginner', 'Intermediate', 'Advanced']);

$install = new \Core\Install\CoreInstaller; // create the Core install tasks

$container['InstallerController'] = function ($container) {
    return new \Core\Controllers\InstallerController($container);
};

$container['auth'] = function ($container) {
    return new \Core\Authentication\Auth;
};

\Core\Containers\Environment::setGlobal(
    'auth', 
    [
        'signed' => $container->auth->signed(),
        'user' => $container->auth->user()
    ]
);

$container['validator'] = function ($container) {
    return new \Core\Validation\Validator;
};
$container['UserController'] = function ($container) {
    return new \Core\Controllers\UserController($container);
};
$container['AuthController'] = function ($container) {
    return new \Core\Controllers\AuthController($container);
};
$container['AdminController'] = function ($container) {
    return new \Core\Controllers\AdminController($container);
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

$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
};

$app->add(new \Core\Middleware\CsrfMiddleware($container));

$app->add($container->csrf);


v::with('Core\\Validation\\Rules\\');

require __DIR__ . '/../core/routes.php';