<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Set\TwigExtensionNamespace;

use Iterator;
use Rector\Symfony\Set\TwigSetList;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class TwigExtensionNamespaceTest extends AbstractRectorTestCase
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
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return TwigSetList::TWIG_UNDERSCORE_TO_NAMESPACE;
    }
}
