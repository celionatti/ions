<?php

declare(strict_types=1);

namespace Ions\Core\Factory;

use Exception;
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
 
     public static function bind($abstract, $concrete)
     {
         if (self::$container) {
             self::$container->bind($abstract, $concrete);
         }
     }
 
     public static function create()
     {
         if (self::$container) {
             return self::$container->make(App::class);
         }
         throw new Exception("Container not set");
     }
 }
 
