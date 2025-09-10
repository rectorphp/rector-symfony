<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\NodeTransformer;

use PhpParser\Node\Stmt\ClassMethod;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\PhpParser\Node\Value\ValueResolver;

final readonly class OutputInputSymfonyStyleReplacer
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver,
        private ValueResolver $valueResolver,
    ) {
    }

    public function replace(ClassMethod $executeClassMethod): void
    {
        dump(123);
        die;
    }
}
