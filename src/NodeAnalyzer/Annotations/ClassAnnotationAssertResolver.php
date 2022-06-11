<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer\Annotations;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Stmt;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\Core\Exception\NotImplementedYetException;
use Rector\Symfony\NodeFactory\Annotations\DoctrineAnnotationFromNewFactory;

final class ClassAnnotationAssertResolver
{
    public function __construct(
        private readonly StmtMethodCallMatcher $stmtMethodCallMatcher,
        private readonly DoctrineAnnotationFromNewFactory $doctrineAnnotationFromNewFactory,
    ) {
    }

    public function resolve(Stmt $stmt): ?DoctrineAnnotationTagValueNode
    {
        $methodCall = $this->stmtMethodCallMatcher->match($stmt, 'addConstraint');
        if (! $methodCall instanceof MethodCall) {
            return null;
        }

        $args = $methodCall->getArgs();
        $firstArgValue = $args[0]->value;

        if (! $firstArgValue instanceof New_) {
            throw new NotImplementedYetException();
        }

        return $this->doctrineAnnotationFromNewFactory->create($firstArgValue);
    }
}
