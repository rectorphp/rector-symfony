<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Attribute;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\Exception\ShouldNotHappenException;
use Rector\Rector\AbstractRector;
use Rector\Symfony\Enum\CommandMethodName;
use Rector\Symfony\Enum\SymfonyAttribute;
use Rector\Symfony\Enum\SymfonyClass;
use Rector\Symfony\Symfony73\NodeAnalyzer\CommandArgumentsAndOptionsResolver;
use Rector\Symfony\Symfony73\NodeFactory\CommandInvokeParamsFactory;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://github.com/symfony/symfony-docs/issues/20553
 * @see https://github.com/symfony/symfony/pull/59340
 *
 * @see \Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandRector\InvokableCommandRectorTest
 */
final class InvokableCommandRector extends AbstractRector
{
    public function __construct(
        private readonly AttributeFinder $attributeFinder,
        private readonly CommandArgumentsAndOptionsResolver $commandArgumentsAndOptionsResolver,
        private readonly CommandInvokeParamsFactory $commandInvokeParamsFactory
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Change Symfony Command with execute() + configure() to __invoke() with attributes', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name')]
final class SomeCommand extends Command
{
    public function configure()
    {
        $this->addArgument('argument', InputArgument::REQUIRED, 'Argument description');
        $this->addOption('option', 'o', InputOption::VALUE_NONE, 'Option description');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $someArgument = $input->getArgument('argument');
        $someOption = $input->getOption('option');

        // ...

        return 1;
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\Argument;
use Symfony\Component\Console\Command\Option;

final class SomeCommand
{
    public function __invoke(
        #[Argument]
        string $argument,
        #[Option]
        bool $option = false,
    ) {
        $someArgument = $argument;
        $someOption = $option;

        // ...

        return 1;
    }
}
CODE_SAMPLE
            ),
        ]);
    }

    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Class_
    {
        if (! $node->extends instanceof Name) {
            return null;
        }

        // handle only direct child classes, to keep safe
        if (! $this->isName($node->extends, SymfonyClass::COMMAND)) {
            return null;
        }

        if ($this->isComplexCommand($node)) {
            return null;
        }

        // as command attribute is required, its handled by previous symfony versions
        // @todo possibly to add it here to handle multiple cases
        if (! $this->attributeFinder->findAttributeByClass($node, SymfonyAttribute::AS_COMMAND) instanceof Attribute) {
            return null;
        }

        // 1. fetch configure method to get arguments and options metadata
        $configureClassMethod = $node->getMethod(CommandMethodName::CONFIGURE);
        if (! $configureClassMethod instanceof ClassMethod) {
            return null;
        }

        // 2. rename execute to __invoke
        $executeClassMethod = $node->getMethod(CommandMethodName::EXECUTE);
        if (! $executeClassMethod instanceof ClassMethod) {
            return null;
        }

        $executeClassMethod->name = new Identifier('__invoke');

        // 3. create arguments and options parameters
        // @todo
        $commandArguments = $this->commandArgumentsAndOptionsResolver->collectCommandArguments(
            $configureClassMethod
        );

        $commandOptions = $this->commandArgumentsAndOptionsResolver->collectCommandOptions($configureClassMethod);

        // 4. remove configure() method
        $this->removeConfigureClassMethod($node);

        // 5. decorate __invoke method with attributes
        $invokeParams = $this->commandInvokeParamsFactory->createParams($commandArguments, $commandOptions);
        $executeClassMethod->params = $invokeParams;

        // 6. remove parent class
        $node->extends = null;

        // 7. replace input->getArgument() and input->getOption() calls with direct variable access
        $this->replaceInputArgumentOptionFetchWithVariables($executeClassMethod);

        return $node;
    }

    /**
     * Skip commands with interact() or initialize() methods as modify the argument/option values
     */
    private function isComplexCommand(Class_ $class): bool
    {
        if ($class->getMethod(CommandMethodName::INTERACT) instanceof ClassMethod) {
            return true;
        }

        return $class->getMethod(CommandMethodName::INITIALIZE) instanceof ClassMethod;
    }

    private function removeConfigureClassMethod(Class_ $class): void
    {
        foreach ($class->stmts as $key => $stmt) {
            if (! $stmt instanceof ClassMethod) {
                continue;
            }

            if (! $this->isName($stmt->name, CommandMethodName::CONFIGURE)) {
                continue;
            }

            unset($class->stmts[$key]);
            return;
        }
    }

    private function replaceInputArgumentOptionFetchWithVariables(ClassMethod $executeClassMethod): void
    {
        $this->traverseNodesWithCallable($executeClassMethod->stmts, function (Node $node): ?Variable {
            if (! $node instanceof MethodCall) {
                return null;
            }

            if (! $this->isName($node->var, 'input')) {
                return null;
            }

            if (! $this->isNames($node->name, ['getOption', 'getArgument'])) {
                return null;
            }

            $firstArgValue = $node->getArgs()[0]
                ->value;

            if (! $firstArgValue instanceof String_) {
                // unable to resolve argument/option name
                throw new ShouldNotHappenException();
            }

            return new Variable($firstArgValue->value);
        });
    }
}
