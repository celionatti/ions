<?php

class Request
{
    private $method;
    private $uri;
    private $headers;
    private $queryParams;
    private $bodyParams;

    public function __construct($method, $uri, $headers, $queryParams, $bodyParams)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->queryParams = $queryParams;
        $this->bodyParams = $bodyParams;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getQueryParam($name)
    {
        return $this->queryParams[$name] ?? null;
    }

    public function getBodyParam($name)
    {
        return $this->bodyParams[$name] ?? null;
    }
}