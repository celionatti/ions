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
 
     public function addRoute($method, $path, $controller)
     {
         $this->routes[] = [
             'method' => $method,
             'path' => $path,
             'controller' => $controller,
         ];
     }
 
     public function group($prefix, $callback)
     {
         $previousGroupCount = count($this->routes);
         $callback($this);
         $groupRoutes = array_slice($this->routes, $previousGroupCount);
 
         foreach ($groupRoutes as &$route) {
             $route['path'] = $prefix . $route['path'];
         }
         unset($route);
     }
 
     public function handleRequest(Request $request)
     {
         $method = $request->getMethod();
         $path = $request->getPath();
 
         foreach ($this->routes as $route) {
             if ($route['method'] === $method && preg_match($this->patternToRegex($route['path']), $path, $matches)) {
                 array_shift($matches); // Remove the full match from the beginning
                 $handler = $route['controller'];
                 $parameters = $matches;
 
                 // Call the handler with the request object and parameters
                 if (is_string($handler)) {
                     // If the handler is a string, assume it's a controller class and action method
                     list($controller, $action) = explode('@', $handler);
                     $controllerInstance = $this->resolveController($controller);
                     if (is_callable([$controllerInstance, $action])) {
                         return $controllerInstance->$action($request, ...$parameters);
                     }
                 } elseif (is_callable($handler)) {
                     // If the handler is callable, directly call it
                     return $handler($request, ...$parameters);
                 }
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
 
 
