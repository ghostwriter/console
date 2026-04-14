<?php

declare(strict_types=1);

namespace Tests\Unit\Container\Symfony\Console;

use Ghostwriter\Console\Container\Symfony\Console\ApplicationFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

#[CoversClass(ApplicationFactory::class)]
final class ApplicationFactoryTest extends AbstractTestCase
{
    public function testExample(): void
    {
        self::assertTrue(true);
    }
}
