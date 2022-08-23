<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\Closure;

use PhpParser\Node;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Scalar\String_;
use Rector\Core\Rector\AbstractRector;
use Rector\Symfony\DataProvider\DuplicatedTypeContainerAnalyzer;
use Rector\Symfony\NodeAnalyzer\SymfonyPhpClosureDetector;
use Rector\Symfony\NodeFinder\ServicesSetMethodCallFinder;
use Rector\Symfony\ValueObject\ServiceSetMethodCallMetadata;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\Closure\ServiceSetStringNameToClassNameRector\ServiceSetStringNameToClassNameRectorTest
 */
final class ServiceSetStringNameToClassNameRector extends AbstractRector
{
    public function __construct(
        private readonly SymfonyPhpClosureDetector $symfonyPhpClosureDetector,
        private readonly ServicesSetMethodCallFinder $servicesSetMethodCallFinder,
        private readonly DuplicatedTypeContainerAnalyzer $duplicatedTypeContainerAnalyzer,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change $service->set() string names to class-type-based names, to allow $container->get() by types in Symfony 2.8',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('some_name', App\SomeClass::class);
};
CODE_SAMPLE

                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('app\\someclass', App\SomeClass::class);
};
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
        return [Closure::class];
    }

    /**
     * @param Closure $node
     */
    public function refactor(Node $node): ?Node
    {
        $hasChanged = false;

        if (! $this->symfonyPhpClosureDetector->detect($node)) {
            return null;
        }

        $serviceSetMethodCallMetadatas = $this->findUniqueServiceSetMethodCallMetadatas($node);

        foreach ($serviceSetMethodCallMetadatas as $serviceSetMethodCallMetadata) {
            $serviceName = $serviceSetMethodCallMetadata->getServiceName();

            // already FQN class renamed
            if (str_contains($serviceName, '\\')) {
                continue;
            }

            $setMethodCall = $serviceSetMethodCallMetadata->getMethodCall();
            $args = $setMethodCall->getArgs();

            $firstArg = $args[0];
            $firstArg->value = $this->createTypedServiceName($serviceSetMethodCallMetadata->getServiceType());

            $hasChanged = true;
        }

        if ($hasChanged) {
            return $node;
        }

        return null;
    }

    private function createTypedServiceName(string $serviceType): String_
    {
        $typedServiceName = strtolower($serviceType);

        return String_::fromString("'" . $typedServiceName . "'");
    }

    /**
     * @return ServiceSetMethodCallMetadata[]
     */
    private function findUniqueServiceSetMethodCallMetadatas(Closure $closure): array
    {
        $serviceSetMethodCallMetadatas = $this->servicesSetMethodCallFinder->find($closure->stmts);
        if ($serviceSetMethodCallMetadatas === []) {
            return [];
        }

        $duplicatedTypes = $this->duplicatedTypeContainerAnalyzer->getDuplicatedTypes();

        // collect all service types
        return $this->filterOutDuplicatedTypes($serviceSetMethodCallMetadatas, $duplicatedTypes);
    }

    /**
     * @param ServiceSetMethodCallMetadata[] $serviceSetMethodCallMetadatas
     * @param string[] $duplicatedTypes
     * @return ServiceSetMethodCallMetadata[]
     */
    private function filterOutDuplicatedTypes(array $serviceSetMethodCallMetadatas, array $duplicatedTypes): array
    {
        return array_filter(
            $serviceSetMethodCallMetadatas,
            fn (ServiceSetMethodCallMetadata $serviceSetMethodCallMetadata)
            => ! in_array($serviceSetMethodCallMetadata->getServiceType(), $duplicatedTypes, true)
        );
    }
}
