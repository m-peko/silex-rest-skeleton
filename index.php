<?php

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$baseDir = __DIR__;

require $baseDir.'/vendor/autoload.php';

$app = new Application();

$app->error(function (Exception $e) use ($app) {
    return new Response("Something went wrong: ".$e->getMessage());
});

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

$app->get('/', function(Application $app, Request $request) {
    $user = new Entity\User("Marin", "Peko", "xyz@xyz.com", "xyz", "xyz");

    $em = $app['orm.em'];
    $em->persist($user);
    $em->flush();

    return new Response("Success");
});

$app->get('/users/{id}', function(Application $app, Request $request, $id) {
    $em = $app['orm.em'];
    $user = $em->getRepository('Entity\User')->find($app->escape($id));

    return new Response($user->getFirstName());
});

$app->run();
