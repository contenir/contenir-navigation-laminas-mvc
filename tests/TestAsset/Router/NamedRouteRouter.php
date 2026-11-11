<?php

declare(strict_types=1);

namespace Contenir\Navigation\Laminas\Mvc\Tests\TestAsset\Router;

use Laminas\Router\Http\Literal;
use Laminas\Router\SimpleRouteStack;

/**
 * A router that knows only the address of each route it was given by name, as a test's routes
 */
final class NamedRouteRouter extends SimpleRouteStack
{
    /**
     * @param array<string, string> $paths Each route's address, by its name
     */
    public function __construct(array $paths)
    {
        parent::__construct();

        foreach ($paths as $name => $path) {
            $this->addRoute($name, Literal::factory(['route' => $path]));
        }
    }
}
