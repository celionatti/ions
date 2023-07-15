<?php

declare(strict_types=1);


namespace Ions\Core\Twig;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

/**
 * ============================
 * Twig AssetExtension ========
 * ============================
 */

class AssetExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('asset', [$this, 'assetFunction']),
        ];
    }

    public function assetFunction(string $path): string
    {
        // Modify this function to generate the correct URL for your assets
        return '/build' . $path;
    }
}
