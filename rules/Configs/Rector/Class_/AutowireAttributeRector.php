<?php

declare(strict_types=1);

namespace Rector\Symfony\Configs\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Attribute;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\Exception\ShouldNotHappenException;
use Rector\Rector\AbstractRector;
use Rector\Symfony\Configs\NodeAnalyser\ConfigServiceArgumentsResolver;
use Rector\ValueObject\MethodName;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @see https://symfony.com/blog/new-in-symfony-6-1-service-autowiring-attributes
 */
final class AutowireAttributeRector extends AbstractRector implements ConfigurableRectorInterface
{
    /**
     * @var string
     */
    public const CONFIGS_DIRECTORY = 'configs_directory';

    /**
     * @var string
     */
    private const AUTOWIRE_CLASS = 'Symfony\Component\DependencyInjection\Attribute\Autowire';

    private ?string $configsDirectory = null;

    public function __construct(
        private readonly ConfigServiceArgumentsResolver $configServiceArgumentsResolver
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Change explicit configuration parameter pass into #[Autowire] attributes', [
            new ConfiguredCodeSample(
                <<<'CODE_SAMPLE'
final class SomeClass
{
    public function __construct(
        private int $timeout,
        private string $secret,
    )  {
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class SomeClass
{
    public function __construct(
        #[Autowire(param: 'timeout')]
        private int $timeout,
        #[Autowire(env: 'APP_SECRET')]
        private string $secret,
    )  {
    }
}
CODE_SAMPLE
                ,
                [
                    self::CONFIGS_DIRECTORY => __DIR__ . '/config',
                ]
            )]);
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
        if ($node->isAnonymous()) {
            return null;
        }

        $constructClassMethod = $node->getMethod(MethodName::CONSTRUCT);
        if (! $constructClassMethod instanceof ClassMethod) {
            return null;
        }

        if ($this->configsDirectory === null) {
            throw new ShouldNotHappenException('Configure paths first');
        }

        $phpConfigFileInfos = $this->findPhpConfigs($this->configsDirectory);

        $servicesArguments = $this->configServiceArgumentsResolver->resolve($phpConfigFileInfos);
        if ($servicesArguments === []) {
            // nothing to resolve, maybe false positive!
            return null;
        }

        $className = $this->getName($node);
        if (! is_string($className)) {
            return null;
        }

        $hasChanged = false;

        foreach ($servicesArguments as $serviceArgument) {
            if ($className !== $serviceArgument->getClassName()) {
                continue;
            }

            foreach ($constructClassMethod->params as $position => $constructorParam) {
                if (! $constructorParam->var instanceof Variable) {
                    continue;
                }

                $constructorParameterName = $constructorParam->var->name;
                if (! is_string($constructorParameterName)) {
                    continue;
                }

                $currentEnv = $serviceArgument->getEnvs()[$constructorParameterName] ?? $serviceArgument->getEnvs()[$position] ?? null;
                if ($currentEnv) {
                    $constructorParam->attrGroups[] = new AttributeGroup([
                        $this->createAutowireAttribute($currentEnv, 'env'),
                    ]);

                    $hasChanged = true;

                }

                $currentParameter = $serviceArgument->getParams()[$constructorParameterName] ?? $serviceArgument->getParams()[$position] ?? null;
                if ($currentParameter) {
                    $constructorParam->attrGroups[] = new AttributeGroup([
                        $this->createAutowireAttribute($currentParameter, 'param'),
                    ]);

                    $hasChanged = true;
                }
            }
        }

        if ($hasChanged) {
            return $node;
        }

        return null;
    }

    /**
     * @param mixed[] $configuration
     */
    public function configure(array $configuration): void
    {
        if (! $configuration[self::CONFIGS_DIRECTORY]) {
            return;
        }

        $configsDirectory = $configuration[self::CONFIGS_DIRECTORY];
        Assert::string($configsDirectory);
        Assert::directory($configsDirectory);

        $this->configsDirectory = $configsDirectory;
    }

    /**
     * @return SplFileInfo[]
     */
    private function findPhpConfigs(string $configsDirectory): array
    {
        $phpConfigsFinder = Finder::create()->files()
            ->in($configsDirectory)
            ->name('*.php')
            ->sortByName();

        if ($phpConfigsFinder->count() === 0) {
            throw new ShouldNotHappenException(sprintf(
                'Could not find any PHP configs in "%s"',
                $this->configsDirectory
            ));
        }

        return iterator_to_array($phpConfigsFinder->getIterator());
    }

    private function createAutowireAttribute(string $value, string $argName): Attribute
    {
        $args = [new Arg(new String_($value), name: new Identifier($argName))];

        return new Attribute(new FullyQualified(self::AUTOWIRE_CLASS), $args);
    }
}
