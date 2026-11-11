<?php

declare(strict_types=1);

namespace Contenir\Navigation\Laminas\Mvc\Tests\TestAsset\Workflow;

use Contenir\Mvc\Workflow\Workflow\WorkflowInterface;
use Override;

/**
 * A workflow that routes nothing and cannot be given a resource.
 */
final class ReadOnlyWorkflow implements WorkflowInterface
{
    #[Override]
    public function getNavigationConfig(): array
    {
        return [];
    }

    #[Override]
    public function getRouteConfig(): array
    {
        return [];
    }

    #[Override]
    public function getRouteId(): string
    {
        return '';
    }

    #[Override]
    public function getRoutePath(): string
    {
        return '';
    }
}
