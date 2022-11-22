<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Symfony\Rector\MethodCall\SimplifyFormRenderingRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(SimplifyFormRenderingRector::class);

    // https://symfony.com/blog/new-in-symfony-6-2-built-in-cache-security-template-and-doctrine-attributes
    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            // @see https://github.com/symfony/symfony/pull/46907
            'Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted' => 'Symfony\Component\Security\Http\Attribute\IsGranted',
            // @see https://github.com/symfony/symfony/pull/46880
            'Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache' => 'Symfony\Component\HttpKernel\Attribute\Cache',
            // @see https://github.com/symfony/symfony/pull/46906
            'Sensio\Bundle\FrameworkExtraBundle\Configuration\Template' => 'Symfony\Bridge\Twig\Attribute\Template',
            // @see https://github.com/symfony/symfony/pull/46714
            'Symfony\Component\Mailer\Bridge\OhMySmtp\Transport\OhMySmtpApiTransport' => 'Symfony\Component\Mailer\Bridge\MailPace\Transport\MailPaceApiTransport',
            'Symfony\Component\Mailer\Bridge\OhMySmtp\Transport\OhMySmtpSmtpTransport' => 'Symfony\Component\Mailer\Bridge\MailPace\Transport\MailPaceSmtpTransport',
            'Symfony\Component\Mailer\Bridge\OhMySmtp\Transport\OhMySmtpTransportFactory' => 'Symfony\Component\Mailer\Bridge\MailPace\Transport\MailPaceTransportFactory',
            // @see https://github.com/symfony/symfony/pull/47363
            'Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface' => 'Symfony\Component\HttpKernel\Controller\ValueResolverInterface',
            // @see https://github.com/symfony/symfony/pull/46094
            'Symfony\Component\Security\Core\Security' => 'Symfony\Bundle\SecurityBundle\Security\Security',
            // @see https://github.com/symfony/symfony/pull/46161
            'Symfony\Component\Translation\Extractor\PhpAstExtractor' => 'Symfony\Component\Translation\Extractor\PhpAstExtractor',
        ],
    );

    $rectorConfig->ruleWithConfiguration(
        RenameMethodRector::class,
        [
            // @see https://github.com/symfony/symfony/pull/46854
            new MethodCallRename(
                'Symfony\Bundle\FrameworkBundle\Controller\AbstractController',
                'renderForm',
                'render'
            ),
            // @see https://github.com/symfony/symfony/pull/45034
            new MethodCallRename(
                'Symfony\Component\HttpFoundation\Request',
                'getContentType',
                'getContentTypeFormat'
            ),
            // @see https://github.com/symfony/symfony/pull/47711
            new MethodCallRename('Symfony\Component\Mime\Email', 'attachPart', 'addPart'),
        ],
    );
};
