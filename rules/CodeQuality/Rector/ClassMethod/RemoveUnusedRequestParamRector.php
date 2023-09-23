<?php

declare(strict_types=1);

namespace Rector\Symfony\CodeQuality\Rector\ClassMethod;

use PhpParser\Node;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Type\ObjectType;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\Reflection\ReflectionResolver;
use Rector\FamilyTree\NodeAnalyzer\ClassChildAnalyzer;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RemoveUnusedRequestParamRector\RemoveUnusedRequestParamRectorTest
 */
final class RemoveUnusedRequestParamRector extends AbstractRector
{
    public function __construct(
        private readonly ControllerAnalyzer $controllerAnalyzer,
        private readonly ReflectionResolver $reflectionResolver,
        private readonly ClassChildAnalyzer $classChildAnalyzer,
        private readonly BetterNodeFinder $betterNodeFinder,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Remove unused $request parameter from controller action', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeController extends Controller
{
    public function run(Request $request, int $id)
    {
        echo $id;
    }
}
CODE_SAMPLE

                ,
                <<<'CODE_SAMPLE'
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeController extends Controller
{
    public function run(int $id)
    {
        echo $id;
    }
}
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $node->isPublic()) {
            return null;
        }

        if ($node->isAbstract() || $this->hasAbstractParentClassMethod($node)) {
            return null;
        }

        if (! $this->controllerAnalyzer->isInsideController($node)) {
            return null;
        }

        if ($node->getParams() === []) {
            return null;
        }

        // skip empty method
        if ($node->stmts === null) {
            return null;
        }

        foreach ($node->getParams() as $paramPosition => $param) {
            if (! $param->type instanceof Node) {
                continue;
            }

            if (! $this->isObjectType($param->type, new ObjectType('Symfony\Component\HttpFoundation\Request'))) {
                continue;
            }

            /** @var string $requestParamName */
            $requestParamName = $this->getName($param);

            // we have request param here
            $requestVariable = $this->betterNodeFinder->findVariableOfName($node->stmts, $requestParamName);

            // is variable used?
            if ($requestVariable instanceof Variable) {
                return null;
            }

            unset($node->params[$paramPosition]);
            return $node;
        }

        return null;
    }

    private function hasAbstractParentClassMethod(ClassMethod $classMethod): bool
    {
        $classReflection = $this->reflectionResolver->resolveClassReflection($classMethod);
        if (! $classReflection instanceof ClassReflection) {
            return false;
        }

        return $this->classChildAnalyzer->hasAbstractParentClassMethod($classReflection, $this->getName($classMethod));
    }
}
