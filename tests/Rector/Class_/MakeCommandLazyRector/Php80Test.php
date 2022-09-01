<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\MakeCommandLazyRector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class Php80Test extends AbstractRectorTestCase
{
    /**
     * @requires PHP 8.0
     * @dataProvider provideData()
     */
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public function provideData(): Iterator
    {
        return $this->yieldFilePathsFromDirectory(__DIR__ . '/FixturePhp80');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
