<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\New_;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\BinaryOp\Concat;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Scalar\String_;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use Rector\Core\PhpParser\NodeTransformer;
use Rector\Core\Rector\AbstractRector;
use Symfony\Component\Console\Input\StringInput;
use Symplify\PackageBuilder\Reflection\PrivatesCaller;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://github.com/symfony/symfony/pull/27821/files
 * @see \Rector\Symfony\Tests\Rector\New_\StringToArrayArgumentProcessRector\StringToArrayArgumentProcessRectorTest
 */
final class StringToArrayArgumentProcessRector extends AbstractRector
{
    public function __construct(
        private NodeTransformer $nodeTransformer
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Changes Process string argument to an array',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Component\Process\Process;
$process = new Process('ls -l');
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Component\Process\Process;
$process = new Process(['ls', '-l']);
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
        return [New_::class, MethodCall::class];
    }

    /**
     * @param New_|MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        $expr = $node instanceof New_ ? $node->class : $node->var;

        if ($this->isObjectType($expr, new ObjectType('Symfony\Component\Process\Process'))) {
            return $this->processArgumentPosition($node, 0);
        }

        if ($this->isObjectType($expr, new ObjectType('Symfony\Component\Console\Helper\ProcessHelper'))) {
            return $this->processArgumentPosition($node, 1);
        }

        return null;
    }

    /**
     * @param New_|MethodCall $node
     */
    private function processArgumentPosition(Node $node, int $argumentPosition): ?Node
    {
        if (! isset($node->args[$argumentPosition])) {
            return null;
        }

        $firstArgument = $node->args[$argumentPosition]->value;
        if ($firstArgument instanceof Array_) {
            return null;
        }

        // type analyzer
        if ($this->nodeTypeResolver->isStaticType($firstArgument, StringType::class)) {
            $this->processStringType($node, $argumentPosition, $firstArgument);
        }

        return $node;
    }

    /**
     * @param New_|MethodCall $expr
     */
    private function processStringType(Expr $expr, int $argumentPosition, Expr $firstArgumentExpr): void
    {
        if ($firstArgumentExpr instanceof Concat) {
            $arrayNode = $this->nodeTransformer->transformConcatToStringArray($firstArgumentExpr);
            if ($arrayNode !== null) {
                $expr->args[$argumentPosition] = new Arg($arrayNode);
            }

            return;
        }

        if ($firstArgumentExpr instanceof FuncCall && $this->isName($firstArgumentExpr, 'sprintf')) {
            $arrayNode = $this->nodeTransformer->transformSprintfToArray($firstArgumentExpr);
            if ($arrayNode !== null) {
                $expr->args[$argumentPosition]->value = $arrayNode;
            }
        } elseif ($firstArgumentExpr instanceof String_) {
            $parts = $this->splitProcessCommandToItems($firstArgumentExpr->value);
            $expr->args[$argumentPosition]->value = $this->nodeFactory->createArray($parts);
        }

        $this->processPreviousAssign($expr, $firstArgumentExpr);
    }

    /**
     * @return string[]
     */
    private function splitProcessCommandToItems(string $process): array
    {
        $privatesCaller = new PrivatesCaller();
        return $privatesCaller->callPrivateMethod(new StringInput(''), 'tokenize', [$process]);
    }

    private function processPreviousAssign(Node $node, Expr $firstArgumentExpr): void
    {
        $assign = $this->findPreviousNodeAssign($node, $firstArgumentExpr);
        if (! $assign instanceof Assign) {
            return;
        }

        if (! $assign->expr instanceof FuncCall) {
            return;
        }

        $funcCall = $assign->expr;

        if (! $this->nodeNameResolver->isName($funcCall, 'sprintf')) {
            return;
        }

        $arrayNode = $this->nodeTransformer->transformSprintfToArray($funcCall);
        if ($arrayNode !== null) {
            $assign->expr = $arrayNode;
        }
    }

    private function findPreviousNodeAssign(Node $node, Expr $firstArgumentExpr): ?Assign
    {
        /** @var Assign|null $assign */
        $assign = $this->betterNodeFinder->findFirstPrevious($node, function (Node $checkedNode) use (
            $firstArgumentExpr
        ): ?Assign {
            if (! $checkedNode instanceof Assign) {
                return null;
            }

            if (! $this->nodeComparator->areNodesEqual($checkedNode->var, $firstArgumentExpr)) {
                return null;
            }

            return $checkedNode;
        });

        return $assign;
    }
}
