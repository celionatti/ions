<?php


// Create a new route
$route = new Route('GET', '/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getQueryParam('name');
    $response->withBody("Hello, $name!");
});

// Add a middleware to the route
$route->addMiddleware(function (Request $request, Response $response, $next) {
    // Perform middleware logic
    // Call the next middleware or handler
    $next($request, $response);
});

// Create a new request
$request = new Request(
    'GET',
    '/hello/world',
    ['Content-Type' => 'application/json'],
    ['name' => 'world'],
    []
);

// Resolve the route and execute the handler
if ($route->getMethod() === $request->getMethod() && preg_match($route->getPattern(), $request->getUri(), $matches)) {
    $request->setParams($matches);
    $response = new Response();
    $middlewares = $route->getMiddlewares();
    $middlewareStack = createMiddlewareStack($middlewares, $route->getHandler(), $response);
    handleRequest($request, $response, $middlewareStack);
    sendResponse($response);
} else {
    // Handle 404 Not Found
}

function createMiddlewareStack($middlewares, $handler, $response)
{
    $next = function (Request $request, Response $response) use ($handler) {
        $handler($request, $response);
    };

    for ($i = count($middlewares) - 1; $i >= 0; $i--) {
        $current = $middlewares[$i];
        $next = function (Request $request, Response $response) use ($current, $next) {
            $current($request, $response, $next);
        };
    }

    return $next;
}

function handleRequest(Request $request, Response $response, $middlewareStack)
{
    $middlewareStack($request, $response);
}

function sendResponse(Response $response)
{
    http_response_code($response->getStatusCode());
    foreach ($response->getHeaders() as $name => $value) {
        header("$name: $value");
    }
    echo $response->getBody();
}
