<?php

declare(strict_types=1);

namespace Rector\Symfony;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PHPStan\Reflection\ReflectionProvider;
use Rector\PhpParser\Node\BetterNodeFinder;
use Rector\PhpParser\Parser\RectorParser;
use Rector\NodeNameResolver\NodeNameResolver;

final class BundleClassResolver
{
    public function __construct(
        private readonly BetterNodeFinder $betterNodeFinder,
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly RectorParser $rectorParser,
        private readonly ReflectionProvider $reflectionProvider
    ) {
    }

    public function resolveShortBundleClassFromControllerClass(string $class): ?string
    {
        $classReflection = $this->reflectionProvider->getClass($class);

        // resolve bundle from existing ones
        $fileName = $classReflection->getFileName();
        if ($fileName === null) {
            return null;
        }

        $controllerDirectory = dirname($fileName);

        $rootFolder = getenv('SystemDrive', true) . DIRECTORY_SEPARATOR;

        // traverse up, un-till first bundle class appears
        $bundleFiles = [];
        while ($bundleFiles === [] && $controllerDirectory !== $rootFolder) {
            $bundleFiles = (array) glob($controllerDirectory . '/**Bundle.php');
            $controllerDirectory = dirname($controllerDirectory);
        }

        /** @var string[] $bundleFiles */
        if ($bundleFiles === []) {
            return null;
        }

        $bundleFile = $bundleFiles[0];

        $bundleClassName = $this->resolveClassNameFromFilePath($bundleFile);
        if ($bundleClassName !== null) {
            return $this->nodeNameResolver->getShortName($bundleClassName);
        }

        return null;
    }

    private function resolveClassNameFromFilePath(string $filePath): ?string
    {
        $nodes = $this->rectorParser->parseFile($filePath);

        $this->addFullyQualifiedNamesToNodes($nodes);

        $classLike = $this->betterNodeFinder->findFirstNonAnonymousClass($nodes);
        if (! $classLike instanceof ClassLike) {
            return null;
        }

        return $this->nodeNameResolver->getName($classLike);
    }

    /**
     * @param Node[] $nodes
     */
    private function addFullyQualifiedNamesToNodes(array $nodes): void
    {
        $nodeTraverser = new NodeTraverser();
        $nameResolver = new NameResolver();
        $nodeTraverser->addVisitor($nameResolver);

        $nodeTraverser->traverse($nodes);
    }
}
