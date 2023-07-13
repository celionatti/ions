<?php

declare(strict_types=1);

namespace Ions\controllers;

/**
 * =========================
 * ==== Site Controllers ===
 * =========================
 */

 class SiteController
 {
    public function index()
    {
        echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';
    }
 }