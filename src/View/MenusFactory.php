<?php

declare(strict_types=1);

namespace Contenir\Navigation\Laminas\Mvc\View;

use Contenir\Navigation\Laminas\Mvc\MenuContainers;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

use function assert;

/**
 * @api
 */
final readonly class MenusFactory
{
    /**
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): Menus
    {
        $containers = $container->get(MenuContainers::class);
        assert($containers instanceof MenuContainers, description: 'The package registers its menu containers');

        return new Menus($containers);
    }
}
