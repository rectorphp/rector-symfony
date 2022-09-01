<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\MethodCall\StringFormTypeToClassRector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class WithContainerTest extends AbstractRectorTestCase
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
        return $this->yieldFilePathsFromDirectory(__DIR__ . '/FixtureWithContainer');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/xml_path_config.php';
    }
}
