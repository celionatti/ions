<?php

declare(strict_types=1);

namespace Ions\Core\Http;

/**
 * ==========================
 * Request Class ============
 * ==========================
 */

class Request
{
    private $method;
    private $path;
    private $params;

    public function __construct($method, $path, $params = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->params = $params;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getParam($name)
    {
        return $this->params[$name] ?? null;
    }

    public function hasParam($name)
    {
        return isset($this->params[$name]);
    }

    public function getAllParams()
    {
        return $this->params;
    }

    public function isSecure()
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }

    public function getContentType()
    {
        return $_SERVER['CONTENT_TYPE'] ?? null;
    }


    public function getIpAddress()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    public function getAjaxData()
    {
        $data = [];

        if ($this->isAjax() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        return $data;
    }


    public function getQueryParams()
    {
        $queryParams = [];
        parse_str($_SERVER['QUERY_STRING'], $queryParams);
        return $queryParams;
    }

    public function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public function getProtocol()
    {
        return $_SERVER['SERVER_PROTOCOL'] ?? null;
    }

    public function hasHeader($name)
    {
        return isset($_SERVER['HTTP_' . str_replace('-', '_', strtoupper($name))]);
    }

    public function getHeader($name)
    {
        $name = 'HTTP_' . str_replace('-', '_', strtoupper($name));
        return $_SERVER[$name] ?? null;
    }

    public function isMethod($method)
    {
        return strtoupper($this->method) === strtoupper($method);
    }
}
