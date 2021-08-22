<?php

declare(strict_types=1);

use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Symfony\Rector\MethodCall\SwiftCreateMessageToNewEmailRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

// @see https://symfony.com/blog/the-end-of-swiftmailer
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SwiftCreateMessageToNewEmailRector::class);
    $services->set(RenameClassRector::class)
        ->call('configure', [[
            RenameClassRector::OLD_TO_NEW_CLASSES => [
                '\Swift_Mailer' => 'Symfony\Component\Mailer\MailerInterface',
                '\Swift_Message' => 'Symfony\Component\Mime\Email',
            ],
        ]]);
};
