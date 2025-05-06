<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Symfony\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector;
use Rector\Symfony\Symfony62\Rector\Class_\MessageSubscriberInterfaceToAttributeRector;
use Rector\Symfony\Symfony62\Rector\Class_\SecurityAttributeToIsGrantedAttributeRector;
use Rector\Symfony\Symfony62\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        SecurityAttributeToIsGrantedAttributeRector::class,
        ParamConverterAttributeToMapEntityAttributeRector::class,

        // @see https://github.com/symfony/symfony/pull/47068, #[AsMessageHandler] attribute
        MessageHandlerInterfaceToAttributeRector::class,
        MessageSubscriberInterfaceToAttributeRector::class,
    ]);

    // change to attribute before rename
    // https://symfony.com/blog/new-in-symfony-6-2-built-in-cache-security-template-and-doctrine-attributes
    // @see https://github.com/rectorphp/rector-symfony/issues/535#issuecomment-1783983383
    $rectorConfig->ruleWithConfiguration(AnnotationToAttributeRector::class, [
        // @see https://github.com/symfony/symfony/pull/46907
        new AnnotationToAttribute('Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted'),
        // @see https://github.com/symfony/symfony/pull/46880
        new AnnotationToAttribute('Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache'),
        // @see https://github.com/symfony/symfony/pull/46906
        new AnnotationToAttribute('Sensio\Bundle\FrameworkExtraBundle\Configuration\Template'),
    ]);

    // https://symfony.com/blog/new-in-symfony-6-2-built-in-cache-security-template-and-doctrine-attributes
    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            // @see https://github.com/symfony/symfony/pull/46714
            'Symfony\Component\Mailer\Bridge\OhMySmtp\Transport\OhMySmtpApiTransport' => 'Symfony\Component\Mailer\Bridge\MailPace\Transport\MailPaceApiTransport',
            'Symfony\Component\Mailer\Bridge\OhMySmtp\Transport\OhMySmtpSmtpTransport' => 'Symfony\Component\Mailer\Bridge\MailPace\Transport\MailPaceSmtpTransport',
            'Symfony\Component\Mailer\Bridge\OhMySmtp\Transport\OhMySmtpTransportFactory' => 'Symfony\Component\Mailer\Bridge\MailPace\Transport\MailPaceTransportFactory',
            // @see https://github.com/symfony/symfony/pull/46161
            'Symfony\Component\Translation\Extractor\PhpAstExtractor' => 'Symfony\Component\Translation\Extractor\PhpAstExtractor',
        ],
    );

    $rectorConfig->import(__DIR__ . '/symfony62/symfony62-security-core.php');
    $rectorConfig->import(__DIR__ . '/symfony62/symfony62-security-http.php');
    $rectorConfig->import(__DIR__ . '/symfony62/symfony62-mime.php');
    $rectorConfig->import(__DIR__ . '/symfony62/symfony62-http-kernel.php');
    $rectorConfig->import(__DIR__ . '/symfony62/symfony62-framework-bundle.php');
    $rectorConfig->import(__DIR__ . '/symfony62/symfony62-http-foundation.php');
    $rectorConfig->import(__DIR__ . '/symfony62/symfony62-twig-bridge.php');
};
