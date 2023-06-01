<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\ClassMethod;

use Nette\Utils\Strings;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Return_;
use Rector\Core\Rector\AbstractRector;
use Symfony\Component\String\UnicodeString;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://github.com/symfony/symfony/blob/3.4/UPGRADE-3.0.md#form
 *
 * @see \Rector\Symfony\Tests\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\RemoveDefaultGetBlockPrefixRectorTest
 */
final class RemoveDefaultGetBlockPrefixRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Rename `getBlockPrefix()` if it returns the default value - class to underscore, e.g. UserFormType = user_form',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Component\Form\AbstractType;

class TaskType extends AbstractType
{
    public function getBlockPrefix()
    {
        return 'task';
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Component\Form\AbstractType;

class TaskType extends AbstractType
{
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
    public function refactor(Node $node)
    {
        if (! $node->extends instanceof Name) {
            return null;
        }

        // work only with direct parent, as other can provide aliases on purpose
        if (! $this->isName($node->extends, 'Symfony\Component\Form\AbstractType')) {
            return null;
        }

        foreach ($node->stmts as $key => $classStmt) {
            if (! $classStmt instanceof ClassMethod) {
                continue;
            }

            if (! $this->isName($classStmt, 'getBlockPrefix')) {
                continue;
            }

            $returnedExpr = $this->resolveOnlyStmtReturnExpr($classStmt);
            if (! $returnedExpr instanceof Expr) {
                return null;
            }

            $returnedValue = $this->valueResolver->getValue($returnedExpr);

            $className = $this->nodeNameResolver->getName($node);
            if (! is_string($className)) {
                continue;
            }

            $shortClassName = $this->nodeNameResolver->getShortName($className);
            if (\str_ends_with($shortClassName, 'Type')) {
                $shortClassName = (string) Strings::before($shortClassName, 'Type');
            }

            $shortClassNameUnicodeString = new UnicodeString($shortClassName);
            $underscoredClassShortName = $shortClassNameUnicodeString->snake()
                ->toString();

            if ($underscoredClassShortName !== $returnedValue) {
                continue;
            }

            // remove method as unused
            unset($node->stmts[$key]);

            return $node;
        }

        return null;
    }

    /**
     * return <$thisValue>;
     */
    private function resolveOnlyStmtReturnExpr(ClassMethod $classMethod): ?Expr
    {
        if (count((array) $classMethod->stmts) !== 1) {
            return null;
        }

        $onlyStmt = $classMethod->stmts[0] ?? null;
        if (! $onlyStmt instanceof Return_) {
            return null;
        }

        return $onlyStmt->expr;
    }
}
