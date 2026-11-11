<?php

declare(strict_types=1);

namespace Contenir\Navigation\Laminas\Mvc\Tests\Unit;

use Contenir\Navigation\Laminas\Mvc\ConfigProvider;
use Contenir\Navigation\Laminas\Mvc\MenuContainers;
use Contenir\Navigation\Laminas\Mvc\MenuContainersFactory;
use Contenir\Navigation\Laminas\Mvc\RecordLinkResolverInterface;
use Contenir\Navigation\Laminas\Mvc\View\Menus;
use Contenir\Navigation\Laminas\Mvc\View\MenusFactory;
use Contenir\Navigation\Laminas\Mvc\WorkflowRecordLinks;
use Contenir\Navigation\Laminas\Mvc\WorkflowRecordLinksFactory;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[Group('unit')]
final class ConfigProviderTest extends TestCase
{
    #[Test]
    public function givesItsDependenciesAndViewHelpersOnTheirOwn(): void
    {
        $provider = new ConfigProvider();
        $config   = $provider();

        static::assertSame(
            [$config['service_manager'], $config['view_helpers']],
            [$provider->getDependencies(), $provider->getViewHelpers()],
        );
    }

    #[Test]
    public function registersTheServicesTheViewHelperAndTheDefaultSettings(): void
    {
        static::assertSame(
            [
                'service_manager'     => [
                    'aliases'   => [RecordLinkResolverInterface::class => WorkflowRecordLinks::class],
                    'factories' => [
                        MenuContainers::class      => MenuContainersFactory::class,
                        WorkflowRecordLinks::class => WorkflowRecordLinksFactory::class,
                    ],
                ],
                'view_helpers'        => [
                    'aliases'   => ['menus' => Menus::class],
                    'factories' => [Menus::class => MenusFactory::class],
                ],
                'contenir_navigation' => ['cache' => null, 'sections' => []],
            ],
            (new ConfigProvider())(),
        );
    }
}
