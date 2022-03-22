<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector;

use Rector\FileSystemRector\ValueObject\AddedFileWithContent;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class SplitInvokableControllerRectorTest extends AbstractRectorTestCase
{
    public function test(): void
    {
        $someClassFileInfo = new SmartFileInfo(__DIR__ . '/FixtureSplit/some_class.php.inc');
        $this->doTestFileInfo($someClassFileInfo);

        // 1. here the file should be split into 2 new ones

        $addedFileWithContents = [];
        $addedFileWithContents[] = new AddedFileWithContent(
            $this->getFixtureTempDirectory() . '/SomeDetailController.php',
            file_get_contents(__DIR__ . '/FixtureSplit/Expected/SomeDetailController.php')
        );

        $addedFileWithContents[] = new AddedFileWithContent(
            $this->getFixtureTempDirectory() . '/SomeDetailController.php',
            file_get_contents(__DIR__ . '/FixtureSplit/Expected/SomeDetailController.php')
        );

        $this->assertFilesWereAdded($addedFileWithContents);

        // 2. old file should be removed
        $fixtureFileInfo = new SmartFileInfo(
            $this->getFixtureTempDirectory() . '/input_907c7bce29857872b688_some_class.php'
        );
        $this->assertFileWasRemoved($fixtureFileInfo);
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
