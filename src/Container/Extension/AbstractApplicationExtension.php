<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Container\Extension;

use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\ExtensionInterface;
use Ghostwriter\Container\PsrContainer;
use Override;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Throwable;

use function assert;
use function count;

/**
 * @implements ExtensionInterface<Application>
 */
abstract class AbstractApplicationExtension implements ExtensionInterface
{
    public const bool AUTO_EXIT = true;

    public const bool CATCH_ERRORS = true;

    public const bool CATCH_EXCEPTIONS = true;

    /** @var array<string,class-string<Command>> */
    public const array COMMANDS = [];

    public const string DEFAULT_COMMAND = 'list';

    /** @var list<string> */
    public const array HIDDEN = ['completion', 'help', 'list'];

    /**
     * @param Application $service
     *
     * @throws Throwable
     */
    #[Override]
    public function __invoke(ContainerInterface $container, object $service): void
    {
        assert($service instanceof Application);

        $service->setAutoExit(static::AUTO_EXIT);

        $service->setCatchErrors(static::CATCH_ERRORS);

        $service->setCatchExceptions(static::CATCH_EXCEPTIONS);

        $service->setCommandLoader(new ContainerCommandLoader(
            $container->get(PsrContainer::class),
            static::COMMANDS
        ));

        $service->setDefaultCommand(static::DEFAULT_COMMAND, 1 === count(static::COMMANDS));

        foreach (static::HIDDEN as $command) {
            if (! $service->has($command)) {
                continue;
            }

            $service->get($command)->setHidden();
        }
    }
}
