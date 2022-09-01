<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector;

use Rector\FileSystemRector\ValueObject\AddedFileWithContent;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class SplitInvokableControllerRectorTest extends AbstractRectorTestCase
{
    public function test(): void
    {
        $someClassFile = __DIR__ . '/FixtureSplit/some_class.php.inc';
        $this->doTestFile($someClassFile);

        // 1. here the file should be split into 2 new ones

        $addedFileWithContents = [];
        $addedFileWithContents[] = new AddedFileWithContent(
            $this->getFixtureTempDirectory() . '/SomeListController.php',
            file_get_contents(__DIR__ . '/FixtureSplit/Expected/SomeListController.php')
        );

        $addedFileWithContents[] = new AddedFileWithContent(
            $this->getFixtureTempDirectory() . '/SomeDetailController.php',
            file_get_contents(__DIR__ . '/FixtureSplit/Expected/SomeDetailController.php')
        );

        $this->assertFilesWereAdded($addedFileWithContents);

        // 2. old file should be removed
        $removedFilesCount = $this->removedAndAddedFilesCollector->getRemovedFilesCount();
        $this->assertSame(1, $removedFilesCount);
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
