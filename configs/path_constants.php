<?php

declare(strict_types=1);

/**
 * ==============================
 * ==============================
 * All Path constants ===========
 * definitions. =================
 * ==============================
 * ==============================
 */

const DIR_SEPARATOR     = DIRECTORY_SEPARATOR;
const CORE_PATH         = __DIR__ . '/..';
const VIEW_PATH         = __DIR__ . '/../resources/views';
const STORAGE_PATH      = __DIR__ . '/../storage';
const CONFIG_PATH       = __DIR__ . DIR_SEPARATOR . '..' . DIR_SEPARATOR . 'configs';
const PLUGINS_PATH      = __DIR__ . DIR_SEPARATOR . '..' . DIR_SEPARATOR . 'plugins';
const BUILD_PATH        = __DIR__ . '/../public/build';
const ROUTE_PATH        = __DIR__ . '/../routes';
