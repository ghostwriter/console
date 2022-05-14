<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Event;

use Ghostwriter\Container\Contract\ContainerInterface;
use Ghostwriter\EventDispatcher\Contract\ListenerProviderInterface;
use Ghostwriter\EventDispatcher\Contract\SubscriberInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ConsoleSubscriber implements SubscriberInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(ListenerProviderInterface $listenerProvider): void
    {
        $listenerProvider->addListener(function (object $message) {
            $this->container->get(OutputInterface::class)->write($message::class);
        });

        $listenerProvider->addListener(function (object $message) {
            $this->container->get(OutputInterface::class)->writeln($message::class);
        });
    }
}
