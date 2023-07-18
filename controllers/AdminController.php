<?php

declare(strict_types=1);

namespace Ions\controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

/**
 * =========================
 * ==== Admin Controllers ===
 * =========================
 */

 class AdminController
 {
    public function __construct(private readonly Twig $twig)
    {
    }

    public function dashboard(Request $request, Response $response)
    {
        return $this->twig->render($response, "admin.twig");
    }
 }