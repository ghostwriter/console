#!/usr/bin/env php
<?php

declare(strict_types=1);

use Composer\InstalledVersions;
use Ghostwriter\Console\ServiceProvider\ConsoleServiceProvider;
use Ghostwriter\Container\Container;
use Ghostwriter\EventDispatcher\Contract\DispatcherInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

(static function (): void {
    define('PACKAGE', 'ghostwriter/console');
    define('APP_NAME', 'ConsoleApp');
    define('MIN_PHP_VERSION', '8.0.0');

    if (version_compare(MIN_PHP_VERSION, PHP_VERSION, '>')) {
        fwrite(
            STDERR,
            sprintf(
                implode(PHP_EOL, ['%s requires PHP >= %s', 'You are using PHP %s (%s).']),
                APP_NAME,
                MIN_PHP_VERSION,
                PHP_VERSION,
                PHP_BINARY
            )
        );

        die(1);
    }

    foreach (['json', 'mbstring'] as $extension) {
        if (extension_loaded($extension)) {
            continue;
        }
        fwrite(STDERR, sprintf('%s requires the "%s" extension.' . PHP_EOL, APP_NAME, $extension));

        die(1);
    }

    if (! ini_get('date.timezone')) {
        ini_set('date.timezone', 'UTC');
    }

    /**
     * Find the path to 'vendor/autoload.php'.
     */
    require realpath(dirname(__DIR__, 3) . '/vendor/autoload.php')
        ?: realpath(dirname(__DIR__) . '/vendor/autoload.php')
            ?: realpath('vendor/autoload.php')
                ?: fwrite(
                    STDERR,
                    implode(PHP_EOL, [
                        '',
                        'Cannot locate "vendor/autoload.php"',
                        'please run "composer install"',
                        '',
                    ]) . PHP_EOL
                ) && die(1);

    // here be dragons

    $container = Container::getInstance();
    $container->build(ConsoleServiceProvider::class);

    /** @var Application $application */
    $application = $container->build(
        Application::class,
        [
            'name' => APP_NAME,
            'version'=> InstalledVersions::getPrettyVersion(PACKAGE),
        ]
    );

    // @var class-string<Command> $command
    $application->addCommands(array_map(
        static fn (string $command): Command => $container->get($command),
        iterator_to_array($container->tagged(Command::class))
    ));

    $application->setAutoExit(false);
    $application->setCatchExceptions(false);

    try {
        $application->run();
    } catch (Throwable $throwable) {
        $container->get(DispatcherInterface::class)->dispatch($throwable);
    }
})();
