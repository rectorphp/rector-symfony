<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony25\Rector\Array_\MaxLengthSymfonyFormOptionToAttrRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class
MaxLengthSymfonyFormOptionToAttrRectorTest extends AbstractRectorTestCase
{
    #[DataProvider('provideData')]
    public function test(string $file): void
    {
        $this->doTestFile($file);
    }

    /**
     * @return Iterator<string[]>
     */
    public static function provideData(): Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
