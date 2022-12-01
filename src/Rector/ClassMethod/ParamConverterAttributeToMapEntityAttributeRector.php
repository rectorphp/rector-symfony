<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\ClassMethod;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Attribute;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Core\Configuration\RenamedClassesDataCollector;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\ValueObject\PhpVersionFeature;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\Php80\NodeAnalyzer\PhpAttributeAnalyzer;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://symfony.com/blog/new-in-symfony-6-2-built-in-cache-security-template-and-doctrine-attributes
 *
 * @see \Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\ParamConverterAttributeToMapEntityAttributeRectorTest
 */
final class ParamConverterAttributeToMapEntityAttributeRector extends AbstractRector implements MinPhpVersionInterface
{
    private const PARAM_CONVERTER_CLASS = 'Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter';

    private const MAP_ENTITY_CLASS = 'Symfony\Bridge\Doctrine\Attribute\MapEntity';

    public function __construct(
        private readonly PhpAttributeAnalyzer $phpAttributeAnalyzer,
        private readonly RenamedClassesDataCollector $renamedClassesDataCollector
    ) {
    }

    public function provideMinPhpVersion(): int
    {
        return PhpVersionFeature::ATTRIBUTES;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replace ParamConverter attribute with mappings with the MapEntity attribute',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
class SomeController
{
    #[Route('/blog/{date}/{slug}/comments/{comment_slug}')]
    #[ParamConverter('post', options: ['mapping' => ['date' => 'date', 'slug' => 'slug']])]
    #[ParamConverter('comment', options: ['mapping' => ['comment_slug' => 'slug']])]
    public function showComment(
        Post $post,
        Comment $comment
    ) {
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
class SomeController
{
    #[Route('/blog/{date}/{slug}/comments/{comment_slug}')]
    public function showComment(
        #[\Symfony\Bridge\Doctrine\Attribute\MapEntity(mapping: ['date' => 'date', 'slug' => 'slug'])] Post $post,
        #[\Symfony\Bridge\Doctrine\Attribute\MapEntity(mapping: ['comment_slug' => 'slug'])] Comment $comment
    ) {
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
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        if (
            ! $node instanceof ClassMethod ||
            ! $node->isPublic() ||
            ! $this->phpAttributeAnalyzer->hasPhpAttribute($node, self::PARAM_CONVERTER_CLASS)
        ) {
            return null;
        }

        return $this->refactorParamConverter($node);
    }

    private function refactorParamConverter(ClassMethod $classMethod): Node
    {
        foreach ($classMethod->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                if ($this->isName($attr, self::PARAM_CONVERTER_CLASS)) {
                    $this->refactorAttribute($classMethod, $attr);
                }
            }
        }

        $this->renamedClassesDataCollector->addOldToNewClasses([
            self::PARAM_CONVERTER_CLASS => self::MAP_ENTITY_CLASS,
        ]);

        return $classMethod;
    }

    private function addMapEntityAttribute(
        ClassMethod $classMethod,
        string $variableName,
        AttributeGroup $attributeGroup
    ): void {
        foreach ($classMethod->params as $param) {
            if (! $param->var instanceof Variable) {
                continue;
            }
            if ($variableName === $param->var->name) {
                $param->attrGroups = [$attributeGroup];
            }
        }
    }

    private function refactorAttribute(ClassMethod $classMethod, Attribute $attribute): void
    {
        if (
            $attribute->args === [] ||
            ! $attribute->args[1]->name instanceof Identifier ||
            $attribute->args[1]->name->name !== 'options' ||
            ! $attribute->args[0]->value instanceof String_
        ) {
            return;
        }

        $name = $attribute->args[0]->value->value;

        $mapping = $attribute->args[1]->value;

        if (! $mapping instanceof Array_) {
            return;
        }
        $this->removeNode($attribute->args[0]);

        $newArguments = [];
        foreach ($mapping->items as $item) {
            if (
                ! $item instanceof ArrayItem ||
                ! $item->key instanceof String_
            ) {
                continue;
            }
            $newArguments[] = new Arg($item->value, name: new Identifier($item->key->value));
        }

        $attribute->args = $newArguments;

        $node = $attribute->getAttribute(AttributeKey::PARENT_NODE);
        if (! $node instanceof AttributeGroup) {
            return;
        }

        $this->addMapEntityAttribute($classMethod, $name, $node);
        $this->removeNode($node);
    }
}
