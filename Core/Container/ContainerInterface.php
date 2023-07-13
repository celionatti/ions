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
    public function bind(string $abstract, $concrete):void;

    public function make(string $abstract);
    
    public function get(string $abstract);
    
    // Additional methods for registration, resolution, etc.
}