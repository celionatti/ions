<?php

declare(strict_types=1);

use Dotenv\Dotenv;


/**
 * ===================================
 * ===================================
 * Ions Container Loader and =========
 * starter file. =====================
 * ===================================
 * ===================================
 */

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require __DIR__ . DIRECTORY_SEPARATOR .'configs' . DIRECTORY_SEPARATOR . 'path_constants.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


return require CONFIG_PATH . DIR_SEPARATOR . 'container' . DIR_SEPARATOR . 'container.php';