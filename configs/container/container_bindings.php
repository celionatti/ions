<?php

declare(strict_types=1);

use Slim\App;
use Ions\Core\Config;
use Ions\Core\Container\DI;
use Slim\Factory\AppFactory;
use Psr\Container\ContainerInterface;
use Ions\Core\RouteEntityBindingStrategy;


return [
    App::class                              => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        $addMiddlewares = require CONFIG_PATH . '/middleware.php';
        // $router         = require ROUTE_PATH . '/web.php';

        $app = AppFactory::create();

        // $app->getRouteCollector()->setDefaultInvocationStrategy(
        //     new RouteEntityBindingStrategy(
        //         // $container->get(EntityManagerServiceInterface::class),
        //         $app->getResponseFactory()
        //     )
        // );

        // $router($app);

        $addMiddlewares($app);

        return $app;
    },
    Config::class                           => DI::create(Config::class)->constructor(
        require CONFIG_PATH . '/app.php'
    ),
    ResponseFactoryInterface::class         => fn (App $app) => $app->getResponseFactory(),
    RouteParserInterface::class             => fn (App $app) => $app->getRouteCollector()->getRouteParser(),
];