<?php

declare(strict_types=1);

namespace Tests\Unit\Container\Symfony\Console;

use Ghostwriter\Console\Container\Symfony\Console\ApplicationExtension;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

#[CoversClass(ApplicationExtension::class)]
final class ApplicationExtensionTest extends AbstractTestCase
{
    public function testExample(): void
    {
        self::assertTrue(true);
    }
}
