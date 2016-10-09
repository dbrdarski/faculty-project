<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/config.php';

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

require __DIR__ . '/../core/routes.php';