<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Reflection\Php\PhpMethodReflection;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\Reflection\ReflectionResolver;
use Rector\NodeCollector\NodeAnalyzer\ArrayCallableMethodMatcher;
use Rector\NodeCollector\ValueObject\ArrayCallable;
use Rector\Php72\NodeFactory\AnonymousFunctionFactory;
use Rector\Privatization\NodeManipulator\VisibilityManipulator;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\Class_\MagicClosureTwigExtensionToNativeMethodsRector\MagicClosureTwigExtensionToNativeMethodsRectorTest
 */
final class MagicClosureTwigExtensionToNativeMethodsRector extends AbstractRector
{
    public function __construct(
        private readonly AnonymousFunctionFactory $anonymousFunctionFactory,
        private readonly ReflectionResolver $reflectionResolver,
        private readonly ArrayCallableMethodMatcher $arrayCallableMethodMatcher,
        private readonly VisibilityManipulator $visibilityManipulator,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change TwigExtension function/filter magic closures to inlined and clear callables',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TerminologyExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('resolve', [$this, 'resolve']);
        ];
    }


    private function resolve($value)
    {
        return $value + 100;
    }
}
CODE_SAMPLE

                    ,
                    <<<'CODE_SAMPLE'
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TerminologyExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('resolve', function ($values) {
                return $value + 100;
            }),
        ];
    }
}
CODE_SAMPLE
                ),

            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->nodeTypeResolver->isObjectTypes($node, [
            new ObjectType('Twig_ExtensionInterface'),
            new ObjectType('Twig\Extension\ExtensionInterface'),
        ])) {
            return null;
        }

        $hasFunctionsChanged = false;

        $getFunctionsClassMethod = $node->getMethod('getFunctions');
        if ($getFunctionsClassMethod instanceof ClassMethod) {
            $hasFunctionsChanged = $this->refactorClassMethod($node, $getFunctionsClassMethod);
        }

        $hasFiltersChanged = false;
        $getFiltersClassMethod = $node->getMethod('getFilters');
        if ($getFiltersClassMethod instanceof ClassMethod) {
            $hasFiltersChanged = $this->refactorClassMethod($node, $getFiltersClassMethod);
        }

        if ($hasFiltersChanged || $hasFunctionsChanged) {
            return $node;
        }

        return null;
    }

    private function refactorClassMethod(Class_ $class, ClassMethod $classMethod): bool
    {
        $hasChanged = false;

        $this->traverseNodesWithCallable($classMethod, function (Node $node) use (&$hasChanged, $class): ?Node {
            if (! $node instanceof Array_) {
                return null;
            }

            $arrayCallable = $this->arrayCallableMethodMatcher->match($node);
            if (! $arrayCallable instanceof ArrayCallable) {
                return null;
            }

            $phpMethodReflection = $this->reflectionResolver->resolveMethodReflection(
                $arrayCallable->getClass(),
                $arrayCallable->getMethod(),
                null
            );

            if (! $phpMethodReflection instanceof PhpMethodReflection) {
                return null;
            }

            $closure = $this->anonymousFunctionFactory->createFromPhpMethodReflection(
                $phpMethodReflection,
                $arrayCallable->getCallerExpr()
            );

            if (! $closure instanceof Closure) {
                return null;
            }
            // make method private, if local one
            $localClassMethod = $class->getMethod($arrayCallable->getMethod());
            if ($localClassMethod instanceof ClassMethod) {
                $stmtsCount = count((array) $localClassMethod->stmts);
                if ($stmtsCount === 1) {
                    // inline and remove method
                    $closure->stmts = $localClassMethod->stmts;
                    $this->removeNode($localClassMethod);
                } else {
                    $this->visibilityManipulator->makePrivate($localClassMethod);
                }
            }

            $hasChanged = true;

            return $closure;
        });

        return $hasChanged;
    }
}
