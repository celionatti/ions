<?php

class Route
{
    private $method;
    private $pattern;
    private $handler;
    private $middlewares = [];

    public function __construct($method, $pattern, $handler)
    {
        $this->method = $method;
        $this->pattern = $pattern;
        $this->handler = $handler;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function addMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}


class Route2
{
    private $method;
    private $pattern;
    private $handler;
    private $middlewares = [];

    public function __construct($method, $pattern, $handler)
    {
        $this->method = $method;
        $this->pattern = $pattern;
        $this->handler = $handler;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function addMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    public function group($pattern, $callback)
    {
        $groupPattern = $this->pattern . $pattern;

        $route = new self($this->method, $groupPattern, $this->handler);

        if (is_callable($callback)) {
            $callback($route);
        }

        return $route;
    }
}

// Create a new route
$route = new Route2('GET', '/hello', function (Request $request, Response $response) {
    $response->withBody('Hello, World!');
});

// Define a route group
$route->group('/api', function (Route $route) {
    // Add routes specific to the group
    $route->add('GET', '/users', function (Request $request, Response $response) {
        $response->withBody('API Users');
    });

    $route->add('POST', '/users', function (Request $request, Response $response) {
        $response->withBody('Create API User');
    });
});

// Define middleware for the route group
$route->group('/api', function (Route $route) {
    $route->addMiddleware(function (Request $request, Response $response, $next) {
        // Perform middleware logic for the group
        $response->withHeader('X-API-Version', '1.0');
        $next($request, $response);
    });
});

