<?php

declare(strict_types=1);

namespace Ions\Core\Http;

/**
 * ==========================
 * Router Class =============
 * ==========================
 */

class Router
{
    private $routes = [];

    public function addRoute(string $method, string $path, $controller): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
        ];
    }

    public function group(string $prefix, $callback): void
    {
        $previousGroupCount = count($this->routes);
        $callback($this);
        $groupRoutes = array_slice($this->routes, $previousGroupCount);

        foreach ($groupRoutes as &$route) {
            $route['path'] = $prefix . $route['path'];
        }
        unset($route);
    }

    public function handleRequest(Request $request, Response $response)
    {
        $method = $request->getMethod();
        $path = $request->getPath();

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($this->patternToRegex($route['path']), $path, $matches)) {
                array_shift($matches); // Remove the full match from the beginning
                $handler = $route['controller'];
                $parameters = $matches;

                if (is_string($handler)) {
                    list($controller, $action) = explode('@', $handler);
                    $handler = 'Ions\\controllers\\' . $controller; // Update with your actual namespace
                    if (class_exists($handler)) {
                        $handler = new $handler();
                        $handler->action = $action;
                        // Handle the controller instance
                    }
                }

                if (is_array($handler)) {
                    $controllerInstance = new $handler[0]();
                    $controllerInstance->action = $handler[1];
                    $handler[0] = $controllerInstance;
                }
                return $handler($request, $response, ...$parameters);
                // return call_user_func($handler, $request, $response, [...$parameters]);

            }
        }

        // No matching route found
        return $this->notFoundResponse();
    }

    private function resolveController($controller)
    {
        // Instantiate the controller using your container or any other mechanism
        return new $controller();
    }

    private function patternToRegex($pattern)
    {
        $regex = preg_replace('#{([a-zA-Z0-9_]+)}#', '(?P<$1>[a-zA-Z0-9_]+)', $pattern);
        return "#^" . $regex . "$#";
    }

    private function notFoundResponse()
    {
        // You can customize the response for a 404 not found error here
        return new Response('404 Not Found', 404);
    }
}
