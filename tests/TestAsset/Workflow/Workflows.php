<?php

declare(strict_types=1);

namespace Contenir\Navigation\Laminas\Mvc\Tests\TestAsset\Workflow;

use Contenir\Mvc\Workflow\PluginManager;
use Contenir\Mvc\Workflow\Workflow\PageWorkflow;
use Contenir\Navigation\Laminas\Mvc\Tests\TestAsset\Container\InMemoryContainer;

/**
 * The workflow plugin manager of a site that routes its pages and nothing else.
 */
final class Workflows
{
    public static function ofAPageSite(): PluginManager
    {
        return new PluginManager(new InMemoryContainer(), ['invokables' => ['page' => PageWorkflow::class]]);
    }
}
