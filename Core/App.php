<?php

declare(strict_types=1);

namespace Ions\Core;


use Ions\Core\Http\Router;
use Ions\Core\Http\Request;
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
    private $minVersion;

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

    public function get(string $path, $controller)
    {
        $this->router->addRoute('GET', $path, $controller);
    }

    public function post(string $path, $controller)
    {
        $this->router->addRoute('POST', $path, $controller);
    }

    public function delete(string $path, $controller)
    {
        $this->router->addRoute('DELETE', $path, $controller);
    }

    public function run()
    {
        $this->router->handleRequest(new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']));
    }
}
