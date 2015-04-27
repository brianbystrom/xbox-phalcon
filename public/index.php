<?php

use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Flash\Direct as FlashDirect;

try {
    
    // Autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs([
        '../app/controllers/',
        '../app/models',
        '../app/config'
    ]);
    $loader->register();
    
    // Dependency Injection
    $di = new \Phalcon\DI\FactoryDefault();

    // Setup the database service
    $di->set('db', function(){
        return new DbAdapter(array(
            "host"     => "localhost",
            "username" => "root",
            "password" => "",
            "dbname"   => "xbox"
        ));
    });

    // Set up volt engine
    $di->set('view', function() { 
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views');
        $view->registerEngines([
            ".volt" => 'Phalcon\Mvc\View\Engine\Volt'
        ]);
        return $view;
    });

    $di->set('router', function() {
        $router = new \Phalcon\Mvc\Router();
        $router->mount(new GlobalRoutes());
        return $router;
    });
    
    // Session
    $di->setShared('session', function() {
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    });

    // Custom Dispatcher (overrides the default)
    $di->set('dispatcher', function() use ($di) {
        $eventsManager = $di->getShared('eventsManager');

        // Custom ACL Class
        $permission = new Permission();

        // Listen for events from the persmission class
        $eventsManager->attach('dispatch', $permission);
        
        $dispatcher = new \Phalcon\Mvc\Dispatcher();
        $dispatcher->setEventsManager($eventsManager);
        return $dispatcher;

    });
    
    // Flash Data (Temp Data)
    $di->set('flash', function() {
        $flash = new \Phalcon\Flash\Session([
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning',
        ]);
        return $flash;
    });
    
    // Directs where the url starts from.
    $di->set('url', function(){
        $url = new UrlProvider();
        $url->setBaseUri('/xbox/public/');
        return $url;
    });
    
    
    
    // Deploy the app
    $app = new \Phalcon\Mvc\Application($di);
    echo $app->handle()->getContent();
    
    
} catch(\Phalcon\Exception $e) {
     echo $e->getMessage();
}