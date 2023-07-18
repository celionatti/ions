<?php

declare(strict_types=1);

use Ions\controllers\AdminController;
use Slim\App;
use Ions\Controllers\SiteController;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * ==========================
 * Route Web Def ============
 * ==========================
 */

return function (App $app) {
    $app->group('', function (RouteCollectorProxy $group){
        $group->get('/', [SiteController::class, 'index']);
        $group->get('/blog', [SiteController::class, 'blog']);
        $group->get('/contact', [SiteController::class, 'contact']);
    });

    $app->group('/admin', function (RouteCollectorProxy $admin){
        $admin->get('', [AdminController::class, 'dashboard']);
    });
};
