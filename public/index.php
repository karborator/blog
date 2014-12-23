<?php

use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;

error_reporting(E_ERROR);
ini_set('display_errors', 1);

ini_set('max_execution_time', 60);

/*
 * Load config file
 */
$config = require '../config/config.php';

/*
 * Read Routes
 */
$routes = require '../config/routes.php';

/*
 * Read Modules
 */
$modules = require '../config/modules.php';

/* * *************************************************** */

$di = new FactoryDefault ();

/*
 * Specify routes for modules
 */
$di->set('router', $routes);

$db = new Phalcon\Db\Adapter\Pdo\Mysql($config['database']);

$di->set('db', $db);

$di->setShared('session', function() {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
});

//Set up the flash service
$di->set('flashSession', function() {
    return new Phalcon\Flash\Session();
});


try {
    // Create an application
    $application = new Application($di);

    /*
     * Register the installed modules
     */
    $application->registerModules($modules);

    // Handle the request
    echo $application->handle()->getContent();
} catch (\Exception $e) {
    echo $e->getMessage();
}
