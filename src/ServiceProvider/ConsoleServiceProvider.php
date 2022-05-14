<?php

declare(strict_types=1);

namespace Ghostwriter\Console\ServiceProvider;

use Ghostwriter\Console\Event\ConsoleSubscriber;
use Ghostwriter\Container\Contract\ContainerInterface;
use Ghostwriter\Container\Contract\ServiceProviderInterface;
use Ghostwriter\EventDispatcher\Dispatcher;
use Ghostwriter\EventDispatcher\ListenerProvider;
use Ghostwriter\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

final class ConsoleServiceProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $container): void
    {
        $container->build(CommandServiceProvider::class);
        $container->build(EventDispatcherServiceProvider::class);
        $container->extend(
            ListenerProvider::class,
            static function (ContainerInterface $container, object $listenerProviderInterface) {
                // @var ListenerProvider $listenerProviderInterface
                $listenerProviderInterface->addSubscriber($container->get(ConsoleSubscriber::class));

                $container->set(
                    Dispatcher::class,
                    $container->build(Dispatcher::class, [
                        'psrListenerProvider'=>$listenerProviderInterface,
                    ])
                );

                return $listenerProviderInterface;
            }
        );

        $container->bind(ConsoleOutput::class);
        $container->alias(OutputInterface::class, ConsoleOutput::class);
    }
}
