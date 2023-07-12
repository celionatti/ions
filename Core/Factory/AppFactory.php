<?php

declare(strict_types=1);

namespace Ions\Core\Factory;

use Exception;
use Ions\Core\App;
use Ions\Core\Http\Router;
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
 
     public static function bind($abstract, $concrete)
     {
         if (self::$container) {
             self::$container->bind($abstract, $concrete);
         }
     }
 
     public static function create()
     {
         if (self::$container) {
             $app = self::$container->make(App::class);

            return $app;
         }
         throw new Exception("Container not set");
     }
 }
 
