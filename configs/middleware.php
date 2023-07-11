<?php

declare(strict_types=1);

use Ions\Core\App;
use Ions\Core\Config;

/**
 * =============================
 * MiddleWare Def ==============
 * =============================
 */


return function (App $app) {
    $container = $app->getContainer();
    $config    = $container->get(Config::class);
};