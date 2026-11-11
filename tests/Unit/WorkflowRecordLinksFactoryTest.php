<?php

declare(strict_types=1);

namespace Contenir\Navigation\Laminas\Mvc\Tests\Unit;

use Contenir\Mvc\Workflow\PluginManager;
use Contenir\Navigation\Laminas\Mvc\MenuOptions;
use Contenir\Navigation\Laminas\Mvc\Tests\TestAsset\Container\InMemoryContainer;
use Contenir\Navigation\Laminas\Mvc\Tests\TestAsset\Factory\ResourceFactory;
use Contenir\Navigation\Laminas\Mvc\Tests\TestAsset\Router\NamedRouteRouter;
use Contenir\Navigation\Laminas\Mvc\Tests\TestAsset\Workflow\Workflows;
use Contenir\Navigation\Laminas\Mvc\WorkflowRecordLinksFactory;
use Contenir\Navigation\Link\RecordTarget;
use Contenir\Resource\Core\ResourceManagerInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[Group('unit')]
final class WorkflowRecordLinksFactoryTest extends TestCase
{
    #[Test]
    public function linksNoSectionsWithoutTheApplicationsConfiguration(): void
    {
        $record = new RecordTarget('site.page.home', 12);
        $links  = (new WorkflowRecordLinksFactory())($this->container());

        static::assertNull($links->resolve([$record])->for($record));
    }

    #[Test]
    public function linksTheSectionsTheConfigurationMaps(): void
    {
        $record = new RecordTarget('site.page.home', 12);
        $links  = (new WorkflowRecordLinksFactory())($this->container([
            'config' => [MenuOptions::KEY => ['sections' => ['site.page.home' => 'page']]],
        ]));

        static::assertSame('/about', $links->resolve([$record])->for($record)?->href);
    }

    /**
     * @param array<string, mixed> $services
     */
    private function container(array $services = []): InMemoryContainer
    {
        $resources = $this->createStub(ResourceManagerInterface::class);
        $resources->method('findByType')->willReturn([ResourceFactory::make(12, 'page', 'About')]);

        return new InMemoryContainer([
            ResourceManagerInterface::class => $resources,
            PluginManager::class            => Workflows::ofAPageSite(),
            'Router'                        => new NamedRouteRouter(['page-12' => '/about']),
            ...$services,
        ]);
    }
}
