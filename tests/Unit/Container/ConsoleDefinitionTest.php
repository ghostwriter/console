<?php

declare(strict_types=1);

namespace Tests\Unit\Container;

use Ghostwriter\Console\Container\ConsoleDefinition;
use Ghostwriter\Container\Interface\ContainerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Tests\Unit\AbstractTestCase;

#[CoversClass(ConsoleDefinition::class)]
final class ConsoleDefinitionTest extends AbstractTestCase
{
    public function testImplementsDefinitionInterface(): void
    {
        $this->assertInstanceOf(
            ConsoleDefinition::class,
            new ConsoleDefinition(),
        );
    }

    public function testInvoke(): void
    {
        $container = $this->createMock(ContainerInterface::class);

        $container->expects(self::exactly(3))
            ->method('alias')
            ->willReturnMap([
                [ArgvInput::class, InputInterface::class],
                [ConsoleOutput::class, OutputInterface::class],
                [SymfonyStyle::class, StyleInterface::class],
            ]);

        (new ConsoleDefinition())($container);
    }
}
