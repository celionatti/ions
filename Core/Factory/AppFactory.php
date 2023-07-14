<?php

declare(strict_types=1);

namespace Ions\Core\Factory;

use Exception;
use Ions\Core\App;
use Ions\Core\Http\Router;
use Ions\Core\Container\ContainerInterface;
use Ions\Core\Exception\BaseException;

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

     public function getContainer()
    {
        return $this->container;
    }
 
     public static function bind($abstract, $concrete)
     {
         if (self::$container) {
             self::$container->bind($abstract, $concrete);
         }
     }
 
     public static function create(): App
     {
         if (self::$container) {
             $app = self::$container->make(App::class);

             // Instantiate the Router
            $router = self::$container->make(Router::class);
            $app->setRouter($router);

            return $app;
         }
         throw new BaseException("Container not set");
     }
 }
 
