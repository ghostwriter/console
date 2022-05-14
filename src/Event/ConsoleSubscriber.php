<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Event;

use Ghostwriter\EventDispatcher\Contract\ListenerProviderInterface;

final class ConsoleSubscriber implements SubscriberInterface
{
    public function __invoke(ListenerProviderInterface $listenerProvider): void
    {
    }
}
