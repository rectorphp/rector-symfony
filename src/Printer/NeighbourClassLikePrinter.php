<?php

declare(strict_types=1);

namespace Rector\Symfony\Printer;

use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\Declare_;
use PhpParser\Node\Stmt\Namespace_;
use Rector\Core\Application\FileSystem\RemovedAndAddedFilesCollector;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Core\PhpParser\Node\CustomNode\FileWithoutNamespace;
use Rector\Core\PhpParser\Printer\BetterStandardPrinter;
use Rector\Core\ValueObject\Application\File;
use Rector\FileSystemRector\ValueObject\AddedFileWithContent;
use Symplify\SmartFileSystem\SmartFileInfo;

/**
 * @todo re-use in https://github.com/rectorphp/rector-src/blob/main/rules/PSR4/Rector/Namespace_/MultipleClassFileToPsr4ClassesRector.php
 *
 * Printer useful for printing classes next to just-processed one.
 * E.g. in case of extracting class to the same directory, just with different name.
 */
final class NeighbourClassLikePrinter
{
    public function __construct(
        private readonly BetterNodeFinder $betterNodeFinder,
        private readonly BetterStandardPrinter $betterStandardPrinter,
        private readonly RemovedAndAddedFilesCollector $removedAndAddedFilesCollector,
    ) {
    }

    public function printClassLike(
        ClassLike $classLike,
        Namespace_ | FileWithoutNamespace $mainNode,
        SmartFileInfo $smartFileInfo,
        ?File $file = null
    ): void {
        $declares = $this->resolveDeclares($mainNode, $file);

        if ($mainNode instanceof FileWithoutNamespace) {
            $nodesToPrint = array_merge($declares, [$classLike]);
        } else {
            // use new class in the namespace
            $mainNode->stmts = [$classLike];
            $nodesToPrint = array_merge($declares, [$mainNode]);
        }

        $fileDestination = $this->createClassLikeFileDestination($classLike, $smartFileInfo);

        $printedFileContent = $this->betterStandardPrinter->prettyPrintFile($nodesToPrint);

        $addedFileWithContent = new AddedFileWithContent($fileDestination, $printedFileContent);
        $this->removedAndAddedFilesCollector->addAddedFile($addedFileWithContent);
    }

    private function createClassLikeFileDestination(ClassLike $classLike, SmartFileInfo $smartFileInfo): string
    {
        $currentDirectory = dirname($smartFileInfo->getRealPath());
        return $currentDirectory . DIRECTORY_SEPARATOR . $classLike->name . '.php';
    }

    /**
     * @return Declare_[]
     */
    private function resolveDeclares(FileWithoutNamespace|Namespace_ $mainNode, ?File $file = null): array
    {
        $declare = $this->betterNodeFinder->findFirstPreviousOfTypes($mainNode, [Declare_::class], $file);
        if ($declare instanceof Declare_) {
            return [$declare];
        }

        return [];
    }
}
