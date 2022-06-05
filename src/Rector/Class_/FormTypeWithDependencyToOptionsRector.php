<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://speakerdeck.com/webmozart/symfony-forms-101?slide=24
 *
 * @see \Rector\Symfony\Tests\Rector\Class_\FormTypeWithDependencyToOptionsRector\FormTypeWithDependencyToOptionsRectorTest
 */
final class FormTypeWithDependencyToOptionsRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Move constructor dependency from form type class to an $options parameter', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class FormTypeWithDependency extends AbstractType
{
    private Agent $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($this->agent) {
            $builder->add('agent', TextType::class);
        }
    }
}
CODE_SAMPLE

                ,
                <<<'CODE_SAMPLE'
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class FormTypeWithDependency extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $agent = $options['agent'];

        if ($agent) {
            $builder->add('agent', TextType::class);
        }
    }
}
CODE_SAMPLE
            ),
        ]);
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
        // change the node

        return $node;
    }
}
