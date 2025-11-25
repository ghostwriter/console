<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Container\Symfony\Console;

use Composer\InstalledVersions;
use Ghostwriter\Config\Interface\ConfigurationInterface;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Override;
use Symfony\Component\Console\Application;
use Throwable;

/**
 * @see ApplicationFactoryTest
 *
 * @implements FactoryInterface<Application>
 */
final readonly class ApplicationFactory implements FactoryInterface
{
    /** @throws Throwable */
    #[Override]
    public function __invoke(ContainerInterface $container): Application
    {
        $configuration = $container->get(ConfigurationInterface::class);

        $consoleConfiguration = $configuration->wrap('ghostwriter.console');

        return new Application(
            $consoleConfiguration->get('name', 'Ghostwriter Console'),
            InstalledVersions::getPrettyVersion($consoleConfiguration->get('package', 'ghostwriter/console'))
        );
    }
}
