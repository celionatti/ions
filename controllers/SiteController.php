<?php

declare(strict_types=1);

namespace Ions\Controllers;

use Ions\Models\User;
use Ions\Seeders\UserSeeder;
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

    public function index(Response $response): Response
    {
        $users = User::query()->get()->toArray();

        return $this->twig->render($response, "welcome.twig", ['users' => $users]);
    }
}
