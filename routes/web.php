<?php

declare(strict_types=1);

use Ions\Core\App;
use Ions\controllers\SiteController;
use Ions\controllers\AdminController;

/**
 * ==========================
 * Route Web Def ============
 * ==========================
 */

return function (App $app) {
    $router = $app->getRouter();

    // $router->addRoute('GET', '/', function (Request $request) {
    //     return "Hello World";
    // });

    $router->addRoute('GET', '/', [SiteController::class, 'index']);
    $router->addRoute('GET', '/admin/{name}', [AdminController::class, 'dashboard']);

    // $router->group('', function (Request $group) {
    //     $group->get('/', [SiteController::class, 'index']);
    // });

    // $router->group('/api', function (Request $request) {
    //     $app->get('/users', 'UserController@index');
    //     $router->post('/users', 'UserController@store');
    // });

    $router->addRoute('GET', '/users/{name}', 'SiteController@index');
};
