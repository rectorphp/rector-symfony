<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Set\TwigExtensionNamespace;

use Iterator;
use Rector\Symfony\Set\TwigSetList;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class TwigExtensionNamespaceTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(SmartFileInfo $fileInfo): void
    {
        $this->doTestFileInfo($fileInfo);
    }

    /**
     * @return Iterator<SmartFileInfo>
     */
    public function provideData(): Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return TwigSetList::TWIG_UNDERSCORE_TO_NAMESPACE;
    }
}
