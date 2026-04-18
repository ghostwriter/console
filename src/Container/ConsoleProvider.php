<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Container;

use Ghostwriter\Console\Container\Symfony\Console\ApplicationExtension;
use Ghostwriter\Console\Container\Symfony\Console\ApplicationFactory;
use Ghostwriter\Console\Container\Symfony\Console\CommandLoader\ContainerCommandLoaderFactory;
use Ghostwriter\Container\Interface\BuilderInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;
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
 * @see ConsoleProviderTest
 */
final class ConsoleProvider extends AbstractProvider
{
    /** @throws Throwable */
    #[Override]
    public function register(BuilderInterface $builder): void
    {
        $builder->alias(InputInterface::class, ArgvInput::class);
        $builder->alias(ConsoleOutputInterface::class, ConsoleOutput::class);
        $builder->alias(OutputInterface::class, ConsoleOutputInterface::class);
        $builder->alias(CommandLoaderInterface::class, ContainerCommandLoader::class);
        $builder->alias(StyleInterface::class, SymfonyStyle::class);

        $builder->extend(Application::class, ApplicationExtension::class);

        $builder->factory(Application::class, ApplicationFactory::class);
        $builder->factory(ContainerCommandLoader::class, ContainerCommandLoaderFactory::class);
    }
}
