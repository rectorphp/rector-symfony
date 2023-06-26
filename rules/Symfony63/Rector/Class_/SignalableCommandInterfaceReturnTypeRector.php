<?php

namespace Rector\Symfony\Symfony63\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\PHPStanStaticTypeMapper\Enum\TypeKind;
use Rector\Symfony\NodeAnalyzer\ClassAnalyzer;
use Rector\VendorLocker\ParentClassMethodTypeOverrideGuard;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Symfony63\Rector\Class_\SignalableCommandInterfaceReturnTypeRector\SignalableCommandInterfaceReturnTypeRectorTest
 */
final class SignalableCommandInterfaceReturnTypeRector extends \Rector\Core\Rector\AbstractRector
{

    public function __construct(
        private readonly ClassAnalyzer $classAnalyzer,
        private readonly ParentClassMethodTypeOverrideGuard $parentClassMethodTypeOverrideGuard
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Return int or false from SignalableCommandInterface::handleSignal() instead of void',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
    public function handleSignal(int $signal): void
    {
    }
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'

    public function handleSignal(int $signal): int|false
    {
        return false;
    }
CODE_SAMPLE
                ),

            ]
        );
    }

    /**
     * @inheritDoc
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
        if ( ! $this->classAnalyzer->hasImplements($node, 'Symfony\Component\Console\Command\SignalableCommandInterface')) {
            return null;
        }

        $handleSignalMethod = $node->getMethod('handleSignal');
        if (null === $handleSignalMethod) {
            return null;
        }

        $newType = new \PHPStan\Type\UnionType([new \PHPStan\Type\IntegerType(), new \PHPStan\Type\Constant\ConstantBooleanType(false)]);
        if ($this->parentClassMethodTypeOverrideGuard->shouldSkipReturnTypeChange($handleSignalMethod, $newType)) {
            return null;
        }

        $handleSignalMethod->returnType = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($newType, TypeKind::RETURN);

        $handleSignalMethod->stmts[] = new Node\Stmt\Return_($this->nodeFactory->createFalse());

        return $node;
    }
}
