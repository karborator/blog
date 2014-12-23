<?php

namespace Modules\Engine;

use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Manager as EventsManager;
use Modules\Engine\Plugins\Security as EngineSecurity;

class Module implements ModuleDefinitionInterface
{

    private $config;
    private $defaultNamespace;
    private $viewDir;

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders()
    {
        $this->loadConfig('engine');

        $loader = new Loader();

        $loader->registerNamespaces($this->config);

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices($di)
    {

        // Registering a dispatcher
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();

            //Create an EventsManager
            $eventsManager = new EventsManager();

            //Instantiate the Security plugin
            $searchSecurity = new EngineSecurity($di);

            //Listen for events produced in the dispatcher using the Security plugin
            $eventsManager->attach('dispatch:beforeDispatch', $searchSecurity);

            $dispatcher = new MvcDispatcher();

            $dispatcher->setDefaultNamespace($this->defaultNamespace);

            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });

        // Registering the view component
        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir($this->viewDir);
            return $view;
        });
    }

    private function loadConfig($moduleName)
    {
        if (empty($this->config)) {
            $config = require '../config/config.php';
            // store config array
            $this->config = $config[$moduleName];
            // store defaultNamespace
            foreach ($this->config as $key => $value) {
                $this->defaultNamespace = $key;
                break;
            }
            // store View Directory
            $this->viewDir = end($this->config);
        }
    }

}
