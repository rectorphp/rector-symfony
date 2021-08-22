<?php

declare(strict_types=1);


namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class SwiftCreateMessageToNewEmailRector extends AbstractRector
{

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('', []);
    }

    public function getNodeTypes(): array
    {
        return [
            Node\Expr\MethodCall::class
        ];
    }

    /**
     * @var Node\Expr\MethodCall $node
     */
    public function refactor(Node $node)
    {
        if (!$this->isName($node->name, 'createMessage')) {
            return null;
        }

        $newEmail = new Node\Expr\New_(new Node\Name\FullyQualified('Symfony\Component\Mime\Email'));

        return new Node\Expr\MethodCall($newEmail, 'subject');
    }
}
