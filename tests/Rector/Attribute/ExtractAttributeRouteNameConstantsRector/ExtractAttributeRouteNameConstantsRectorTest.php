<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Attribute\ExtractAttributeRouteNameConstantsRector;

use Iterator;
use Rector\FileSystemRector\ValueObject\AddedFileWithContent;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

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
     * @return Iterator<SmartFileInfo|AddedFileWithContent>
     */
    public function provideData(): Iterator
    {
        yield [
            new SmartFileInfo(__DIR__ . '/Fixture/fixture.php.inc'),
            new AddedFileWithContent(
                'src/ValueObject/Routing/RouteName.php',
                file_get_contents(__DIR__ . '/Source/extra_file.php')
            ),
        ];
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
