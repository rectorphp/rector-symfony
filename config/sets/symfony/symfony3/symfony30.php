<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;

// resources:
// https://github.com/symfony/symfony/blob/3.4/UPGRADE-3.0.md
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-forms.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-http-foundation.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-class-loader.php');

    $rectorConfig->ruleWithConfiguration(RenameMethodRector::class, [
        new MethodCallRename('Symfony\Component\Process\Process', 'setStdin', 'setInput'),
        new MethodCallRename('Symfony\Component\Process\Process', 'getStdin', 'getInput'),
        // monolog
        new MethodCallRename('Symfony\Bridge\Monolog\Logger', 'emerg', 'emergency'),
        new MethodCallRename('Symfony\Bridge\Monolog\Logger', 'crit', 'critical'),
        new MethodCallRename('Symfony\Bridge\Monolog\Logger', 'err', 'error'),
        new MethodCallRename('Symfony\Bridge\Monolog\Logger', 'warn', 'warning'),
        # http kernel
        new MethodCallRename('Symfony\Component\HttpKernel\Log\LoggerInterface', 'emerg', 'emergency'),
        new MethodCallRename('Symfony\Component\HttpKernel\Log\LoggerInterface', 'crit', 'critical'),
        new MethodCallRename('Symfony\Component\HttpKernel\Log\LoggerInterface', 'err', 'error'),
        new MethodCallRename('Symfony\Component\HttpKernel\Log\LoggerInterface', 'warn', 'warning'),
        new MethodCallRename('Symfony\Component\HttpKernel\Log\NullLogger', 'emerg', 'emergency'),
        new MethodCallRename('Symfony\Component\HttpKernel\Log\NullLogger', 'crit', 'critical'),
        new MethodCallRename('Symfony\Component\HttpKernel\Log\NullLogger', 'err', 'error'),
        new MethodCallRename('Symfony\Component\HttpKernel\Log\NullLogger', 'warn', 'warning'),
        // property access
        new MethodCallRename(
            'Symfony\Component\PropertyAccess\PropertyAccess',
            'getPropertyAccessor',
            'createPropertyAccessor'
        ),
        // translator
        new MethodCallRename('Symfony\Component\Translation\Dumper\FileDumper', 'format', 'formatCatalogue'),
        new MethodCallRename('Symfony\Component\Translation\Translator', 'getMessages', 'getCatalogue'),
        // validator
        new MethodCallRename(
            'Symfony\Component\Validator\ConstraintViolationInterface',
            'getMessageParameters',
            'getParameters'
        ),
        new MethodCallRename(
            'Symfony\Component\Validator\ConstraintViolationInterface',
            'getMessagePluralization',
            'getPlural'
        ),
        new MethodCallRename(
            'Symfony\Component\Validator\ConstraintViolation',
            'getMessageParameters',
            'getParameters'
        ),
        new MethodCallRename(
            'Symfony\Component\Validator\ConstraintViolation',
            'getMessagePluralization',
            'getPlural'
        ),
    ]);

    $rectorConfig->ruleWithConfiguration(RenameClassRector::class, [
        # console
        'Symfony\Component\Console\Helper\ProgressHelper' => 'Symfony\Component\Console\Helper\ProgressBar',
        # http kernel
        'Symfony\Component\HttpKernel\Debug\ErrorHandler' => 'Symfony\Component\Debug\ErrorHandler',
        'Symfony\Component\HttpKernel\Debug\ExceptionHandler' => 'Symfony\Component\Debug\ExceptionHandler',
        'Symfony\Component\HttpKernel\Exception\FatalErrorException' => 'Symfony\Component\Debug\Exception\FatalErrorException',
        'Symfony\Component\HttpKernel\Exception\FlattenException' => 'Symfony\Component\Debug\Exception\FlattenException',
        # partial with method rename
        'Symfony\Component\HttpKernel\Log\LoggerInterface' => 'Psr\Log\LoggerInterface',
        # event disptacher
        'Symfony\Component\HttpKernel\DependencyInjection\RegisterListenersPass' => 'Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass',
        # partial with methor rename
        'Symfony\Component\HttpKernel\Log\NullLogger' => 'Psr\Log\LoggerInterface',
        # monolog
        # partial with method rename
        'Symfony\Bridge\Monolog\Logger' => 'Psr\Log\LoggerInterface',
        # security
        'Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter' => 'Symfony\Component\Security\Core\Authorization\Voter\Voter',
        # twig
        'Symfony\Bundle\TwigBundle\TwigDefaultEscapingStrategy' => 'Twig_FileExtensionEscapingStrategy',
        # validator
        'Symfony\Component\Validator\Constraints\Collection\Optional' => 'Symfony\Component\Validator\Constraints\Optional',
        'Symfony\Component\Validator\Constraints\Collection\Required' => 'Symfony\Component\Validator\Constraints\Required',
        'Symfony\Component\Validator\MetadataInterface' => 'Symfony\Component\Validator\Mapping\MetadataInterface',
        'Symfony\Component\Validator\PropertyMetadataInterface' => 'Symfony\Component\Validator\Mapping\PropertyMetadataInterface',
        'Symfony\Component\Validator\PropertyMetadataContainerInterface' => 'Symfony\Component\Validator\Mapping\ClassMetadataInterface',
        'Symfony\Component\Validator\ClassBasedInterface' => 'Symfony\Component\Validator\Mapping\ClassMetadataInterface',
        'Symfony\Component\Validator\Mapping\ElementMetadata' => 'Symfony\Component\Validator\Mapping\GenericMetadata',
        'Symfony\Component\Validator\ExecutionContextInterface' => 'Symfony\Component\Validator\Context\ExecutionContextInterface',
        'Symfony\Component\Validator\Mapping\ClassMetadataFactory' => 'Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory',
        'Symfony\Component\Validator\Mapping\MetadataFactoryInterface' => 'Symfony\Component\Validator\Mapping\Factory\MetadataFactoryInterface',
        # swift mailer
        'Symfony\Bridge\Swiftmailer\DataCollector\MessageDataCollector' => 'Symfony\Bundle\SwiftmailerBundle\DataCollector\MessageDataCollector',
    ]);
};
