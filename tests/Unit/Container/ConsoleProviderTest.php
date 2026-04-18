<?php

declare(strict_types=1);

namespace Tests\Unit\Container;

use Ghostwriter\Console\Container\ConsoleProvider;
use Ghostwriter\Console\Container\Symfony\Console\ApplicationExtension;
use Ghostwriter\Console\Container\Symfony\Console\ApplicationFactory;
use Ghostwriter\Console\Container\Symfony\Console\CommandLoader\ContainerCommandLoaderFactory;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\ProviderInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;
use PHPUnit\Framework\Attributes\CoversClass;
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
use Tests\Unit\AbstractTestCase;

#[CoversClass(ConsoleProvider::class)]
final class ConsoleProviderTest extends AbstractTestCase
{
    public function testConsoleProviderRegister(): void
    {
        $container = $this->createMock(ContainerInterface::class);

        $container->expects(self::exactly(5))
            ->method('alias')
            ->willReturnMap([
                [ArgvInput::class, InputInterface::class],
                [ConsoleOutput::class, OutputInterface::class],
                [ConsoleOutputInterface::class, OutputInterface::class],
                [ContainerCommandLoader::class, CommandLoaderInterface::class],
                [SymfonyStyle::class, StyleInterface::class],
            ]);

        $container->expects(self::once())
            ->method('extend')
            ->with(Application::class, ApplicationExtension::class);

        $container->expects(self::exactly(2))
            ->method('factory')
            ->willReturnMap([
                [Application::class, ApplicationFactory::class],
                [ContainerCommandLoader::class, ContainerCommandLoaderFactory::class],
            ])
            ->seal();

        (new ConsoleProvider())->register($container);
    }

    public function testExtendsAbstractProvider(): void
    {
        self::assertInstanceOf(AbstractProvider::class, new ConsoleProvider());
    }

    public function testImplementsProviderInterface(): void
    {
        self::assertInstanceOf(ProviderInterface::class, new ConsoleProvider());
    }
}
