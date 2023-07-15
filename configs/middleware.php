<?php

declare(strict_types=1);

use Slim\App;
use Ions\Core\Config;
use Slim\Middleware\MethodOverrideMiddleware;

/**
 * =============================
 * MiddleWare Def ==============
 * =============================
 */


return function (App $app) {
    $container = $app->getContainer();
    $config    = $container->get(Config::class);

    $app->add(MethodOverrideMiddleware::class);

    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware(
        (bool) $config->get('display_error_details'),
        (bool) $config->get('log_errors'),
        (bool) $config->get('log_error_details')
    );
};