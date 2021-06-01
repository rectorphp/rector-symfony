<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Attribute\ExtractAttributeRouteNameConstantsRector;

use Iterator;
use Rector\FileSystemRector\ValueObject\AddedFileWithContent;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;
use Symplify\SmartFileSystem\SmartFileSystem;

/**
 * @requires PHP 8.0
 */
final class ExtractAttributeRouteNameConstantsRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(SmartFileInfo $inputFile, AddedFileWithContent $expectedAddedFileWithContent): void
    {
        $this->doTestFileInfo($inputFile);
        $this->assertFileWasAdded($expectedAddedFileWithContent);
    }

    /**
     * @return Iterator<array<SmartFileInfo|AddedFileWithContent>>
     */
    public function provideData(): Iterator
    {
        $smartFileSystem = new SmartFileSystem();

        yield [
            new SmartFileInfo(__DIR__ . '/Fixture/fixture.php.inc'),
            new AddedFileWithContent(
                $this->getFixtureTempDirectory() . '/src/ValueObject/Routing/RouteName.php',
                $smartFileSystem->readFile(__DIR__ . '/Source/extra_file.php')
            ),
        ];
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
