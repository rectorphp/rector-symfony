<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use Rector\NodeNameResolver\NodeNameResolver;

final readonly class ClassAnalyzer
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver
    ) {
    }

    public function hasImplements(Class_ $class, string $interfaceFQN): bool
    {
        return array_any(
            $class->implements,
            fn (Name $name): bool => $this->nodeNameResolver->isName($name, $interfaceFQN)
        );
    }
}
