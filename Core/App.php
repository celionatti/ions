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

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }
    
    public function run()
    {
        echo "Running App";
    }

    // Other methods and application logic...

}
