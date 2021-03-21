<?php

declare(strict_types=1);

use Rector\Arguments\Rector\ClassMethod\ArgumentAdderRector;
use Rector\Arguments\ValueObject\ArgumentAdder;

use Rector\Core\ValueObject\MethodName;
use Rector\DependencyInjection\Rector\ClassMethod\AddMethodParentCallRector;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Symfony\Rector\MethodCall\MakeDispatchFirstArgumentEventRector;
use Rector\Symfony\Rector\MethodCall\SimplifyWebTestCaseAssertionsRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;

# https://github.com/symfony/symfony/blob/4.4/UPGRADE-4.3.md
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    # https://symfony.com/blog/new-in-symfony-4-3-better-test-assertions
    $services->set(SimplifyWebTestCaseAssertionsRector::class);

    $services->set(RenameMethodRector::class)
        ->call('configure', [[
            RenameMethodRector::METHOD_CALL_RENAMES => ValueObjectInliner::inline([
                new MethodCallRename('Symfony\Component\BrowserKit\Response', 'getStatus', 'getStatusCode'),
                new MethodCallRename('Symfony\Component\Security\Http\Firewall', 'handleRequest', 'callListeners'),
            ]),
        ]]);

    $services->set(MakeDispatchFirstArgumentEventRector::class);

    $services->set(RenameClassRector::class)
        ->call('configure', [[
            RenameClassRector::OLD_TO_NEW_CLASSES => [
                # https://symfony.com/blog/new-in-symfony-4-3-simpler-event-dispatching
                # Browser Kit
                'Symfony\Component\BrowserKit\Client' => 'Symfony\Component\BrowserKit\AbstractBrowser',
                # Cache
                # https://github.com/symfony/symfony/pull/29236
                'Symfony\Component\Cache\Traits\ApcuTrait\ApcuCache' => 'Symfony\Component\Cache\Traits\ApcuTrait\ApcuAdapter',
                'Symfony\Component\Cache\Adapter\SimpleCacheAdapter' => 'Symfony\Component\Cache\Adapter\Psr16Adapter',
                'Symfony\Component\Cache\Simple\ArrayCache' => 'Symfony\Component\Cache\Adapter\ArrayAdapter',
                'Symfony\Component\Cache\Simple\ChainCache' => 'Symfony\Component\Cache\Adapter\ChainAdapter',
                'Symfony\Component\Cache\Simple\DoctrineCache' => 'Symfony\Component\Cache\Adapter\DoctrineAdapter',
                'Symfony\Component\Cache\Simple\FilesystemCache' => 'Symfony\Component\Cache\Adapter\FilesystemAdapter',
                'Symfony\Component\Cache\Simple\MemcachedCache' => 'Symfony\Component\Cache\Adapter\MemcachedAdapter',
                'Symfony\Component\Cache\Simple\NullCache' => 'Symfony\Component\Cache\Adapter\NullAdapter',
                'Symfony\Component\Cache\Simple\PdoCache' => 'Symfony\Component\Cache\Adapter\PdoAdapter',
                'Symfony\Component\Cache\Simple\PhpArrayCache' => 'Symfony\Component\Cache\Adapter\PhpArrayAdapter',
                'Symfony\Component\Cache\Simple\PhpFilesCache' => 'Symfony\Component\Cache\Adapter\PhpFilesAdapter',
                'Symfony\Component\Cache\Simple\RedisCache' => 'Symfony\Component\Cache\Adapter\RedisAdapter',
                'Symfony\Component\Cache\Simple\TraceableCache' => 'Symfony\Component\Cache\Adapter\TraceableAdapterCache',
                'Symfony\Component\Cache\Simple\Psr6Cache' => 'Symfony\Component\Cache\Psr16Cache',
                'Psr\SimpleCache\CacheInterface' => 'Symfony\Contracts\Cache\CacheInterface',
                # EventDispatcher
                'Symfony\Component\HttpKernel\Event\FilterControllerArgumentsEvent' => 'Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent',
                'Symfony\Component\HttpKernel\Event\FilterControllerEvent' => 'Symfony\Component\HttpKernel\Event\ControllerEvent',
                'Symfony\Component\HttpKernel\Event\FilterResponseEvent' => 'Symfony\Component\HttpKernel\Event\ResponseEvent',
                'Symfony\Component\HttpKernel\Event\GetResponseEvent' => 'Symfony\Component\HttpKernel\Event\RequestEvent',
                'Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent' => 'Symfony\Component\HttpKernel\Event\ViewEvent',
                'Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent' => 'Symfony\Component\HttpKernel\Event\ExceptionEvent',
                'Symfony\Component\HttpKernel\Event\PostResponseEvent' => 'Symfony\Component\HttpKernel\Event\TerminateEvent',
                # has lowest priority, have to be last
                'Symfony\Component\EventDispatcher\Event' => 'Symfony\Contracts\EventDispatcher\Event',
                # MimeType
                'Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesserInterface' => 'Symfony\Component\Mime\MimeTypesInterface',
                'Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesserInterface' => 'Symfony\Component\Mime\MimeTypesInterface',
                'Symfony\Component\HttpFoundation\File\MimeType\MimeTypeExtensionGuesser' => 'Symfony\Component\Mime\MimeTypes',
                'Symfony\Component\HttpFoundation\File\MimeType\FileBinaryMimeTypeGuesser' => 'Symfony\Component\Mime\FileBinaryMimeTypeGuesser',
                'Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser' => 'Symfony\Component\Mime\FileinfoMimeTypeGuesser',
                # HttpKernel
                # @todo unpack after YAML to PHP migration, Symfony\Component\HttpKernel\Client: Symfony\Component\HttpKernel\HttpKernelBrowser
                'Symfony\Component\HttpKernel\EventListener\TranslatorListener' => 'Symfony\Component\HttpKernel\EventListener\LocaleAwareListener',
                # Security
                'Symfony\Component\Security\Core\Encoder\Argon2iPasswordEncoder' => 'Symfony\Component\Security\Core\Encoder\SodiumPasswordEncoder',
                'Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder' => 'Symfony\Component\Security\Core\Encoder\NativePasswordEncoder',
            ],
        ]]);

    # https://github.com/symfony/symfony/blob/4.4/UPGRADE-4.3.md#workflow
    $services->set(ArgumentAdderRector::class)
        ->call('configure', [[
            ArgumentAdderRector::ADDED_ARGUMENTS => ValueObjectInliner::inline([
                new ArgumentAdder(
                    'Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface',
                    'setMarking',
                    2,
                    'context',
                    []
                ),
            ]),
        ]]);

    $services->set(AddMethodParentCallRector::class)
        ->call('configure', [[
            AddMethodParentCallRector::METHODS_BY_PARENT_TYPES => [
                'Symfony\Component\EventDispatcher\EventDispatcher' => MethodName::CONSTRUCT,
            ],
        ]]);
};
