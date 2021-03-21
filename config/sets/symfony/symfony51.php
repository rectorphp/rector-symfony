<?php

declare(strict_types=1);

# https://github.com/symfony/symfony/blob/5.x/UPGRADE-5.1.md
use PHPStan\Type\ObjectType;
use Rector\Renaming\Rector\ClassConstFetch\RenameClassConstFetchRector;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\Rector\String_\RenameStringRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Renaming\ValueObject\RenameClassAndConstFetch;
use Rector\Symfony\Rector\Class_\LogoutHandlerToLogoutEventSubscriberRector;
use Rector\Symfony\Rector\Class_\LogoutSuccessHandlerToLogoutEventSubscriberRector;
use Rector\Symfony\Rector\ClassMethod\RouteCollectionBuilderToRoutingConfiguratorRector;
use Rector\Transform\Rector\New_\NewArgToMethodCallRector;
use Rector\Transform\Rector\StaticCall\StaticCallToNewRector;
use Rector\Transform\ValueObject\NewArgToMethodCall;
use Rector\Transform\ValueObject\StaticCallToNew;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    // see https://github.com/symfony/symfony/pull/36243
    $services->set(LogoutHandlerToLogoutEventSubscriberRector::class);
    $services->set(LogoutSuccessHandlerToLogoutEventSubscriberRector::class);
    $services->set(RenameClassRector::class)
        ->call('configure', [[
            RenameClassRector::OLD_TO_NEW_CLASSES => [
                'Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy' => 'Symfony\Component\EventDispatcher\EventDispatcherInterface',
                'Symfony\Component\Form\Extension\Validator\Util\ServerParams' => 'Symfony\Component\Form\Util\ServerParams',
                // see https://github.com/symfony/symfony/pull/35092
                'Symfony\Component\Inflector' => 'Symfony\Component\String\Inflector\InflectorInterface',
            ],
        ]]);
    $services->set(RenameMethodRector::class)
        ->call('configure', [[
            RenameMethodRector::METHOD_CALL_RENAMES => ValueObjectInliner::inline([
                new MethodCallRename(
                    'Symfony\Component\Config\Definition\BaseNode',
                    'getDeprecationMessage',
                    'getDeprecation'
                ),
                new MethodCallRename(
                    'Symfony\Component\DependencyInjection\Definition',
                    'getDeprecationMessage',
                    'getDeprecation'
                ),
                new MethodCallRename(
                    'Symfony\Component\DependencyInjection\Alias',
                    'getDeprecationMessage',
                    'getDeprecation'
                ),
            ]),
        ]]);
    $services->set(RenameFunctionRector::class)
        ->call('configure', [[
            RenameFunctionRector::OLD_FUNCTION_TO_NEW_FUNCTION => [
                'Symfony\Component\DependencyInjection\Loader\Configuraton\inline' => 'Symfony\Component\DependencyInjection\Loader\Configuraton\inline_service',
                'Symfony\Component\DependencyInjection\Loader\Configuraton\ref' => 'Symfony\Component\DependencyInjection\Loader\Configuraton\service',
            ],
        ]]);
    // https://github.com/symfony/symfony/pull/35308
    $services->set(NewArgToMethodCallRector::class)
        ->call('configure', [[
            NewArgToMethodCallRector::NEW_ARGS_TO_METHOD_CALLS => ValueObjectInliner::inline([
                new NewArgToMethodCall('Symfony\Component\Dotenv\Dotenv', true, 'usePutenv'),
            ]),
        ]]);
    $services->set(RenameClassConstFetchRector::class)
        ->call('configure', [[
            RenameClassConstFetchRector::CLASS_CONSTANT_RENAME => ValueObjectInliner::inline([
                new RenameClassAndConstFetch(
                    'Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer',
                    'ROUND_FLOOR',
                    'NumberFormatter',
                    'ROUND_FLOOR'
                ),
                new RenameClassAndConstFetch(
                    'Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer',
                    'ROUND_DOWN',
                    'NumberFormatter',
                    'ROUND_DOWN'
                ),
                new RenameClassAndConstFetch(
                    'Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer',
                    'ROUND_HALF_DOWN',
                    'NumberFormatter',
                    'ROUND_HALFDOWN'
                ),
                new RenameClassAndConstFetch(
                    'Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer',
                    'ROUND_HALF_EVEN',
                    'NumberFormatter',
                    'ROUND_HALFEVEN'
                ),
                new RenameClassAndConstFetch(
                    'Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer',
                    'ROUND_HALFUP',
                    'NumberFormatter',
                    'ROUND_HALFUP'
                ),
                new RenameClassAndConstFetch(
                    'Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer',
                    'ROUND_UP',
                    'NumberFormatter',
                    'ROUND_UP'
                ),
                new RenameClassAndConstFetch(
                    'Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer',
                    'ROUND_CEILING',
                    'NumberFormatter',
                    'ROUND_CEILING'
                ),
            ]),
        ]]);
    $services->set(AddParamTypeDeclarationRector::class)
        ->call('configure', [[
            // see https://github.com/symfony/symfony/pull/36943
            AddParamTypeDeclarationRector::PARAMETER_TYPEHINTS => ValueObjectInliner::inline([
                new AddParamTypeDeclaration(
                    'Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait',
                    'configureRoutes',
                    0,
                    new ObjectType('Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator')
                ),
            ]),
        ]]);
    $services->set(StaticCallToNewRector::class)
        ->call('configure', [[
            StaticCallToNewRector::STATIC_CALLS_TO_NEWS => ValueObjectInliner::inline([
                new StaticCallToNew('Symfony\Component\HttpFoundation\Response', 'create'),
                new StaticCallToNew('Symfony\Component\HttpFoundation\JsonResponse', 'create'),
                new StaticCallToNew('Symfony\Component\HttpFoundation\RedirectResponse', 'create'),
                new StaticCallToNew('Symfony\Component\HttpFoundation\StreamedResponse', 'create'),
            ]),
        ]]);
    $services->set(RenameStringRector::class)
        ->call('configure', [[
            // @see https://github.com/symfony/symfony/pull/35858
            RenameStringRector::STRING_CHANGES => [
                'ROLE_PREVIOUS_ADMIN' => 'IS_IMPERSONATOR',
            ],
        ]]);
    $services->set(RouteCollectionBuilderToRoutingConfiguratorRector::class);
};
