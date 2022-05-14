<?php

declare(strict_types=1);

namespace Ghostwriter\Console\ServiceProvider;

use Ghostwriter\Container\Contract\ContainerInterface;
use Ghostwriter\Container\Contract\ServiceProviderInterface;

final class ConsoleServiceProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $container): void
    {
    }
}
