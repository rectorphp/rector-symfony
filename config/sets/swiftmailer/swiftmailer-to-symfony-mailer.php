<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Symfony\Rector\MethodCall\SwiftCreateMessageToNewEmailRector;

// @see https://symfony.com/blog/the-end-of-swiftmailer
return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();

    $services->set(SwiftCreateMessageToNewEmailRector::class);

    $services->set(RenameClassRector::class)
        ->configure([
            'Swift_Mailer' => 'Symfony\Component\Mailer\MailerInterface',
            'Swift_Message' => 'Symfony\Component\Mime\Email',
            // message
            'Swift_Mime_SimpleMessage' => 'Symfony\Component\Mime\RawMessage',
            // transport
            'Swift_SmtpTransport' => 'Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport',
            'Swift_FailoverTransport' => 'Symfony\Component\Mailer\Transport\FailoverTransport',
            'Swift_SendmailTransport' => 'Symfony\Component\Mailer\Transport\SendmailTransport',
        ]);
};
