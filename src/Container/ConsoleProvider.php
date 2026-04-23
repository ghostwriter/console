<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Container;

use Ghostwriter\Console\Container\Symfony\Console\ApplicationFactory;
use Ghostwriter\Console\Container\Symfony\Console\CommandLoader\ContainerCommandLoaderFactory;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;
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

/**
 * @see ConsoleProviderTest
 */
final class ConsoleProvider extends AbstractProvider
{
    /**
     * alias => service.
     *
     * @var array<class-string,class-string>
     */
    public const array ALIAS = [
        ConsoleOutputInterface::class => ConsoleOutput::class,
        InputInterface::class => ArgvInput::class,
        OutputInterface::class => ConsoleOutputInterface::class,
        StyleInterface::class => SymfonyStyle::class,
    ];
}
