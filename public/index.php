<?php

declare(strict_types=1);

use Slim\App;


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
