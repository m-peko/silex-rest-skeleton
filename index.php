<?php

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SerializerServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;;

$baseDir = __DIR__;

require $baseDir.'/vendor/autoload.php';

ini_set('display_errors', 0);
/* Report all errors */
error_reporting(-1);

ErrorHandler::register();
ExceptionHandler::register();

$app = new Application();

$app->error(function (Exception $e) use ($app) {
    return new Response("Something went wrong: ".$e->getMessage());
});

$app->register(new ServiceControllerServiceProvider());
$app->register(new SerializerServiceProvider());

$app->register(
    new DoctrineServiceProvider(),
    [
        'db.options' => [
            'driver'        => 'pdo_mysql',
            'host'          => 'localhost',
            'dbname'        => 'rest',
            'user'          => 'root',
            'password'      => '',
            'charset'       => 'utf8',
            'driverOptions' => [
                1002 => 'SET NAMES utf8'
            ]
        ]
    ]
);

$app->register(
    new DoctrineOrmServiceProvider(),
    [
        'orm.proxies_dir'             => 'src/App/Entity/Proxy',
        'orm.auto_generate_proxies'   => $app['debug'],
        'orm.em.options'              => [
            'mappings' => [
                [
                    'type'                         => 'annotation',
                    'namespace'                    => 'Entity\\',
                    'path'                         => 'src/App/Entity',
                    'use_simple_annotation_reader' => false
                ]
            ]
        ]
    ]
);

/* Load services */
$servicesLoader = new App\ServicesLoader($app);
$servicesLoader->bindServicesIntoContainer();

/* Load routes */
$routesLoader = new App\RoutesLoader($app);
$routesLoader->bindRoutesToControllers();

$app->run();
