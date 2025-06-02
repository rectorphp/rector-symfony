<?php

declare(strict_types=1);

namespace Rector\Symfony\TypeDeclaration;

use PhpParser\Node;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode;
use PHPStan\Type\ObjectType;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Php\PhpVersionProvider;
use Rector\StaticTypeMapper\StaticTypeMapper;
use Rector\ValueObject\PhpVersionFeature;

final readonly class ReturnTypeDeclarationUpdater
{
    public function __construct(
        private PhpVersionProvider $phpVersionProvider,
        private StaticTypeMapper $staticTypeMapper,
        private PhpDocInfoFactory $phpDocInfoFactory,
        private DocBlockUpdater $docBlockUpdater,
    ) {
    }

    /**
     * @param class-string $className
     */
    public function updateClassMethod(ClassMethod $classMethod, string $className): void
    {
        $this->removeReturnDocBlocks($classMethod);
        $this->updatePhp($classMethod, $className);
    }

    private function removeReturnDocBlocks(ClassMethod $classMethod): void
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($classMethod);
        $phpDocInfo->removeByType(ReturnTagValueNode::class);

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($classMethod);
    }

    /**
     * @param class-string $className
     */
    private function updatePhp(ClassMethod $classMethod, string $className): void
    {
        if (! $this->phpVersionProvider->isAtLeastPhpVersion(PhpVersionFeature::SCALAR_TYPES)) {
            return;
        }

        $objectType = new ObjectType($className);

        // change return type
        if ($classMethod->returnType instanceof Node) {
            $returnType = $this->staticTypeMapper->mapPhpParserNodePHPStanType($classMethod->returnType);
            if ($objectType->isSuperTypeOf($returnType)->yes()) {
                return;
            }
        }

        $classMethod->returnType = new FullyQualified($className);
    }
}
