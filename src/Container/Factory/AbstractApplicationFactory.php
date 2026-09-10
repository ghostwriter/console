<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Container\Factory;

use Composer\InstalledVersions;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Ghostwriter\Container\PsrContainer;
use Override;
use Symfony\Component\Console\Application;
use Throwable;

/**
 * @implements FactoryInterface<Application>
 */
abstract class AbstractApplicationFactory implements FactoryInterface
{
    public const string NAME = 'Ghostwriter Console';

    public const string PACKAGE = 'ghostwriter/console';

    /** @throws Throwable */
    #[Override]
    public function __invoke(ContainerInterface $container): Application
    {
        return new Application(
            name: static::NAME,
            version: InstalledVersions::getPrettyVersion(static::PACKAGE),
            container: $container->get(PsrContainer::class)
        );
    }
}
