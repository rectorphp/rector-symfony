<?php

declare(strict_types=1);


namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name\FullyQualified;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class SwiftCreateMessageToNewEmailRector extends AbstractRector
{

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Changes SwiftMailer\'s createMessage into a new Symfony\Component\Mime\Email',
            [
            new CodeSample(
                <<<'CODE_SAMPLE'
public function createMessage()
{
    $email = $this->swift->createMessage('message');
}
CODE_SAMPLE,
                <<<'CODE_SAMPLE'
public function createMessage()
{
    $email = new \Symfony\Component\Mime\Email();
}
CODE_SAMPLE


            )
        ]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->isName($node->name, 'createMessage')) {
            return null;
        }

        return new New_(new FullyQualified('Symfony\Component\Mime\Email'));
    }
}
