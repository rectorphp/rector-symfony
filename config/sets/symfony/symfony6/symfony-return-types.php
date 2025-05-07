<?php

declare(strict_types=1);

use PHPStan\Type\ArrayType;
use PHPStan\Type\BooleanType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\UnionType;
use Rector\Config\RectorConfig;
use Rector\StaticTypeMapper\ValueObject\Type\SimpleStaticType;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration;
use Rector\Util\Reflection\PrivatesAccessor;

// https://github.com/symfony/symfony/blob/6.1/UPGRADE-6.0.md
// @see https://github.com/symfony/symfony/blob/6.1/.github/expected-missing-return-types.diff

return static function (RectorConfig $rectorConfig): void {
    $arrayType = new ArrayType(new MixedType(), new MixedType());
    $routeCollectionType = new ObjectType('Symfony\Component\Routing\RouteCollection');

    $scalarTypes = [
        $arrayType,
        new BooleanType(),
        new StringType(),
        new IntegerType(),
        new FloatType(),
        new NullType(),
    ];

    $scalarArrayObjectUnionedTypes = [...$scalarTypes, new ObjectType('ArrayObject')];

    // cannot be crated with \PHPStan\Type\UnionTypeHelper::sortTypes() as ObjectType requires a class reflection we do not have here
    $unionTypeReflectionClass = new ReflectionClass(UnionType::class);

    /** @var UnionType $scalarArrayObjectUnionType */
    $scalarArrayObjectUnionType = $unionTypeReflectionClass->newInstanceWithoutConstructor();

    $privatesAccessor = new PrivatesAccessor();
    $privatesAccessor->setPrivateProperty($scalarArrayObjectUnionType, 'types', $scalarArrayObjectUnionedTypes);
    $rectorConfig->ruleWithConfiguration(AddReturnTypeDeclarationRector::class, [
        new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\LoaderInterface', 'load', new MixedType()),
        new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\Loader', 'import', new MixedType()),
        new AddReturnTypeDeclaration(
            'Symfony\Component\Config\Definition\ConfigurationInterface',
            'getConfigTreeBuilder',
            new ObjectType('Symfony\Component\Config\Definition\Builder\TreeBuilder')
        ),
        new AddReturnTypeDeclaration('Symfony\Component\Config\FileLocator', 'locate', new UnionType([
            new StringType(),
            $arrayType,
        ])),
        new AddReturnTypeDeclaration('Symfony\Component\Config\FileLocatorInterface', 'locate', new UnionType([
            new StringType(),
            $arrayType,
        ])),
        new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\FileLoader', 'import', new MixedType()),
        new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\Loader', 'import', new MixedType()),
        new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\LoaderInterface', 'load', new MixedType()),
        new AddReturnTypeDeclaration(
            'Symfony\Component\Config\Loader\LoaderInterface',
            'supports',
            new BooleanType()
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\Config\Loader\LoaderInterface',
            'getResolver',
            new ObjectType('Symfony\Component\Config\Loader\LoaderResolverInterface')
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\Config\ResourceCheckerInterface',
            'supports',
            new BooleanType()
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\Config\ResourceCheckerInterface',
            'isFresh',
            new BooleanType()
        ),

        new AddReturnTypeDeclaration(
            'Symfony\Component\EventDispatcher\EventSubscriberInterface',
            'getSubscribedEvents',
            $arrayType
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface',
            'getFunctions',
            $arrayType
        ),

        new AddReturnTypeDeclaration(
            'Symfony\Component\OptionsResolver\OptionsResolver',
            'setNormalizer',
            new SimpleStaticType('Symfony\Component\OptionsResolver\OptionsResolver')
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\OptionsResolver\OptionsResolver',
            'setAllowedValues',
            new SimpleStaticType('Symfony\Component\OptionsResolver\OptionsResolver')
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\OptionsResolver\OptionsResolver',
            'addAllowedValues',
            new SimpleStaticType('Symfony\Component\OptionsResolver\OptionsResolver')
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\OptionsResolver\OptionsResolver',
            'setAllowedTypes',
            new SimpleStaticType('Symfony\Component\OptionsResolver\OptionsResolver')
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\OptionsResolver\OptionsResolver',
            'addAllowedTypes',
            new SimpleStaticType('Symfony\Component\OptionsResolver\OptionsResolver')
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\Routing\Loader\AnnotationClassLoader',
            'getDefaultRouteName',
            new StringType()
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\Routing\Router',
            'getRouteCollection',
            $routeCollectionType
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\Routing\RouterInterface',
            'getRouteCollection',
            $routeCollectionType
        ),
        new AddReturnTypeDeclaration(
            'Symfony\Component\Templating\Helper\HelperInterface',
            'getName',
            new StringType()
        ),
    ]);
};
