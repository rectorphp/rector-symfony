<?php

declare(strict_types=1);

use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Renaming\Rector\ClassConstFetch\RenameClassConstFetchRector;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Renaming\ValueObject\RenameClassAndConstFetch;
use Rector\Renaming\ValueObject\RenameClassConstFetch;
use Rector\Symfony\Set\SymfonySetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

# https://github.com/symfony/symfony/blob/5.x/UPGRADE-5.4.md

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES);

    $services = $containerConfigurator->services();

    // @see https://symfony.com/blog/new-in-symfony-5-4-nested-validation-attributes
    // @see https://github.com/symfony/symfony/pull/41994
    $services->set(AnnotationToAttributeRector::class)
        ->configure([
            new AnnotationToAttribute('Symfony\Component\Validator\Constraints\All'),
            new AnnotationToAttribute('Symfony\Component\Validator\Constraints\Collection'),
            new AnnotationToAttribute('Symfony\Component\Validator\Constraints\AtLeastOneOf'),
            new AnnotationToAttribute('Symfony\Component\Validator\Constraints\Sequentially'),
        ]);

    $services = $containerConfigurator->services();
    $services->set(RenameMethodRector::class)
        ->configure([
            // @see https://github.com/symfony/symfony/pull/42582
            new MethodCallRename(
                'Symfony\Bundle\SecurityBundle\Security\FirewallConfig',
                'getListeners',
                'getAuthenticators'
            ),
        ]);

    $services->set(RenameClassConstFetchRector::class)
        ->configure([
            new RenameClassAndConstFetch(
                'Symfony\Component\Security\Core\AuthenticationEvents',
                'AUTHENTICATION_SUCCESS',
                'Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent',
                'class'
            ),
            new RenameClassAndConstFetch(
                'Symfony\Component\Security\Core\AuthenticationEvents',
                'AUTHENTICATION_FAILURE',
                'Symfony\Component\Security\Core\Event\AuthenticationFailureEvent',
                'class'
            ),
            // @see https://github.com/symfony/symfony/pull/42510
            new RenameClassConstFetch(
                'Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter',
                'IS_ANONYMOUS',
                'PUBLIC_ACCESS'
            ),
            new RenameClassConstFetch(
                'Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter',
                'IS_AUTHENTICATED_ANONYMOUSLY',
                'PUBLIC_ACCESS'
            ),
        ]);

    $services->set(RenameClassRector::class)
        ->configure([
            // @see https://github.com/symfony/symfony/pull/42050
            'Symfony\Component\Security\Http\Event\DeauthenticatedEvent' => 'Symfony\Component\Security\Http\Event\TokenDeauthenticatedEvent',
        ]);
};
