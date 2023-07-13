<?php

declare(strict_types=1);

use Ions\Core\App;

/**
 * ==========================
 * Route Web Def ============
 * ==========================
 */

 return function (App $app) {
    $app->get('/', function (Request $request) {
        // Handle the home route
        echo "<pre>";
        print_r($_SERVER);
        die;
    });
 };