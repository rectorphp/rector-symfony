<?php

declare(strict_types=1);

use PhpParser\Node\Scalar\String_;
use PHPStan\Type\ArrayType;
use PHPStan\Type\IterableType;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use Rector\Symfony\Rector\FuncCall\ReplaceServiceArgumentRector;
use Rector\Symfony\Set\SymfonySetList;
use Rector\Symfony\ValueObject\ReplaceServiceArgument;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration;
use Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

# https://github.com/symfony/symfony/blob/6.1/UPGRADE-6.0.md

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES);

    $services = $containerConfigurator->services();

    // @see https://github.com/symfony/symfony/pull/35879
    $services->set(ReplaceServiceArgumentRector::class)
        ->configure([
            new ReplaceServiceArgument('Psr\Container\ContainerInterface', new String_('service_container')),
            new ReplaceServiceArgument('Symfony\Component\DependencyInjection\ContainerInterface', new String_(
                'service_container'
            )),
        ]);

    // @see https://github.com/symfony/symfony/pull/42064
    $services->set(AddReturnTypeDeclarationRector::class)
        ->configure([
            new AddReturnTypeDeclaration(
                'Symfony\Component\Config\Loader\LoaderInterface',
                'load',
                new MixedType(),
            ),
            new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\Loader', 'import', new MixedType(),),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\KernelInterface',
                'registerBundles',
                new IterableType(new MixedType(), new MixedType()),
            ),
            // @see https://wouterj.nl/2021/09/symfony-6-native-typing#when-upgrading-to-symfony-54
            new AddReturnTypeDeclaration(
                'Symfony\Component\Security\Core\User\UserInterface',
                'getRoles',
                new ArrayType(new MixedType(), new MixedType())
            ),
        ]);

    $services->set(AddParamTypeDeclarationRector::class)
        ->configure([
            new AddParamTypeDeclaration(
                'Symfony\Component\Config\Loader\LoaderInterface',
                'load',
                0,
                new MixedType(),
            ),
            new AddParamTypeDeclaration(
                'Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait',
                'configureRoutes',
                0,
                new ObjectType('Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator'),
            ),
        ]);
};
