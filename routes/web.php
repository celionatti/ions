<?php

declare(strict_types=1);

use Ions\Core\App;

/**
 * ==========================
 * Route Web Def ============
 * ==========================
 */

 return function (App $app) {
    $router = $app->getContainer()->get(Router::class);
    print_r($router);
    die;

    $router->addRoute('GET', '/', function (Request $request) {
        // Handle the home route
        echo "Home Route";
    });

    $router->addRoute('GET', '/about', function (Request $request) {
        // Handle the about route
    });

    // Other routes...
 };