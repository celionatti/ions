<?php

declare(strict_types=1);

use Ions\Core\App;


/**
 * ===================================
 * ===================================
 * 
 * 
 * ===================================
 * ===================================
 */

$container = require __DIR__ . '/../bootstrap.php';

$container->make(App::class)->run();
