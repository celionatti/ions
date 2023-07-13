<?php

declare(strict_types=1);

namespace Ions\Core\Http;

/**
 * ==========================
 * Response Class ===========
 * ==========================
 */


class Response
{
    private $body;
    private $statusCode;
    private $headers = [];

    public function __construct($body = '', $statusCode = 200)
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
    }

    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function send()
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        echo $this->body;
    }
}
