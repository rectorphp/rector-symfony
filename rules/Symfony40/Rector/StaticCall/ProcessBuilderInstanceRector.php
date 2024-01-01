<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony40\Rector\StaticCall;

use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Symfony40\Rector\StaticCall\ProcessBuilderInstanceRector\ProcessBuilderInstanceRectorTest
 */
final class ProcessBuilderInstanceRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Turns `ProcessBuilder::instance()` to new ProcessBuilder in Process in Symfony. Part of multi-step Rector.',
            [
                new CodeSample(
                    '$processBuilder = Symfony\Component\Process\ProcessBuilder::instance($args);',
                    '$processBuilder = new Symfony\Component\Process\ProcessBuilder($args);'
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [StaticCall::class];
    }

    /**
     * @param StaticCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $node->class instanceof Name) {
            return null;
        }

        if (! $this->isName($node->class, 'Symfony\Component\Process\ProcessBuilder')) {
            return null;
        }

        if (! $this->isName($node->name, 'create')) {
            return null;
        }

        return new New_($node->class, $node->args);
    }
}
