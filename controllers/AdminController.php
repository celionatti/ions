<?php

declare(strict_types=1);

namespace Ions\controllers;

use Ions\Core\Http\Request;
use Ions\Core\Http\Response;

/**
 * =========================
 * ==== Site Controllers ===
 * =========================
 */

 class AdminController
 {
    public function dashboard(Request $request, Response $response)
    {
        print_r($request->getAllParams());
    }
 }