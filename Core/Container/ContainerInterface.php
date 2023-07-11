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
    public function bind($abstract, $concrete);

    public function make($abstract);
    
    public function get($abstract);
    
    // Additional methods for registration, resolution, etc.
}