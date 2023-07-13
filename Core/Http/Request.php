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
 }
 