<?php

declare(strict_types=1);

namespace Rector\Symfony\Bridge\NodeAnalyzer;

use PhpParser\Node\Stmt\ClassMethod;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Php80\NodeAnalyzer\PhpAttributeAnalyzer;
use Rector\Symfony\Enum\SymfonyAttribute;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;

final readonly class ControllerMethodAnalyzer
{
    public function __construct(
        private ControllerAnalyzer $controllerAnalyzer,
        private PhpDocInfoFactory $phpDocInfoFactory,
        private PhpAttributeAnalyzer $phpAttributeAnalyzer
    ) {
    }

    /**
     * Detect if is <some>Action() in Controller
     */
    public function isAction(ClassMethod $classMethod): bool
    {
        if (! $this->controllerAnalyzer->isInsideController($classMethod)) {
            return false;
        }

        if ($classMethod->isPublic() && ! $classMethod->isStatic()) {
            $phpDocInfo = $this->phpDocInfoFactory->createFromNode($classMethod);
            if ($phpDocInfo instanceof PhpDocInfo && $phpDocInfo->hasByName('required')) {
                return false;
            }

            return ! $this->phpAttributeAnalyzer->hasPhpAttribute($classMethod, SymfonyAttribute::REQUIRED);
        }

        return false;
    }
}
