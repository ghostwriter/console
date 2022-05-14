<?php

declare(strict_types=1);

namespace Ghostwriter\Console\Tests\Unit;

use Ghostwriter\Console\Console;

/**
 * @coversDefaultClass \Ghostwriter\Console\Console
 *
 * @internal
 *
 * @small
 */
final class ConsoleTest extends AbstractTestCase
{
    /** @covers ::test */
    public function test(): void
    {
        self::assertTrue((new Console())->test());
    }
}
