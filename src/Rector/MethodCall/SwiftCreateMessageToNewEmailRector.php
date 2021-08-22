<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\PropertyProperty;
use PHPStan\Type\ObjectType;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\MethodCall\SwiftCreateMessageToNewEmailRector\SwiftCreateMessageToNewEmailRectorTest
 */
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
CODE_SAMPLE
,
                    <<<'CODE_SAMPLE'
public function createMessage()
{
    $email = new \Symfony\Component\Mime\Email();
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
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($this->shouldSkip($node)) {
            return null;
        }

        return new New_(new FullyQualified('Symfony\Component\Mime\Email'));
    }

    private function shouldSkip(MethodCall $methodCall): bool
    {
        if (! $this->isName($methodCall->name, 'createMessage')) {
            return true;
        }

        // If there is no property with a SwiftMailer type we should skip this class
        $swiftMailerProperty = $this->getSwiftMailerProperty($methodCall);
        if ($swiftMailerProperty === null) {
            return true;
        }

        /** @var PropertyFetch $var */
        $var = $methodCall->var;
        if (! $var instanceof PropertyFetch) {
            return true;
        }

        $propertyName = $this->getPropertyIdentifier($swiftMailerProperty->props);
        return ! $this->isName($var->name, $propertyName);
    }

    private function getSwiftMailerProperty(MethodCall $classMethod): ?Property
    {
        /** @var Class_ $class */
        $class = $classMethod->getAttribute(AttributeKey::CLASS_NODE);

        if (! $class instanceof Class_) {
            return null;
        }

        $properties = $class->getProperties();
        foreach ($properties as $property) {
            /** @var ObjectType $resolved */
            $resolved = $this->nodeTypeResolver->resolve($property);
            if (! $resolved instanceof ObjectType) {
                continue;
            }
            if ($resolved->getClassName() === 'Swift_Mailer') {
                return $property;
            }
        }

        return null;
    }

    /**
     * @param PropertyProperty[] $propertyProperties
     */
    private function getPropertyIdentifier(array $propertyProperties): string
    {
        foreach ($propertyProperties as $propertyProperty) {
            return (string) $propertyProperty->name;
        }

        throw new ShouldNotHappenException();
    }
}
