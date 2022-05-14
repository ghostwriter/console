<?php

declare(strict_types=1);

namespace Ghostwriter\Console\ServiceProvider;

use Ghostwriter\Container\Contract\ContainerInterface;
use Ghostwriter\Container\Contract\ServiceProviderInterface;
use Symfony\Component\Console\Command\Command;

final class CommandServiceProvider implements ServiceProviderInterface
{
    /** @var array<class-string<Command>> */
    public array $commands = [];

    public function __invoke(ContainerInterface $container): void
    {
        foreach ($this->commands as $command) {
            $container->bind($command);
            $container->tag($command, [Command::class]);
        }
    }
}
