<?php

declare(strict_types=1);

namespace Tests\Unit;

use Ghostwriter\Console\Container\Extension\AbstractApplicationExtension;
use Ghostwriter\Console\Container\Factory\AbstractApplicationFactory;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\PHPUnitAssertions\Trait\AssertionsTrait;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\Generator\MockConfigurationBuilder;
use Mockery\MockInterface;
use Throwable;

abstract class AbstractTestCase extends MockeryTestCase
{
    use AssertionsTrait;

    /**
     * @template TMock of object
     *
     * @param class-string<TMock> $class
     *
     * @throws Throwable
     *
     * @return MockInterface&TMock
     */
    final public function mock(string $class): MockInterface
    {
        $mockConfigurationBuilder = new MockConfigurationBuilder();

        $mockConfigurationBuilder->addWhiteListedMethod('unset');

        return Mockery::mock($class, $mockConfigurationBuilder);
    }

    /**
     * @template TSpy of object
     *
     * @param class-string<TSpy> $class
     *
     * @throws Throwable
     *
     * @return MockInterface&TSpy
     */
    final public function spy(string $class): MockInterface
    {
        $mockConfigurationBuilder = new MockConfigurationBuilder();

        $mockConfigurationBuilder->addWhiteListedMethod('unset');

        return Mockery::spy($class, $mockConfigurationBuilder);
    }

    /**
     * @template TStub of object
     *
     * @param class-string<TStub> $class
     *
     * @throws Throwable
     *
     * @return MockInterface&TStub
     */
    final public function stub(string $class): MockInterface
    {
        return $this->mock($class)->shouldIgnoreMissing();
    }

    /**
     * @throws Throwable
     *
     * @return AbstractApplicationExtension&MockInterface
     */
    public function mockApplicationExtension(): AbstractApplicationExtension
    {
        return $this->mock(AbstractApplicationExtension::class);
    }

    /**
     * @throws Throwable
     *
     * @return AbstractApplicationFactory&MockInterface
     */
    public function mockApplicationFactory(): AbstractApplicationFactory
    {
        return $this->mock(AbstractApplicationFactory::class);
    }

    /**
     * @throws Throwable
     *
     * @return ContainerInterface&MockInterface
     */
    public function mockContainer(): ContainerInterface
    {
        return $this->mock(ContainerInterface::class);
    }
}
