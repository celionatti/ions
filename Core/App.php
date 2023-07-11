<?php

declare(strict_types=1);

namespace Ions\Core;

use Ions\Core\Container\ContainerInterface;

/**
 * =========================
 * Ions App Class ==========
 * =========================
 */

class App
{
    private $container;

    // public function setContainer(ContainerInterface $container)
    // {
    //     $this->container = $container;
    // }

    // public function getContainer()
    // {
    //     return $this->container;
    // }

    // public function resolveDependency($abstract)
    // {
    //     if ($this->container) {
    //         return $this->container->make($abstract);
    //     }

    //     // Handle cases where container is not set

    //     return null;
    // }

    // // Other methods and application logic...

    // Create the container
$container = new Container();

// Bind dependencies using the container
$container->bind(App::class, AppFactory::class);
$container->bind(Config::class, DI::create(Config::class)->constructor(
    require CONFIG_PATH . '/app.php'
));

$container->bind(ResponseFactoryInterface::class, function (App $app) {
    return $app->getResponseFactory();
});

$container->bind(RouteParserInterface::class, function (App $app) {
    return $app->getRouteCollector()->getRouteParser();
});

// Retrieve the application instance from the container
$app = $container->make(App::class);
}
