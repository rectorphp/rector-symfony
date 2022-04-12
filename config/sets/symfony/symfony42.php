<?php

declare(strict_types=1);

use PHPStan\Type\IterableType;

use PHPStan\Type\MixedType;
use Rector\Arguments\NodeAnalyzer\ArgumentAddingScope;
use Rector\Arguments\Rector\ClassMethod\ArgumentAdderRector;
use Rector\Arguments\Rector\ClassMethod\ReplaceArgumentDefaultValueRector;
use Rector\Arguments\ValueObject\ArgumentAdder;
use Rector\Arguments\ValueObject\ReplaceArgumentDefaultValue;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\MethodName;
use Rector\Core\ValueObject\Visibility;
use Rector\Removing\Rector\ClassMethod\ArgumentRemoverRector;
use Rector\Removing\ValueObject\ArgumentRemover;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Symfony\Rector\MethodCall\ContainerGetToConstructorInjectionRector;
use Rector\Symfony\Rector\New_\RootNodeTreeBuilderRector;
use Rector\Symfony\Rector\New_\StringToArrayArgumentProcessRector;
use Rector\Transform\Rector\ClassMethod\WrapReturnRector;
use Rector\Transform\Rector\New_\NewToStaticCallRector;
use Rector\Transform\ValueObject\NewToStaticCall;
use Rector\Transform\ValueObject\WrapReturn;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration;
use Rector\Visibility\Rector\ClassMethod\ChangeMethodVisibilityRector;
use Rector\Visibility\ValueObject\ChangeMethodVisibility;

# https://github.com/symfony/symfony/pull/28447

return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();
    $services->set(NewToStaticCallRector::class)
        ->configure([
            new NewToStaticCall(
                'Symfony\Component\HttpFoundation\Cookie',
                'Symfony\Component\HttpFoundation\Cookie',
                'create'
            ),
        ]);

    $services->set(RenameClassRector::class)
        ->configure([
            # https://github.com/symfony/symfony/commit/a7e319d9e1316e2e18843f8ce15b67a8693e5bf9
            'Symfony\Bundle\FrameworkBundle\Controller\Controller' => 'Symfony\Bundle\FrameworkBundle\Controller\AbstractController',
            # https://github.com/symfony/symfony/commit/744bf0e7ac3ecf240d0bf055cc58f881bb0b3ec0
            'Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand' => 'Symfony\Component\Console\Command\Command',
            'Symfony\Component\Translation\TranslatorInterface' => 'Symfony\Contracts\Translation\TranslatorInterface',
        ]);

    # related to "Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand" deprecation, see https://github.com/rectorphp/rector/issues/1629
    $services->set(ContainerGetToConstructorInjectionRector::class);

    # https://symfony.com/blog/new-in-symfony-4-2-important-deprecations
    $services->set(StringToArrayArgumentProcessRector::class);

    $services->set(RootNodeTreeBuilderRector::class);

    $services->set(ArgumentAdderRector::class)
        ->configure([
            // https://github.com/symfony/symfony/commit/fa2063efe43109aea093d6fbfc12d675dba82146
            // https://github.com/symfony/symfony/commit/e3aa90f852f69040be19da3d8729cdf02d238ec7
            new ArgumentAdder(
                'Symfony\Component\BrowserKit\Client',
                'submit',
                2,
                'serverParameters',
                [],
                null,
                ArgumentAddingScope::SCOPE_METHOD_CALL
            ),
            new ArgumentAdder(
                'Symfony\Component\DomCrawler\Crawler',
                'children',
                0,
                null,
                null,
                null,
                ArgumentAddingScope::SCOPE_METHOD_CALL
            ),
            new ArgumentAdder(
                'Symfony\Component\Finder\Finder',
                'sortByName',
                0,
                null,
                false,
                null,
                ArgumentAddingScope::SCOPE_METHOD_CALL
            ),
            new ArgumentAdder(
                'Symfony\Bridge\Monolog\Processor\DebugProcessor',
                'getLogs',
                0,
                null,
                null,
                null,
                ArgumentAddingScope::SCOPE_METHOD_CALL
            ),
            new ArgumentAdder(
                'Symfony\Bridge\Monolog\Processor\DebugProcessor',
                'countErrors',
                0,
                'default_value',
                null,
                null,
                ArgumentAddingScope::SCOPE_METHOD_CALL
            ),
            new ArgumentAdder(
                'Symfony\Bridge\Monolog\Logger',
                'getLogs',
                0,
                'default_value',
                null,
                null,
                ArgumentAddingScope::SCOPE_METHOD_CALL
            ),
            new ArgumentAdder(
                'Symfony\Bridge\Monolog\Logger',
                'countErrors',
                0,
                'default_value',
                null,
                null,
                ArgumentAddingScope::SCOPE_METHOD_CALL
            ),
            new ArgumentAdder(
                'Symfony\Component\Serializer\Normalizer',
                'handleCircularReference',
                1,
                null,
                null,
                null,
                ArgumentAddingScope::SCOPE_METHOD_CALL
            ),
            new ArgumentAdder(
                'Symfony\Component\Serializer\Normalizer',
                'handleCircularReference',
                2,
                null,
                null,
                null,
                ArgumentAddingScope::SCOPE_METHOD_CALL
            ),
        ]);

    $services->set(RenameMethodRector::class)
        ->configure([
            new MethodCallRename('Symfony\Component\Cache\CacheItem', 'getPreviousTags', 'getMetadata'),
            new MethodCallRename(
                'Symfony\Component\Form\AbstractTypeExtension',
                'getExtendedType',
                'getExtendedTypes'
            ),
        ]);

    $iterableType = new IterableType(new MixedType(), new MixedType());

    $services->set(AddReturnTypeDeclarationRector::class)
        ->configure([
            new AddReturnTypeDeclaration(
                'Symfony\Component\Form\AbstractTypeExtension',
                'getExtendedTypes',
                $iterableType
            ),
        ]);

    $services->set(ChangeMethodVisibilityRector::class)
        ->configure([new ChangeMethodVisibility(
            'Symfony\Component\Form\AbstractTypeExtension',
            'getExtendedTypes',
            Visibility::STATIC
        ),
        ]);

    $services->set(WrapReturnRector::class)
        ->configure([new WrapReturn('Symfony\Component\Form\AbstractTypeExtension', 'getExtendedTypes', true)]);

    // https://github.com/symfony/symfony/commit/9493cfd5f2366dab19bbdde0d0291d0575454567
    $services->set(ReplaceArgumentDefaultValueRector::class)
        ->configure([
            new ReplaceArgumentDefaultValue(
                'Symfony\Component\HttpFoundation\Cookie',
                MethodName::CONSTRUCT,
                5,
                false,
                null
            ),
            new ReplaceArgumentDefaultValue(
                'Symfony\Component\HttpFoundation\Cookie',
                MethodName::CONSTRUCT,
                8,
                null,
                'lax'
            ),
        ]);

    # https://github.com/symfony/symfony/commit/f5c355e1ba399a1b3512367647d902148bdaf09f
    $services->set(ArgumentRemoverRector::class)
        ->configure([
            new ArgumentRemover(
                'Symfony\Component\HttpKernel\DataCollector\ConfigDataCollector',
                MethodName::CONSTRUCT,
                0,
                null
            ),
            new ArgumentRemover(
                'Symfony\Component\HttpKernel\DataCollector\ConfigDataCollector',
                MethodName::CONSTRUCT,
                1,
                null
            ),
        ]);
};
