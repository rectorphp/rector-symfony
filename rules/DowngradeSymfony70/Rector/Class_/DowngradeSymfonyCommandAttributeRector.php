<?php

declare(strict_types=1);

namespace Rector\Symfony\DowngradeSymfony70\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\DowngradeSymfony70\Rector\Class_\DowngradeSymfonyCommandAttributeRector\DowngradeSymfonyCommandAttributeRectorTest
 */
final class DowngradeSymfonyCommandAttributeRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Downgrade Symfony Command Attribute',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
#[AsCommand(name: 'app:create-user', description: 'some description')]
class CreateUserCommand extends Command
{}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
class CreateUserCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('app:create-user');
        $this->setDescription('some description');
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
        return null;
    }
}
