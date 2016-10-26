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

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/config.php';

$app = new \Slim\App($settings);

$container = $app->getContainer();
$container['view'] = function ($c) {
    $mustache = new \Slim\Mustache\Mustache(
        '../resources/views', // Template path
        array('charset' => 'UTF-8'), array('extension' => '.html')
    );
 //    $mustache->addHelper('arr', [
	//     'index' => function($arr) { 
	//     	$output = [];
	//     	foreach ($arr as $k => $v) {
	//     		$output[] = ['index' => $k, 'value' => $v];
	//     	}
	//     	return $output;
	//     },
	//     'json' => function($arr){
	//     	return json_encode($arr);
	//     }
	// ]);
    return $mustache;
};

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

\Core\Options\OptionManager::setOption('siteUrl', '/');
\Core\Options\OptionManager::setOption('colors', ['default', 'yellow', 'orange', 'red', 'violet', 'green', 'cyan', 'blue']);
\Core\Options\OptionManager::setOption('levels', ['Beginner', 'Intermediate', 'Advanced']);

$install = new \Core\Install\CoreInstaller; // create the Core install tasks

$container['InstallerController'] = function ($container) {
    return new \Core\Controllers\InstallerController($container);
};

// $container['OptionsController'] = function ($container) {
//     return new \Core\Controllers\OptionsController($container);
// };

$container['validator'] = function ($container) {
    return new \Core\Validation\Validator;
};
$container['HomeController'] = function ($container) {
    return new \Core\Controllers\HomeController($container);
};
$container['CourseController'] = function ($container) {
    return new \Core\Controllers\CourseController($container);
};

require __DIR__ . '/../core/routes.php';