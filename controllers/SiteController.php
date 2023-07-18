<?php

declare(strict_types=1);

namespace Ions\Controllers;

use Ions\Models\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

/**
 * =========================
 * ==== Site Controllers ===
 * =========================
 */

class SiteController
{
    public function __construct(private readonly Twig $twig)
    {
    }

    public function index(Response $response, Request $request): Response
    {
        // $users = User::query()->get()->toArray();

        return $this->twig->render($response, "welcome.twig");
    }

    public function blog(Response $response, Request $request): Response
    {
        return $this->twig->render($response, "blog.twig");
    }

    public function contact(Response $response, Request $request): Response
    {
        return $this->twig->render($response, "contact.twig");
    }
}
