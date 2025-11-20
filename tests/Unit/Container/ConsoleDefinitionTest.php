<?php

declare(strict_types=1);

namespace Tests\Unit\Container;

use Ghostwriter\Console\Container\ConsoleDefinition;
use PHPUnit\Framework\Attributes\CoversClass;
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
}
