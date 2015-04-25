<?php

use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

try {
    
    // Autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs([
        '../app/controllers/',
        '../app/models'
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
    
    // Session
    $di->setShared('session', function() {
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    });
    
    // Meta-Data
    /*$di['modelsMetadata'] = function() {
      
        $metaData = new \Phalcon\Mvc\Model\MetaData\Apc([
           "lifetime" => 86400,
            "prefix"  => "metaData"
        ]);
        return $metaData;
        
    };*/
    
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