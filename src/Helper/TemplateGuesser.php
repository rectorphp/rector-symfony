<?php

declare(strict_types=1);

namespace Rector\Symfony\Helper;

use Nette\Utils\Strings;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\Symfony\BundleClassResolver;

/**
 * @see \Rector\Symfony\Tests\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\TemplateAnnotationToThisRenderRectorTest
 */
final class TemplateGuesser
{
    /**
     * @var string
     * @see https://regex101.com/r/yZAUAC/1
     */
    private const BUNDLE_SUFFIX_REGEX = '#Bundle$#';

    /**
     * @var string
     * @see https://regex101.com/r/T6ItFG/1
     */
    private const BUNDLE_NAME_MATCHING_REGEX = '#(?<bundle>[\w]*Bundle)#';

    /**
     * @var string
     * @see https://regex101.com/r/5dNkCC/2
     */
    private const SMALL_LETTER_BIG_LETTER_REGEX = '#([a-z\d])([A-Z])#';

    /**
     * @var string
     * @see https://regex101.com/r/YUrmAD/1
     */
    private const CONTROLLER_NAME_MATCH_REGEX = '#Controller\\\(?<class_name_without_suffix>.+)Controller$#';

    /**
     * @var string
     * @see https://regex101.com/r/nj8Ojf/1
     */
    private const ACTION_MATCH_REGEX = '#Action$#';

    public function __construct(
        private readonly BundleClassResolver $bundleClassResolver,
        private readonly NodeNameResolver $nodeNameResolver
    ) {
    }

    public function resolveFromClassMethod(ClassMethod $classMethod): string
    {
        $scope = $classMethod->getAttribute(AttributeKey::SCOPE);
        if (! $scope instanceof Scope) {
            throw new ShouldNotHappenException();
        }

        $namespace = $scope->getNamespace();
        if (! is_string($namespace)) {
            throw new ShouldNotHappenException();
        }

        $className = $scope->getClassReflection()?->getName();
        if (! is_string($className)) {
            throw new ShouldNotHappenException();
        }

        /** @var string $methodName */
        $methodName = $this->nodeNameResolver->getName($classMethod);

        return $this->resolve($namespace, $className, $methodName);
    }

    /**
     * Mimics https://github.com/sensiolabs/SensioFrameworkExtraBundle/blob/v5.0.0/Templating/TemplateGuesser.php
     */
    private function resolve(string $namespace, string $class, string $method): string
    {
        $bundle = $this->resolveBundle($class, $namespace);
        $controller = $this->resolveController($class);

        $action = Strings::replace($method, self::ACTION_MATCH_REGEX, '');

        $fullPath = '';
        if ($bundle !== '') {
            $fullPath .= $bundle . '/';
        }

        if ($controller !== '') {
            $fullPath .= $controller . '/';
        }

        return $fullPath . $action . '.html.twig';
    }

    private function resolveBundle(string $class, string $namespace): string
    {
        $shortBundleClass = $this->bundleClassResolver->resolveShortBundleClassFromControllerClass($class);
        if ($shortBundleClass !== null) {
            return '@' . $shortBundleClass;
        }

        $bundle = Strings::match($namespace, self::BUNDLE_NAME_MATCHING_REGEX)['bundle'] ?? '';
        $bundle = Strings::replace($bundle, self::BUNDLE_SUFFIX_REGEX, '');
        return $bundle !== '' ? '@' . $bundle : '';
    }

    private function resolveController(string $class): string
    {
        $match = Strings::match($class, self::CONTROLLER_NAME_MATCH_REGEX);
        if ($match === null) {
            return '';
        }

        $controller = Strings::replace(
            $match['class_name_without_suffix'],
            self::SMALL_LETTER_BIG_LETTER_REGEX,
            '\\1_\\2'
        );
        return str_replace('\\', '/', $controller);
    }
}
