<?php

declare(strict_types=1);

namespace Tests\Unit\Container\Factory;

use Ghostwriter\Console\Container\Factory\AbstractApplicationFactory;
use Ghostwriter\Container\PsrContainer;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\Console\Application;
use Tests\Unit\AbstractTestCase;
use Throwable;

#[CoversClass(AbstractApplicationFactory::class)]
final class AbstractApplicationFactoryTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testAbstractApplicationFactory(): void
    {
        $container = $this->mockContainer();

        $container->expects('get')
            ->with(PsrContainer::class)
            ->andReturn(new PsrContainer($container));

        $application = $this->mockApplicationFactory()->__invoke($container);

        self::assertInstanceOf(Application::class, $application);

        self::assertSame(AbstractApplicationFactory::NAME, $application->getName());
    }
}
