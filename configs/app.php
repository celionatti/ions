<?php

declare(strict_types=1);

use Ions\Core\Enum\AppEnvironment;

$appEnv       = $_ENV['APP_ENV'] ?? AppEnvironment::Production->value;
$appSnakeName = strtolower(str_replace(' ', '_', $_ENV['APP_NAME']));