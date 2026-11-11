<?php

declare(strict_types=1);

namespace Contenir\Navigation\Laminas\Mvc;

/**
 * Registers the menu containers, the workflow record links as the record resolver, and the
 * `menus` view helper.
 *
 * @api
 */
final class Module
{
    /**
     * @return array<string, mixed>
     */
    public function getConfig(): array
    {
        return (new ConfigProvider())();
    }
}
