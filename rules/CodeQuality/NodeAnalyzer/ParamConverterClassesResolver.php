<?php

declare(strict_types=1);

namespace Rector\Symfony\CodeQuality\NodeAnalyzer;

use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Symfony\Enum\SensioAttribute;

final readonly class ParamConverterClassesResolver
{
    public function __construct(
        private AttributeFinder $attributeFinder,
        private ValueResolver $valueResolver,
    ) {
    }

    /**
     * @return string[]
     */
    public function resolveEntityClasses(ClassMethod $classMethod): array
    {
        $entityClasses = [];

        $paramConverterAttributes = $this->attributeFinder->findManyByClass(
            $classMethod,
            SensioAttribute::PARAM_CONVERTER
        );
        foreach ($paramConverterAttributes as $paramConverterAttribute) {
            foreach ($paramConverterAttribute->args as $arg) {
                if (! $arg->name instanceof Identifier) {
                    continue;
                }

                if ($arg->name->toString() !== 'class') {
                    continue;
                }

                $entityClass = $this->valueResolver->getValue($arg->value);
                if (! is_string($entityClass)) {
                    continue;
                }

                $entityClasses[] = $entityClass;
            }
        }

        return $entityClasses;
    }
}
