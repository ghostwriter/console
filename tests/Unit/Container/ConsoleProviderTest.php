<?php

declare(strict_types=1);

namespace Tests\Unit\Container;

use Ghostwriter\Console\Container\ConsoleProvider;
use Ghostwriter\Container\Interface\Service\ProviderInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversClassesThatExtendClass;
use PHPUnit\Framework\Attributes\CoversClassesThatImplementInterface;
use PHPUnit\Framework\Attributes\CoversNothing;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Tests\Unit\AbstractTestCase;
use Throwable;

#[CoversNothing]
final class ConsoleProviderTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testConsoleProviderRegister(): void
    {
        $consoleProvider = new ConsoleProvider();

        self::assertInstanceOf(ProviderInterface::class, $consoleProvider);

        self::assertInstanceOf(AbstractProvider::class, $consoleProvider);

        $container = $this->mockContainer();

        $container->expects('alias')->with(ConsoleOutputInterface::class, ConsoleOutput::class);
        $container->expects('alias')->with(InputInterface::class, ArgvInput::class);
        $container->expects('alias')->with(OutputInterface::class, ConsoleOutputInterface::class);
        $container->expects('alias')->with(StyleInterface::class, SymfonyStyle::class);

        $consoleProvider->register($container);
    }
}
