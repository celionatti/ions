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
    public static function create($className, $parameters = [])
    {
        $container = new Container();
        return $container->build($className, $parameters);
    }
}
