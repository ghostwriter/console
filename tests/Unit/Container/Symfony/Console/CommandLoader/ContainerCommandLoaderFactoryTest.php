<?php

declare(strict_types=1);

namespace Tests\Unit\Container\Symfony\Console\CommandLoader;

use Ghostwriter\Console\Container\Symfony\Console\CommandLoader\ContainerCommandLoaderFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

#[CoversClass(ContainerCommandLoaderFactory::class)]
final class ContainerCommandLoaderFactoryTest extends AbstractTestCase
{
    public function testExample(): void
    {
        self::assertTrue(true);
    }
}
