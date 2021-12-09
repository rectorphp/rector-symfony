<?php

declare(strict_types=1);

use PhpParser\Node\Scalar\String_;
use PHPStan\Type\ArrayType;
use PHPStan\Type\BooleanType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\IterableType;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StaticType;
use PHPStan\Type\StringType;
use PHPStan\Type\UnionType;
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

    $iterableType = new IterableType(new MixedType(), new MixedType());
    $arrayType = new ArrayType(new MixedType(), new MixedType());
    $commandType = new ObjectType('Symfony\Component\Console\Command\Command');
    $httpFoundationResponseType = new ObjectType('Symfony\Component\HttpFoundation\Response');
    $browserKitResponseType = new ObjectType('Symfony\Component\BrowserKit\Response');

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
            new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\Loader', 'import', new MixedType()),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\KernelInterface',
                'registerBundles',
                $iterableType,
            ),
            // @see https://wouterj.nl/2021/09/symfony-6-native-typing#when-upgrading-to-symfony-54
            new AddReturnTypeDeclaration(
                'Symfony\Component\Security\Core\User\UserInterface',
                'getRoles',
                new ArrayType(new MixedType(), new MixedType())
            ),
            // @see https://github.com/symfony/symfony/pull/43028/files
            new AddReturnTypeDeclaration(
                'Symfony\Component\Console\Helper\HelperInterface',
                'getName',
                new StringType()
            ),

            new AddReturnTypeDeclaration(
                'Symfony\Component\BrowserKit\AbstractBrowser',
                'doRequestInProcess',
                new \PHPStan\Type\ObjectWithoutClassType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\BrowserKit\AbstractBrowser',
                'doRequest',
                new \PHPStan\Type\ObjectWithoutClassType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\BrowserKit\AbstractBrowser',
                'filterRequest',
                new \PHPStan\Type\ObjectWithoutClassType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\BrowserKit\AbstractBrowser',
                'filterResponse',
                $browserKitResponseType
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Config\Definition\ConfigurationInterface',
                'getConfigTreeBuilder',
                new ObjectType('Symfony\Component\Config\Definition\Builder\TreeBuilder')
            ),

            //new AddReturnTypeDeclaration('Symfony\Component\Config\FileLocator', 'locate', string|$arrayType),
            //new AddReturnTypeDeclaration('Symfony\Component\Config\FileLocatorInterface', 'locate', string|$arrayType),
            new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\FileLoader', 'import', new MixedType()),
            new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\Loader', 'import', new MixedType()),
            new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\LoaderInterface', 'load', new MixedType()),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Config\Loader\LoaderInterface',
                'supports',
                new BooleanType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\Config\Loader\LoaderInterface', 'getResolver', LoaderResolverInterface),
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
            new AddReturnTypeDeclaration('Symfony\Component\Console\Application', 'doRun', new IntegerType()),
            new AddReturnTypeDeclaration('Symfony\Component\Console\Application', 'getLongVersion', new StringType()),
            //new AddReturnTypeDeclaration('Symfony\Component\Console\Application', 'add', ?$commandType),
            new AddReturnTypeDeclaration('Symfony\Component\Console\Application', 'get', $commandType),
            new AddReturnTypeDeclaration('Symfony\Component\Console\Application', 'find', $commandType),
            new AddReturnTypeDeclaration('Symfony\Component\Console\Application', 'all', $arrayType),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Console\Application',
                'doRunCommand',
                new IntegerType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Console\Command\Command',
                'isEnabled',
                new BooleanType()
            ),
            new AddReturnTypeDeclaration('Symfony\Component\Console\Command\Command', 'execute', new IntegerType()),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Console\Helper\HelperInterface',
                'getName',
                new StringType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Console\Input\InputInterface',
                'getParameterOption',
                new MixedType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Console\Input\InputInterface',
                'getArgument',
                new MixedType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Console\Input\InputInterface',
                'getOption',
                new MixedType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass',
                'processValue',
                new MixedType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\DependencyInjection\Container', 'getParameter', array|bool|string|int|float|null),
            //new AddReturnTypeDeclaration('Symfony\Component\DependencyInjection\ContainerInterface', 'getParameter',, array|bool|string|int|float|null)
            //new AddReturnTypeDeclaration('Symfony\Component\DependencyInjection\Extension\ConfigurationExtensionInterface', 'getConfiguration',, ?ConfigurationInterface)
            //new AddReturnTypeDeclaration('Symfony\Component\DependencyInjection\Extension\Extension', 'getXsdValidationBasePath', string|false),
            new AddReturnTypeDeclaration(
                'Symfony\Component\DependencyInjection\Extension\Extension',
                'getNamespace',
                new StringType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\DependencyInjection\Extension\Extension', 'getConfiguration', ?ConfigurationInterface),
            new AddReturnTypeDeclaration(
                'Symfony\Component\DependencyInjection\Extension\ExtensionInterface',
                'getNamespace',
                new StringType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\DependencyInjection\Extension\ExtensionInterface', 'getXsdValidationBasePath',, string|false)
            new AddReturnTypeDeclaration(
                'Symfony\Component\DependencyInjection\Extension\ExtensionInterface',
                'getAlias',
                new StringType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\DependencyInjection\LazyProxy\Instantiator\InstantiatorInterface', 'instantiateProxy',, new \PHPStan\Type\ObjectWithoutClassType())
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
            new AddReturnTypeDeclaration('Symfony\Component\Form\AbstractExtension', 'loadTypes', $arrayType),
            //new AddReturnTypeDeclaration('Symfony\Component\Form\AbstractExtension', 'loadTypeGuesser', ?FormTypeGuesserInterface),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Form\AbstractRendererEngine',
                'loadResourceForBlockName',
                new BooleanType()
            ),
            new AddReturnTypeDeclaration('Symfony\Component\Form\AbstractType', 'getBlockPrefix', new StringType()),
            //new AddReturnTypeDeclaration('Symfony\Component\Form\AbstractType', 'getParent', ?new StringType()),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Form\DataTransformerInterface',
                'transform',
                new MixedType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Form\DataTransformerInterface',
                'reverseTransform',
                new MixedType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Form\FormRendererEngineInterface',
                'renderBlock',
                new StringType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\Form\FormTypeGuesserInterface', 'guessType', ?Guess\TypeGuess),
            //new AddReturnTypeDeclaration('Symfony\Component\Form\FormTypeGuesserInterface', 'guessRequired', ?Guess\ValueGuess),
            //new AddReturnTypeDeclaration('Symfony\Component\Form\FormTypeGuesserInterface', 'guessMaxLength', ?Guess\ValueGuess),
            //new AddReturnTypeDeclaration('Symfony\Component\Form\FormTypeGuesserInterface', 'guessPattern', ?Guess\ValueGuess),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Form\FormTypeInterface',
                'getBlockPrefix',
                new StringType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\Form\FormTypeInterface', 'getParent', ?new StringType()),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface',
                'isOptional',
                new BooleanType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface',
                'warmUp',
                $arrayType
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\DataCollector\DataCollector',
                'getCasters',
                $arrayType
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface',
                'getName',
                new StringType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\HttpCache\HttpCache',
                'forward',
                $httpFoundationResponseType
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\HttpKernelBrowser',
                'doRequest',
                $httpFoundationResponseType
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\HttpKernelBrowser',
                'getScript',
                new StringType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\Log\DebugLoggerInterface',
                'getLogs',
                $arrayType
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\HttpKernel\Log\DebugLoggerInterface',
                'countErrors',
                new IntegerType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\OptionsResolver\OptionsResolver',
                'setNormalizer',
                new StaticType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\OptionsResolver\OptionsResolver',
                'setAllowedValues',
                new StaticType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\OptionsResolver\OptionsResolver',
                'addAllowedValues',
                new StaticType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\OptionsResolver\OptionsResolver',
                'setAllowedTypes',
                new StaticType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\OptionsResolver\OptionsResolver',
                'addAllowedTypes',
                new StaticType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\PropertyAccess\PropertyPathInterface',
                'getLength',
                new IntegerType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\PropertyAccess\PropertyPathInterface',
                'getParent',
                new UnionType([
                    new NullType(),
                    new ObjectType('Symfony\Component\PropertyAccess\PropertyPathInterface'),
                ])
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\PropertyAccess\PropertyPathInterface',
                'getElements',
                $arrayType
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\PropertyAccess\PropertyPathInterface',
                'getElement',
                new StringType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\PropertyAccess\PropertyPathInterface',
                'isProperty',
                new BooleanType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\PropertyAccess\PropertyPathInterface',
                'isIndex',
                new BooleanType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\PropertyInfo\PropertyAccessExtractorInterface', 'isReadable', ?new \PHPStan\Type\BooleanType()),
            //new AddReturnTypeDeclaration('Symfony\Component\PropertyInfo\PropertyAccessExtractorInterface', 'isWritable', ?new \PHPStan\Type\BooleanType()),
            //new AddReturnTypeDeclaration('Symfony\Component\PropertyInfo\PropertyListExtractorInterface', 'getProperties', ?$arrayType),
            //new AddReturnTypeDeclaration('Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface', 'getTypes', ?$arrayType),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Routing\Loader\AnnotationClassLoader',
                'getDefaultRouteName',
                new StringType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\Routing\Router', 'getRouteCollection', RouteCollection),
            //new AddReturnTypeDeclaration('Symfony\Component\Routing\RouterInterface', 'getRouteCollection', RouteCollection),
            //new AddReturnTypeDeclaration('Symfony\Component\Security\Core\Authentication\RememberMe\TokenProviderInterface', 'loadTokenBySeries',, PersistentTokenInterface)
            new AddReturnTypeDeclaration(
                'Symfony\Component\Security\Core\Authorization\Voter\VoterInterface',
                'vote',
                new IntegerType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Security\Core\Exception\AuthenticationException',
                'getMessageKey',
                new StringType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\Security\Core\User\UserProviderInterface', 'refreshUser', UserInterface),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Security\Core\User\UserProviderInterface',
                'supportsClass',
                new BooleanType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface', 'start', $reponseType),
            new AddReturnTypeDeclaration('Symfony\Component\Security\Http\Firewall', 'getSubscribedEvents', $arrayType),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Security\Http\FirewallMapInterface',
                'getListeners',
                $arrayType
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Encoder\DecoderInterface',
                'decode',
                new MixedType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Encoder\DecoderInterface',
                'supportsDecoding',
                new BooleanType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\Serializer\Normalizer\AbstractNormalizer', 'getAllowedAttributes', array|new \PHPStan\Type\BooleanType()),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\AbstractNormalizer',
                'isAllowedAttribute',
                new BooleanType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\AbstractNormalizer',
                'instantiateObject',
                new \PHPStan\Type\ObjectWithoutClassType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer',
                'supportsNormalization',
                new BooleanType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer', 'normalize',, array|string|int|float|bool|\ArrayObject|null)
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer',
                'instantiateObject',
                new \PHPStan\Type\ObjectWithoutClassType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer',
                'extractAttributes',
                $arrayType
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer',
                'getAttributeValue',
                new MixedType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer',
                'supportsDenormalization',
                new BooleanType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer',
                'denormalize',
                new MixedType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\DenormalizerInterface',
                'denormalize',
                new MixedType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\DenormalizerInterface',
                'supportsDenormalization',
                new BooleanType()
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\Serializer\Normalizer\NormalizerInterface', 'normalize',, array|string|int|float|bool|\ArrayObject|null)
            new AddReturnTypeDeclaration(
                'Symfony\Component\Serializer\Normalizer\NormalizerInterface',
                'supportsNormalization',
                new BooleanType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Templating\Helper\HelperInterface',
                'getName',
                new StringType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Translation\Extractor\AbstractFileExtractor',
                'canBeExtracted',
                new BooleanType()
            ),
            new AddReturnTypeDeclaration(
                'Symfony\Component\Translation\Extractor\AbstractFileExtractor',
                'extractFromDirectory',
                $iterableType
            ),
            //new AddReturnTypeDeclaration('Symfony\Component\Validator\Constraint', 'getDefaultOption', ?new StringType()),
            new AddReturnTypeDeclaration('Symfony\Component\Validator\Constraint', 'getRequiredOptions', $arrayType),
            new AddReturnTypeDeclaration('Symfony\Component\Validator\Constraint', 'validatedBy', new StringType()),
            //new AddReturnTypeDeclaration('Symfony\Component\Validator\Constraint', 'getTargets', string|$arrayType),
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
