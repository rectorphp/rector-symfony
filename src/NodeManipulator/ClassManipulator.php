<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeManipulator;

use PhpParser\Node\Stmt\Class_;
use Rector\NodeNameResolver\NodeNameResolver;

final readonly class ClassManipulator
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver
    ) {
    }

    /**
     * @param string[] $interfaceFQNS
     */
    public function removeImplements(Class_ $class, array $interfaceFQNS): void
    {
        foreach ($class->implements as $key => $implement) {
            if (! $this->nodeNameResolver->isNames($implement, $interfaceFQNS)) {
                continue;
            }

            unset($class->implements[$key]);
        }
    }
}
