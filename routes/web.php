<?php

declare(strict_types=1);

use Ions\Core\App;
use Ions\Core\Http\Router;
use Ions\Core\Http\Request;
use Ions\controllers\SiteController;

/**
 * ==========================
 * Route Web Def ============
 * ==========================
 */

 return function (App $app) {
    $router = $app->getRouter();

    $router->addRoute('GET', '/', function (Request $request) {
        // Handle the home route
        echo "<pre>";
        print_r($request);
        die;
    });

    $router->group('/api', function (Request $request) {
        $request->get('/users', 'UserController@index');
        $router->post('/users', 'UserController@store');
    });

    // $router->get('/users', [SiteController::class, '@index']);
 };