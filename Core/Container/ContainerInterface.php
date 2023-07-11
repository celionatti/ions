<?php

declare(strict_types=1);

namespace Ions\Core\Container;

/**
 * ========================
 * ContainerInterface =====
 * ========================
 */

 interface ContainerInterface
{
    public function bind($abstract, $concrete = null);

    public function make($abstract, $parameters = []);

    public function singleton($abstract, $concrete = null);
    
    // Additional methods for registration, resolution, etc.
}