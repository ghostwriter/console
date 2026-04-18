<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Container\Symfony\Console;

use Ghostwriter\Config\Interface\ConfigurationInterface;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\ExtensionInterface;
use Override;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Throwable;

use function assert;
use function is_string;

/**
 * @see ApplicationExtensionTest
 *
 * @implements ExtensionInterface<Application>
 */
final readonly class ApplicationExtension implements ExtensionInterface
{
    /** @throws Throwable */
    #[Override]
    public function __invoke(ContainerInterface $container, object $service): void
    {
        assert($service instanceof Application);

        $consoleConfiguration = $container->get(ConfigurationInterface::class)->wrap('ghostwriter.console', [
            'auto_exit'       => false,
            'catch_errors'     => false,
            'catch_exceptions' => false,
            'default_command' => false,
        ]);

        $service->setAutoExit($consoleConfiguration->get('auto_exit', false));
        $service->setCatchErrors($consoleConfiguration->get('catch_errors', false));
        $service->setCatchExceptions($consoleConfiguration->get('catch_exceptions', false));
        $service->setCommandLoader($container->get(CommandLoaderInterface::class));

        foreach ($consoleConfiguration->get('command', []) as $command) {
            $service->add($container->get($command));
        }

        $defaultCommand = $consoleConfiguration->get('default_command', false);
        if (! is_string($defaultCommand)) {
            return;
        }

        $singleCommand = $consoleConfiguration->get('single_command', false);
        $service->setDefaultCommand($defaultCommand, true === $singleCommand);
    }
}
