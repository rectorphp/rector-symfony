<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony61\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\ObjectType;
use Rector\Php80\NodeAnalyzer\PhpAttributeAnalyzer;
use Rector\PhpAttribute\NodeFactory\PhpAttributeGroupFactory;
use Rector\Rector\AbstractRector;
use Rector\Symfony\Enum\SymfonyAnnotation;
use Rector\Symfony\NodeAnalyzer\Command\AttributeValueResolver;
use Rector\Symfony\NodeAnalyzer\Command\SetAliasesMethodCallExtractor;
use Rector\ValueObject\PhpVersionFeature;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://symfony.com/doc/current/console.html#registering-the-command
 *
 * @see \Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\CommandConfigureToAttributeRectorTest
 */
final class CommandConfigureToAttributeRector extends AbstractRector implements MinPhpVersionInterface
{
    public function __construct(
        private readonly PhpAttributeGroupFactory $phpAttributeGroupFactory,
        private readonly PhpAttributeAnalyzer $phpAttributeAnalyzer,
        private readonly AttributeValueResolver $attributeValueResolver,
        private readonly ReflectionProvider $reflectionProvider,
        private readonly SetAliasesMethodCallExtractor $setAliasesMethodCallExtractor,
    ) {
    }

    public function provideMinPhpVersion(): int
    {
        return PhpVersionFeature::ATTRIBUTES;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Add Symfony\Component\Console\Attribute\AsCommand to Symfony Commands from configure()',
            [
                new CodeSample(<<<'CODE_SAMPLE'
use Symfony\Component\Console\Command\Command;

final class SunshineCommand extends Command
{
    public function configure()
    {
        $this->setName('sunshine');
    }
}
CODE_SAMPLE
                    , <<<'CODE_SAMPLE'
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand('sunshine')]
final class SunshineCommand extends Command
{
}
CODE_SAMPLE),

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
        if (! $this->isObjectType($node, new ObjectType('Symfony\\Component\\Console\\Command\\Command'))) {
            return null;
        }

        if (! $this->reflectionProvider->hasClass(SymfonyAnnotation::AS_COMMAND)) {
            return null;
        }

        // already converted
        if ($this->phpAttributeAnalyzer->hasPhpAttribute($node, SymfonyAnnotation::AS_COMMAND)) {
            return null;
        }

        $configureClassMethod = $node->getMethod('configure');
        if (! $configureClassMethod instanceof ClassMethod) {
            return null;
        }

        // @todo resolve name, description, aliases, etc.

        $asCommandAttribute = $this->phpAttributeGroupFactory->createFromClassWithItems(
            SymfonyAnnotation::AS_COMMAND,
            []
        );

        $node->attrGroups[] = $asCommandAttribute;

        return $node;
    }
}
