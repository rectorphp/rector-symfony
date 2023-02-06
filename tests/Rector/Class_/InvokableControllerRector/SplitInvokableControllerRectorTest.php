<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector;

use Nette\Utils\FileSystem;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class SplitInvokableControllerRectorTest extends AbstractRectorTestCase
{
    public function test(): void
    {
        $this->doTestFile(__DIR__ . '/FixtureSplit/some_class.php.inc');

        $this->assertFileWasAdded(
            __DIR__ . '/FixtureSplit/SomeListController.php',
            FileSystem::read(__DIR__ . '/FixtureSplit/Expected/SomeListController.php')
        );

        $this->assertFileWasAdded(
            __DIR__ . '/FixtureSplit/SomeDetailController.php',
            FileSystem::read(__DIR__ . '/FixtureSplit/Expected/SomeDetailController.php')
        );

        // 2. old file should be removed
        $isOriginalFileRemoved = $this->removedAndAddedFilesCollector->isFileRemoved(
            __DIR__ . '/FixtureSplit/some_class.php'
        );
        $this->assertTrue($isOriginalFileRemoved);
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
