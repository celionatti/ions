<?php

declare(strict_types=1);

namespace Ions\controllers;

use Ions\Core\Http\Request;

/**
 * =========================
 * ==== Site Controllers ===
 * =========================
 */

 class SiteController
 {
    public function index(Request $request)
    {
        echo '<pre>';
        var_dump($request);
        echo '</pre>';
    }
 }