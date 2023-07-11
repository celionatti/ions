<?php


class Response
{
    private $statusCode;
    private $headers;
    private $body;

    public function __construct($statusCode = 200, $headers = [], $body = '')
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function withStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function withHeader($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function withBody($body)
    {
        $this->body = $body;
        return $this;
    }
}
