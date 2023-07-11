<?php

declare(strict_types=1);

namespace Ions\Core\Factory;

use Ions\Core\App;
use Ions\Core\Container\ContainerInterface;

/**
 * ========================
 * AppFactory =============
 * ========================
 */

class AppFactory
{
    private static $container;

    public static function setContainer(ContainerInterface $container)
    {
        self::$container = $container;
    }

    public static function bind($abstract, $concrete = null)
    {
        if (self::$container) {
            self::$container->bind($abstract, $concrete);
        }
    }

    public static function create()
    {
        // Instantiate and configure your application
        $app = new App();

        // Set the container if available
        if (self::$container) {
            $app->setContainer(self::$container);
        }

        // Perform any additional configuration or setup here

        return $app;
    }
}
