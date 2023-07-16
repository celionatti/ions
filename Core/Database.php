<?php

declare(strict_types=1);

namespace Ions\Core;

use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;


/**
 * ============================
 * Ions Database ==============
 * ============================
 */

 class Database
 {
    public function __construct(private readonly Container $container)
    {

    }

    public function configure(array $config)
    {
        $capsule = new Capsule;

        $capsule->addConnection($config);
        $capsule->setEventDispatcher(new Dispatcher($this->container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
 }