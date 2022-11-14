<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector;

use Rector\FileSystemRector\ValueObject\AddedFileWithContent;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class DependencyInvokableControllerRectorTest extends AbstractRectorTestCase
{
    public function test(): void
    {
        $someClassFile = __DIR__ . '/FixtureDependency/dependency_controller.php.inc';
        $this->doTestFile($someClassFile);

        // 1. here the file should be split into 2 new ones

        $addedFileWithContents = [];
        $addedFileWithContents[] = new AddedFileWithContent(
            $this->getFixtureTempDirectory() . '/DependencyListController.php',
            file_get_contents(__DIR__ . '/FixtureDependency/Expected/DependencyListController.php')
        );

        $addedFileWithContents[] = new AddedFileWithContent(
            $this->getFixtureTempDirectory() . '/DependencyDetailController.php',
            file_get_contents(__DIR__ . '/FixtureDependency/Expected/DependencyDetailController.php')
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
