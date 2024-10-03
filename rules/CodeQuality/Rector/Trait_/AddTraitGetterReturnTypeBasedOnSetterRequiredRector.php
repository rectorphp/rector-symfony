<?php

declare(strict_types=1);

namespace Rector\Symfony\CodeQuality\Rector\Trait_;

use PhpParser\Node;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Return_;
use PhpParser\Node\Stmt\Trait_;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\CodeQuality\Rector\Trait_\AddTraitGetterReturnTypeBasedOnSetterRequiredRector\AddTraitGetterReturnTypeBasedOnSetterRequiredRectorTest
 */
final class AddTraitGetterReturnTypeBasedOnSetterRequiredRector extends AbstractRector
{
    public function __construct(private readonly PhpDocInfoFactory $phpDocInfoFactory)
    {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Add trait getter return type based on setter with @required annotation',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use stdClass;

trait SomeTrait
{
    private $service;

    public function getService()
    {
        return $this->service;
    }

    /**
     * @required
     */
    public function setService(stdClass $stdClass)
    {
        $this->stdClass = $stdClass;
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use stdClass;

trait SomeTrait
{
    private $service;

    public function getService(): stdClass
    {
        return $this->service;
    }

    /**
     * @required
     */
    public function setService(stdClass $stdClass)
    {
        $this->stdClass = $stdClass;
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
        return [Trait_::class];
    }

    /**
     * @param Trait_ $node
     */
    public function refactor(Node $node): ?Node
    {
        $methods = $node->getMethods();

        if (count($methods) !== 2) {
            return null;
        }

        $props = $node->getProperties();
        if (count($props) !== 1) {
            return null;
        }

        $getMethod = null;

        foreach ($methods as $method) {
            $methodName = (string) $this->getName($method);

            if (! str_starts_with($methodName, 'set')) {
                continue;
            }

            $getterMethod = 'get' . ltrim($methodName, 'set');
            $getMethod = $node->getMethod($getterMethod);

            // getter for setter is not exists
            if (! $getMethod instanceof ClassMethod) {
                return null;
            }

            // already returned
            if ($getMethod->returnType instanceof Node) {
                return null;
            }

            if (count($method->getStmts()) !== 1) {
                return null;
            }

            $phpDocInfo = $this->phpDocInfoFactory->createFromNode($method);
            if (! $phpDocInfo->hasByName('required')) {
                return null;
            }

            if (count($method->params) !== 1) {
                return null;
            }

            if (! $method->params[0]->type instanceof Node) {
                return null;
            }

            $stmts = $method->getStmts();
            if (! $stmts[0] instanceof Expression || ! $stmts[0]->expr instanceof Assign || ! $stmts[0]->expr->var instanceof PropertyFetch || ! $this->nodeComparator->areNodesEqual($stmts[0]->expr->expr, $method->params[0]->var)) {
                return null;
            }

            $getterStmts = $getMethod->getStmts();
            if (count($getterStmts) !== 1) {
                return null;
            }

            if (! $getterStmts[0] instanceof Return_ || ! $getterStmts[0]->expr instanceof PropertyFetch) {
                return null;
            }

            $getMethod->returnType = $method->params[0]->type;
            return $node;
        }

        return null;
    }
}
