<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Issues\Issue9850;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class Issue9850Test extends AbstractRectorTestCase
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
        return __DIR__ . '/config/composer_based.php';
    }

    protected function provideComposerJsonFilePath(): string
    {
        return __DIR__ . '/config/composer.json';
    }
}
