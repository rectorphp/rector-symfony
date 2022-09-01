<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Set\Symfony43;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class Symfony43Test extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public function provideData(): Iterator
    {
        return $this->yieldFilePathsFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/symfony43.php';
    }
}
