<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\MethodCall\StringFormTypeToClassRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class WithContainerTest extends AbstractRectorTestCase
{
    #[DataProvider('provideData')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public static function provideData(): Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/FixtureWithContainer');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/xml_path_config.php';
    }
}
