<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/setup.php';

// $settings = [
//     'settings' => [
//         'displayErrorDetails' => true,
//         'db' => [
//             'driver' => 'mysql',
//             'host' => 'localhost',
//             'database' => 'faculty',
//             'username' => 'root',
//             'password' => 'root',
//             'charset' => 'utf8',
//             'collation' => 'utf8_unicode_ci',
//             'prefix' => '',
//         ]
//     ]
// ];
// $settings =  Spyc::YAMLLoad(__DIR__ . '/../config/settings.yml');
// var_dump(new Spyc);

$app = new \Slim\App($settings);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$install = new \Core\Install\CoreInstaller;

$container['InstallerController'] = function ($container) {
    return new \Core\Controllers\InstallerController($container);
};
$container['UninstallerController'] = function ($container) {
    return new \Core\Controllers\UninstallerController($container);
};
$container['ReinstallerController'] = function ($container) {
    return new \Core\Controllers\ReinstallerController($container);
};

require __DIR__ . '/../core/routes.php';