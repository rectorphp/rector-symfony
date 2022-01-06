<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\ClassMethod;

use PhpParser\Node;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\Core\Rector\AbstractRector;
use Rector\DeadCode\PhpDoc\TagRemover\ParamTagRemover;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\PHPStanStaticTypeMapper\Enum\TypeKind;
use Rector\TypeDeclaration\NodeAnalyzer\ControllerRenderMethodAnalyzer;
use Rector\TypeDeclaration\TypeInferer\ParamTypeInferer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\ClassMethod\RenderMethodParamToTypeDeclarationRector\RenderMethodParamToTypeDeclarationRectorTest
 */
final class RenderMethodParamToTypeDeclarationRector extends AbstractRector
{
    private bool $hasChanged = false;

    public function __construct(
        private readonly ParamTypeInferer $paramTypeInferer,
        private readonly ParamTagRemover $paramTagRemover,
        private readonly ControllerRenderMethodAnalyzer $controllerRenderMethodAnalyzer,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Move @param docs on render() method in Symfony controller to strict type declaration',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SomeController extends AbstractController
{
    /**
     * @Route()
     * @param string $name
     */
    public function render($name)
    {
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SomeController extends AbstractController
{
    /**
     * @Route()
     */
    public function render(string $name)
    {
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
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node)
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($node);
        if (! $phpDocInfo instanceof PhpDocInfo) {
            return null;
        }

        $scope = $node->getAttribute(AttributeKey::SCOPE);
        if (! $this->controllerRenderMethodAnalyzer->isRenderMethod($node, $scope)) {
            return null;
        }

        // $node->getParams()
        foreach ($node->params as $param) {
            $this->refactorParam($param, $phpDocInfo, $node);
        }

        if ($this->hasChanged) {
            return $node;
        }

        return null;
    }

    private function refactorParam(Param $param, PhpDocInfo $phpDocInfo, ClassMethod $classMethod): void
    {
        if ($param->type !== null) {
            return;
        }

        $inferedType = $this->paramTypeInferer->inferParam($param);

        $paramType = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($inferedType, TypeKind::PARAM());

        if (! $paramType instanceof Node) {
            return;
        }

        $param->type = $paramType;
        $this->hasChanged = true;

        $this->paramTagRemover->removeParamTagsIfUseless($phpDocInfo, $classMethod);
    }
}
