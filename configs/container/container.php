<?php

declare(strict_types=1);

use Ions\Core\Container\Container;


/**
 * ============================
 * 
 * ContainerBuilder ===========
 * 
 * ============================
 */

$containerBuilder = new Container();

$containerBuilder->addDefinitionsFromFile(__DIR__ . '/container_bindings.php');

return $containerBuilder;
