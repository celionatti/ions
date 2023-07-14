<?php

declare(strict_types=1);

namespace Ions\Core;


use Ions\Core\Http\Router;
use Ions\Core\Http\Request;
use Ions\Core\Http\Response;
use Ions\Core\Container\ContainerInterface;

/**
 * =========================
 * Ions App Class ==========
 * =========================
 */

class App
{
    private $container;
    private $route;
    private $router;
    // private $minVersion;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setRouter(Router $router)
    {
        $this->router = $router;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function run()
    {
        $request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
        $response = new Response();
        $this->router->handleRequest($request, $response);
    }
}
