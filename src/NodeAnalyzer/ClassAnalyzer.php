<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

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
        foreach ($class->implements as $implement) {
            if ($this->nodeNameResolver->isName($implement, $interfaceFQN)) {
                return true;
            }
        }

        return false;
    }
}
