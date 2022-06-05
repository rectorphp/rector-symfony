<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer\FormType;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\New_;
use PHPStan\Type\TypeWithClassName;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeTypeResolver\NodeTypeResolver;

final class FormTypeClassResolver
{
    public function __construct(
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly NodeTypeResolver $nodeTypeResolver,
    ) {
    }

    public function resolveFromExpr(Expr $expr): ?string
    {
        if ($expr instanceof New_) {
            // we can only process direct name
            return $this->nodeNameResolver->getName($expr->class);
        }

        $exprType = $this->nodeTypeResolver->getType($expr);
        if ($exprType instanceof TypeWithClassName) {
            return $exprType->getClassName();
        }

        return null;
    }
}
