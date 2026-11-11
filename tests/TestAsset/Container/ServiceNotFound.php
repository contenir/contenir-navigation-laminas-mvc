<?php

declare(strict_types=1);

namespace Contenir\Navigation\Laminas\Mvc\Tests\TestAsset\Container;

use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;

final class ServiceNotFound extends RuntimeException implements NotFoundExceptionInterface {}
