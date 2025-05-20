<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\Rector\New_;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\VariadicPlaceholder;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://github.com/symfony/symfony/pull/58542
 *
 * @see Rector\Symfony\Tests\Symfony73\Rector\New_\RegexToSlugConstraintRector\RegexToSlugConstraintRectorTest
 */
final class RegexToSlugConstraintRector extends AbstractRector
{
    /**
     * The regex pattern that identifies a slug
     * @var string
     */
    private const SLUG_PATTERN = '/^\^[a-z0-9]+(?:-[a-z0-9]+)*\$$/';

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replaces Regex constraint with pattern /^[a-z0-9]+(?:-[a-z0-9]+)*$/ with the new Slug constraint',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Component\Validator\Constraints as Assert;

class Category
{
    #[Assert\Regex(pattern: '/^[a-z0-9]+(?:-[a-z0-9]+)*$/')]
    protected string $slug;
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Component\Validator\Constraints as Assert;

class Category
{
    #[Assert\Slug]
    protected string $slug;
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
        return [New_::class];
    }

    /**
     * @param New_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->isRegexConstraint($node)) {
            return null;
        }

        $patternValue = $this->getPatternValue($node);
        if (! $patternValue instanceof String_) {
            return null;
        }

        if (! $this->isSlugPattern($patternValue->value)) {
            return null;
        }

        $newArgs = $this->getExpectedArgs($node);

        return new New_(new Name('Symfony\Component\Validator\Constraints\Slug'), $newArgs);
    }

    private function isRegexConstraint(New_ $node): bool
    {
        if (! $node->class instanceof Name) {
            return false;
        }

        $className = $this->getName($node->class);
        if ($className === 'Symfony\Component\Validator\Constraints\Regex') {
            return true;
        }

        return $className === 'Assert\Regex';
    }

    private function getPatternValue(New_ $node): ?Node
    {
        foreach ($node->args as $arg) {
            if (! $arg instanceof Arg) {
                continue;
            }

            if ($arg->name !== null && $this->isName($arg->name, 'pattern')) {
                return $arg->value;
            }

            if ($arg->name === null) {
                if ($arg->value instanceof String_) {
                    return $arg->value;
                }

                if ($arg->value instanceof Node\Expr\Array_) {
                    foreach ($arg->value->items as $item) {
                        if ($item === null) {
                            continue;
                        }

                        if ($item->key instanceof String_ && $item->key->value === 'pattern') {
                            return $item->value;
                        }
                    }
                }
            }
        }

        return null;
    }

    private function isSlugPattern(string $pattern): bool
    {
        if (preg_match(self::SLUG_PATTERN, $pattern)) {
            return true;
        }

        $unanchoredPattern = trim($pattern, '/^$');
        return $unanchoredPattern === '[a-z0-9]+(?:-[a-z0-9]+)*';
    }

    /**
     * Get only the message, groups, payload, and options arguments from the original node
     *
     * @return array<Arg|VariadicPlaceholder>
     */
    private function getExpectedArgs(New_ $node): array
    {
        $newArgs = [];
        foreach ($node->args as $arg) {
            if (! $arg instanceof Arg) {
                continue;
            }

            if ($arg->name !== null) {
                if ($this->isName($arg->name, 'message') ||
                    $this->isName($arg->name, 'groups') ||
                    $this->isName($arg->name, 'payload') ||
                    $this->isName($arg->name, 'options')) {
                    $newArgs[] = $arg;
                }
            }
        }

        return $newArgs;
    }
}
