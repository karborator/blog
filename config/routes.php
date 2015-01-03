<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->setDefaultModule("engine");
$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
$router->removeExtraSlashes(true);

// Routes defined here =========================================================

$router->add('/index', array(
    'module' => 'engine',
    'controller' => 'index',
    'action' => 'index'
))->via("GET");

$router->add('/about', array(
    'module' => 'engine',
    'controller' => 'index',
    'action' => 'about'
))->via("GET");

$router->add('/contact', array(
    'module' => 'engine',
    'controller' => 'index',
    'action' => 'contact'
))->via("GET");

$router->add('/authenticate', array(
    'module' => 'engine',
    'controller' => 'index',
    'action' => 'authenticate'
))->via(array("GET", "POST"));


$router->add('/admin', array(
    'module' => 'engine',
    'controller' => 'admin',
    'action' => 'index'
))->via(array("GET", "POST"));

$router->add('/admin/new-post', array(
    'module' => 'engine',
    'controller' => 'admin',
    'action' => 'post'
))->via(array("GET", "POST"));

$router->add('/admin/post/edit/{id}', array(
    'module' => 'engine',
    'controller' => 'admin',
    'action' => 'postedit'
))->via(array("GET", "POST"));

$router->add('/admin/post/delete/{id}', array(
    'module' => 'engine',
    'controller' => 'admin',
    'action' => 'postdelete'
))->via(array("GET"));

$router->add('/admin/sign-out', array(
    'module' => 'engine',
    'controller' => 'index',
    'action' => 'signout'
))->via(array("GET"));


$router->add('/sign-up', array(
    'module' => 'engine',
    'controller' => 'index',
    'action' => 'signup'
))->via(array("GET", "POST"));

/* Help Desk Tool */

$router->add('/admin/help-desk', array(
    'module' => 'engine',
    'controller' => 'help-desk',
    'action' => 'index'
))->via(array("GET", "POST"));

$router->add('/admin/new-issue', array(
    'module' => 'engine',
    'controller' => 'help-desk',
    'action' => 'issue'
))->via(array("GET", "POST"));

$router->add('/admin/issue/done/{id}', array(
    'module' => 'engine',
    'controller' => 'help-desk',
    'action' => 'issuedone'
))->via(array("GET"));

$router->add('/admin/issue/edit/{id}', array(
    'module' => 'engine',
    'controller' => 'help-desk',
    'action' => 'issueedit'
))->via(array("GET", "POST"));

return $router;
