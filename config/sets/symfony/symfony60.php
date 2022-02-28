<?php

declare(strict_types=1);

use PhpParser\Node\Scalar\String_;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Symfony\Rector\FuncCall\ReplaceServiceArgumentRector;
use Rector\Symfony\Rector\MethodCall\GetHelperControllerToServiceRector;
use Rector\Symfony\Set\SymfonySetList;
use Rector\Symfony\ValueObject\ReplaceServiceArgument;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

# https://github.com/symfony/symfony/blob/6.1/UPGRADE-6.0.md

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES);
    $containerConfigurator->import(__DIR__ . '/symfony6/symfony-return-types.php');

    // @see https://github.com/symfony/symfony/pull/35879
    $services = $containerConfigurator->services();
    $services->set(ReplaceServiceArgumentRector::class)
        ->configure([
            new ReplaceServiceArgument('Psr\Container\ContainerInterface', new String_('service_container')),
            new ReplaceServiceArgument(
                'Symfony\Component\DependencyInjection\ContainerInterface',
                new String_('service_container')
            ),
        ]);

    $services->set(RenameClassRector::class)
        ->configure([
            // @see https://github.com/symfony/symfony/pull/39484
            'Symfony\Contracts\HttpClient\HttpClientInterface\RemoteJsonManifestVersionStrategy' => 'Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy',
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

    $services->set(RenameMethodRector::class)
        ->configure([
            // @see https://github.com/symfony/symfony/pull/40403
            new MethodCallRename(
                'Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface',
                'loadUserByUsername',
                'loadUserByIdentifier'
            ),
            // @see https://github.com/rectorphp/rector-symfony/issues/112
            new MethodCallRename(
                'Symfony\Component\Security\Core\User\UserInterface',
                'getUsername',
                'getUserIdentifier',
            ),
        ]);
    $services->set(GetHelperControllerToServiceRector::class);
};
