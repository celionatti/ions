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
        $this->router = $this->container->get(Router::class);
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

    public function get(string $path, callable $controller)
    {
        $this->router->addRoute('GET', $path, $controller);
    }

    public function post(string $path, callable $controller)
    {
        $this->router->addRoute('POST', $path, $controller);
    }

    public function delete(string $path, callable $controller)
    {
        $this->router->addRoute('DELETE', $path, $controller);
    }

    public function run()
    {
        $router = $this->container->get(Router::class);
        // Instantiate the Request class
        $request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

        // Pass the request to the router for handling
        $router->handleRequest($request);
    }

}
