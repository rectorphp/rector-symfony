<?php

declare(strict_types=1);

namespace Rector\Symfony\CodeQuality\Rector\ClassMethod;

use Rector\StaticTypeMapper\StaticTypeMapper;
use PhpParser\Node;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Core\Rector\AbstractRector;
use Rector\PHPStanStaticTypeMapper\Enum\TypeKind;
use Rector\Symfony\NodeAnalyzer\RouteRequiredParamNameToTypesResolver;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ParamTypeFromRouteRequiredRegexRector\ParamTypeFromRouteRequiredRegexRectorTest
 */
final class ParamTypeFromRouteRequiredRegexRector extends AbstractRector
{
    public function __construct(
        private readonly ControllerAnalyzer $controllerAnalyzer,
        private readonly RouteRequiredParamNameToTypesResolver $routeRequiredParamNameToTypesResolver,
        private readonly StaticTypeMapper $staticTypeMapper
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Complete strict param type declaration based on route annotation', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

final class SomeController extends Controller
{
    /**
     * @Route(
     *     requirements={"number"="\d+"},
     * )
     */
    public function detailAction($number)
    {
    }
}
CODE_SAMPLE

                ,
                <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

final class SomeController extends Controller
{
    /**
     * @Route(
     *     requirements={"number"="\d+"},
     * )
     */
    public function detailAction(int $number)
    {
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

        if (! $this->controllerAnalyzer->isInsideController($node)) {
            return null;
        }

        $paramsToTypes = $this->routeRequiredParamNameToTypesResolver->resolve($node);
        if ($paramsToTypes === []) {
            return null;
        }

        $hasChanged = false;

        foreach ($paramsToTypes as $paramName => $paramType) {
            $param = $this->findParamByName($node, $paramName);
            if (! $param instanceof Param) {
                continue;
            }

            if ($param->type !== null) {
                continue;
            }

            $param->type = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($paramType, TypeKind::PARAM);

            $hasChanged = true;
        }

        if (! $hasChanged) {
            return null;
        }

        return $node;
    }

    private function findParamByName(ClassMethod $classMethod, string $paramName): ?Param
    {
        foreach ($classMethod->getParams() as $param) {
            if (! $this->isName($param, $paramName)) {
                continue;
            }

            return $param;
        }

        return null;
    }
}
