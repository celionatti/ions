<?php

declare(strict_types=1);

use Ions\Core\Enum\AppEnvironment;

$appEnv       = $_ENV['APP_ENV'] ?? AppEnvironment::Production->value;
$appSnakeName = strtolower(str_replace(' ', '_', $_ENV['APP_NAME']));

return [
    'app_key'               => $_ENV['APP_KEY'] ?? '',
    'app_name'              => $_ENV['APP_NAME'],
    'app_version'           => $_ENV['APP_VERSION'] ?? '1.0.0',
    'php_version'           => $_ENV['PHP_VERSION'] ?? '7.4',
    'app_url'               => $_ENV['APP_URL'],
    'app_environment'       => $appEnv,
    'display_error_details' => (bool) ($_ENV['APP_DEBUG'] ?? 0),
    'log_errors'            => true,
    'log_error_details'     => true,
    'session'               => [
        'name'       => $appSnakeName . '_session',
        'flash_name' => $appSnakeName . '_flash',
        'secure'     => true,
        'httponly'   => true,
        'samesite'   => 'lax',
    ],
];