<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\Twig;
use Ions\Core\Config;
use function DI\create;
use Slim\Factory\AppFactory;
use Ions\Core\Enum\AppEnvironment;
use Twig\Extra\Intl\IntlExtension;
use Psr\Container\ContainerInterface;
use Ions\Core\RouteEntityBindingStrategy;
use Slim\Interfaces\RouteParserInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Ions\Core\Contracts\EntityManagerServiceInterface;
use Ions\Core\Twig\AssetExtension;

return [
    App::class                              => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        $addMiddlewares = require CONFIG_PATH . '/middleware.php';
        $router         = require ROUTE_PATH . '/web.php';

        $app = AppFactory::create();

        $app->getRouteCollector()->setDefaultInvocationStrategy(
            new RouteEntityBindingStrategy(
                // $container->get(EntityManagerServiceInterface::class),
                $app->getResponseFactory()
            )
        );

        $router($app);

        $addMiddlewares($app);

        return $app;
    },
    Config::class                           => create(Config::class)->constructor(
        require CONFIG_PATH . '/app.php'
    ),
    Twig::class                             => function (Config $config, ContainerInterface $container) {
        $twig = Twig::create(VIEW_PATH, [
            'cache'       => false,
            // 'cache'       => STORAGE_PATH . '/cache/templates',
            'auto_reload' => AppEnvironment::isDevelopment($config->get('app_environment')),
        ]);

        $twig->addExtension(new IntlExtension());
        $twig->addExtension(new AssetExtension());

        return $twig;
    },
    ResponseFactoryInterface::class         => fn(App $app) => $app->getResponseFactory(),
    RouteParserInterface::class             => fn(App $app) => $app->getRouteCollector()->getRouteParser(),
];
