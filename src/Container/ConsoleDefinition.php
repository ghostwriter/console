<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Container;

use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\DefinitionInterface;
use Override;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

/**
 * @see ConsoleDefinitionTest
 */
final readonly class ConsoleDefinition implements DefinitionInterface
{
    /**
     * @throws Throwable
     */
    #[Override]
    public function __invoke(ContainerInterface $container): void
    {
        $container->alias(ArgvInput::class, InputInterface::class);
        $container->alias(ConsoleOutput::class, OutputInterface::class);
        $container->alias(SymfonyStyle::class, StyleInterface::class);
    }
}
