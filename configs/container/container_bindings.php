<?php

declare(strict_types=1);

use Ions\Core\App;
use Ions\Core\Config;
use Ions\Core\Factory\AppFactory;
use Ions\Core\Container\ContainerInterface;
use Ions\Core\Http\Router;

return [
    App::class                              => function (ContainerInterface $container) {
        $container->bind(App::class, App::class);
        $container->bind(Router::class, Router::class);
        // $container->bind(Router::class, function (ContainerInterface $container) {
        //     return new Router();
        // });

        AppFactory::setContainer($container);

        $addMiddlewares = require CONFIG_PATH . '/middleware.php';
        $router         = require ROUTE_PATH . '/web.php';

        $app = AppFactory::create();

        $app->setContainer($container);

        $router($app);
        
        $addMiddlewares($app);

        return $app;
    },
    Config::class                           => function () {
        return require CONFIG_PATH . '/app.php';
    },
    // Router::class                           => function (ContainerInterface $container) {
    //     $container->bind(Router::class, Router::class);
    // },
];