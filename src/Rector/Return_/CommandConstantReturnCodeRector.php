<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\Return_;

use PhpParser\Node;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Return_;
use PHPStan\Reflection\ClassReflection;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\Reflection\ReflectionResolver;
use Rector\Symfony\ValueObject\ConstantMap\SymfonyCommandConstantMap;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * https://symfony.com/blog/new-in-symfony-5-1-misc-improvements-part-1#added-constants-for-command-exit-codes
 *
 * @see \Rector\Symfony\Tests\Rector\Return_\CommandConstantReturnCodeRector\CommandConstantReturnCodeRectorTest
 */
final class CommandConstantReturnCodeRector extends AbstractRector
{
    public function __construct(
        private readonly ReflectionResolver $reflectionResolver,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Changes int return from execute to use Symfony Command constants.',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
class SomeCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return 0;
    }

}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
class SomeCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return Command::SUCCESS;
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
     * @param Return_ $node
     */
    public function refactor(Node $node): ?Node
    {
        $classReflection = $this->reflectionResolver->resolveClassReflection($node);
        if (! $classReflection instanceof ClassReflection) {
            return null;
        }

        if (! $classReflection->isSubclassOf('Symfony\Component\Console\Command\Command')) {
            return null;
        }

        if (! $this->nodeNameResolver->isName($node, 'execute')) {
            return null;
        }

        $this->findReturnStatement($node->stmts);

        return $node;
    }

    private function findReturnStatement(array $stmts)
    {
        foreach ($stmts as $stmt) {
            if (property_exists($stmt, 'stmts') && $stmt->stmts !== null) {
                $this->findReturnStatement($stmt->stmts);
            }
            if (! $stmt instanceof Return_) {
                continue;
            }
            if (! $stmt->expr instanceof LNumber) {
                continue;
            }
            $stmt->expr = $this->convertNumberToConstant($stmt->expr);
        }
    }

    private function convertNumberToConstant(LNumber $lNumber): ClassConstFetch|LNumber
    {
        if (! isset(SymfonyCommandConstantMap::RETURN_TO_CONST[$lNumber->value])) {
            return $lNumber;
        }

        return $this->nodeFactory->createShortClassConstFetch(
            'Command',
            SymfonyCommandConstantMap::RETURN_TO_CONST[$lNumber->value]
        );
    }
}
