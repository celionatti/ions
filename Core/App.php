<?php

declare(strict_types=1);

namespace Ions\Core;

use Ions\Core\Container\DI;
use Ions\Core\Container\Container;
use Ions\Core\Container\ContainerInterface;

/**
 * =========================
 * Ions App Class ==========
 * =========================
 */

class App
{
    private $container;
    private $route;
    private $minVersion;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }
    
    public function getRoute()
    {
        return $this->route;
    }
    
    public function run()
    {
        echo "Running App";
        echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';
    }

    // Other methods and application logic...

}
