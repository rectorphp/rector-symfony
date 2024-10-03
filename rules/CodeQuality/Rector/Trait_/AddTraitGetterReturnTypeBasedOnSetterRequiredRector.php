<?php

declare(strict_types=1);

namespace Rector\Symfony\CodeQuality\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Trait_;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\CodeQuality\Rector\Class_\AddTraitGetterReturnTypeBasedOnSetterRequiredRector\AddTraitGetterReturnTypeBasedOnSetterRequiredRectorTest
 */
final class AddTraitGetterReturnTypeBasedOnSetterRequiredRector extends AbstractRector
{
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
        if ($node->getMethods() !== 2) {
            return null;
        }

        return $node;
    }
}
