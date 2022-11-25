<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\ClassMethod;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Attribute;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Core\Configuration\RenamedClassesDataCollector;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\ValueObject\PhpVersionFeature;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
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
        private readonly AttributeFinder $attributeFinder,
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
        if (! $this->phpAttributeAnalyzer->hasPhpAttribute($node, self::PARAM_CONVERTER_CLASS)) {
            return null;
        }

        if (! $node->isPublic()) {
            return null;
        }

        return $this->refactorParamConverter($node);
    }

    private function refactorParamConverter(ClassMethod $classMethod): ?Node
    {
        $attribute = $this->attributeFinder->findAttributeByClass($classMethod, self::PARAM_CONVERTER_CLASS);
        if (! $attribute instanceof Attribute) {
            return null;
        }

        $this->renamedClassesDataCollector->addOldToNewClasses([
            self::PARAM_CONVERTER_CLASS => self::MAP_ENTITY_CLASS,
        ]);

        if ($attribute->args[1]->name->name !== 'options') {
            return null;
        }

        $mapping = $attribute->args[1]->value;

        if (! $mapping instanceof Array_) {
            return null;
        }

        $name = $attribute->args[0]->value->value;
        $this->removeNode($attribute->args[0]);

        $attribute->args = [new Arg($mapping->items[0]->value, name: new Identifier($mapping->items[0]->key->value))];

        $node = $attribute->getAttribute(AttributeKey::PARENT_NODE);

        $this->addMapEntityAttribute($classMethod, $name, $node);
        $this->removeNode($node);

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
}
