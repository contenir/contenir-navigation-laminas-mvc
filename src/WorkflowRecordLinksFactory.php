<?php

declare(strict_types=1);

namespace Contenir\Navigation\Laminas\Mvc;

use Contenir\Mvc\Workflow\PluginManager;
use Contenir\Resource\Core\ResourceManagerInterface;
use InvalidArgumentException;
use Laminas\Router\RouteStackInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

use function assert;
use function is_array;

/**
 * Builds the workflow record links from contenir-resource's manager, the site's workflows, the
 * router, and the sections MenuOptions maps.
 *
 * @api
 */
final readonly class WorkflowRecordLinksFactory
{
    /**
     * @throws ContainerExceptionInterface When a service cannot be built.
     * @throws InvalidArgumentException    When a setting is not of the kind it needs to be.
     */
    public function __invoke(ContainerInterface $container): WorkflowRecordLinks
    {
        /** @var mixed $config */
        $config  = $container->has('config') ? $container->get('config') : null;
        $options = MenuOptions::fromAppConfig(is_array($config) ? $config : []);

        $resources = $container->get(ResourceManagerInterface::class);
        assert($resources instanceof ResourceManagerInterface, description: 'contenir-resource registers its manager');

        $workflows = $container->get(PluginManager::class);
        assert(
            $workflows instanceof PluginManager,
            description: 'The site registers its workflows with contenir-workflow-laminas-mvc',
        );

        /** @var mixed $router */
        $router = $container->get('Router');
        assert($router instanceof RouteStackInterface, description: 'laminas-mvc registers its router');

        return new WorkflowRecordLinks($resources, $workflows, $router, $options->sections);
    }
}
