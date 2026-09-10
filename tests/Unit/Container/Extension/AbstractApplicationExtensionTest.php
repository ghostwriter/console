<?php

declare(strict_types=1);

namespace Tests\Unit\Container\Extension;

use Ghostwriter\Console\Container\Extension\AbstractApplicationExtension;
use Ghostwriter\Console\Container\Factory\AbstractApplicationFactory;
use Ghostwriter\Container\PsrContainer;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\Console\Application;
use Tests\Unit\AbstractTestCase;
use Throwable;

#[CoversClass(AbstractApplicationFactory::class)]
#[CoversClass(AbstractApplicationExtension::class)]
final class AbstractApplicationExtensionTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testAbstractApplicationExtension(): void
    {
        $container = $this->mockContainer();

        $container->expects('get')
            ->with(PsrContainer::class)
            ->andReturn(new PsrContainer($container))
            ->twice();

        $application = $this->mockApplicationFactory()->__invoke($container);

        self::assertInstanceOf(Application::class, $application);

        self::assertSame(AbstractApplicationFactory::NAME, $application->getName());

        $this->mockApplicationExtension()->__invoke($container, $application);
    }
}
