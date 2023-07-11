<?php

declare(strict_types=1);

namespace Ions\Core\Container;


/**
 * ========================
 * DI =====================
 * ========================
 */


class DI
{
    // public static function create($className, $parameters = [])
    // {
    //     $container = new Container();
    //     return $container->build($className, $parameters);
    // }

    // public function constructor($className)
    // {
    //     return new $className();
    // }

    private $className;
    private $parameters = [];

    private function __construct($className)
    {
        $this->className = $className;
    }

    public static function create($className)
    {
        return new DI($className);
    }

    public function constructor(...$parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    // public function build()
    // {
    //     $container = new Container();
    //     return $container->build($this->className, $this->parameters);
    // }
}
