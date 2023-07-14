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

    public function __construct(string $body = '', int $statusCode = 200)
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
    }

    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setContentType(string $contentType)
    {
        $this->headers['Content-Type'] = $contentType;
    }

    public function redirect(string $url, int $statusCode = 302)
    {
        $this->setHeader('Location', $url);
        $this->setStatusCode($statusCode);
    }

    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function removeHeader($name)
    {
        unset($this->headers[$name]);
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setJsonResponse()
    {
        $this->setHeader('Content-Type', 'application/json');
        $this->body = json_encode($this->body);
    }

    public function sendFile($filePath, $contentType = 'application/octet-stream')
    {
        $this->setHeader('Content-Type', $contentType);
        $this->body = file_get_contents($filePath);
    }

    public function setCookie($name, $value, $expires = 0, $path = '/', $domain = '', $secure = false, $httpOnly = true)
    {
        setcookie($name, $value, $expires, $path, $domain, $secure, $httpOnly);
    }


    public function send()
    {
        // Set the HTTP status code
        http_response_code($this->statusCode);

        // Set the response headers
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        // Send the response body
        echo $this->body;

        // Flush the output buffer
        flush();

        // Exit the script (optional)
        exit();
    }
}
