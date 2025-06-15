<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\JMS\Rector\Property\AccessorAnnotationToAttributeRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class AccessorAnnotationToAttributeRectorTest extends AbstractRectorTestCase
{
    #[DataProvider('provideData')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public static function provideData(): Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
