<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Container;

use Ghostwriter\Console\Container\Symfony\Console\ApplicationExtension;
use Ghostwriter\Console\Container\Symfony\Console\ApplicationFactory;
use Ghostwriter\Console\Container\Symfony\Console\CommandLoader\ContainerCommandLoaderFactory;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\DefinitionInterface;
use Override;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

/**
 * @see ConsoleDefinitionTest
 */
final readonly class ConsoleDefinition implements DefinitionInterface
{
    /** @throws Throwable */
    #[Override]
    public function __invoke(ContainerInterface $container): void
    {
        $container->alias(ArgvInput::class, InputInterface::class);
        $container->alias(ConsoleOutput::class, ConsoleOutputInterface::class);
        $container->alias(ConsoleOutputInterface::class, OutputInterface::class);
        $container->alias(ContainerCommandLoader::class, CommandLoaderInterface::class);
        $container->alias(SymfonyStyle::class, StyleInterface::class);

        $container->extend(Application::class, ApplicationExtension::class);

        $container->factory(Application::class, ApplicationFactory::class);
        $container->factory(ContainerCommandLoader::class, ContainerCommandLoaderFactory::class);
    }
}
