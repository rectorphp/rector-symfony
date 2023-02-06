<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector;

use Nette\Utils\FileSystem;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class DependencyInvokableControllerRectorTest extends AbstractRectorTestCase
{
    public function test(): void
    {
        $this->doTestFile(__DIR__ . '/FixtureDependency/dependency_controller.php.inc');

        // 1. here the file should be split into 2 new ones

        $this->assertFileWasAdded(
            __DIR__ . '/FixtureDependency/DependencyListController.php',
            FileSystem::read(__DIR__ . '/FixtureDependency/Expected/DependencyListController.php')
        );

        $this->assertFileWasAdded(
            __DIR__ . '/FixtureDependency/DependencyDetailController.php',
            FileSystem::read(__DIR__ . '/FixtureDependency/Expected/DependencyDetailController.php')
        );

        // 2. old file should be removed
        $isFileRemoved = $this->removedAndAddedFilesCollector->isFileRemoved(
            __DIR__ . '/FixtureDependency/dependency_controller.php'
        );
        $this->assertTrue($isFileRemoved);
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
