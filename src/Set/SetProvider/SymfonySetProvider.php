<?php

declare(strict_types=1);

namespace Rector\Symfony\Set\SetProvider;

use Rector\Set\Contract\SetInterface;
use Rector\Set\Contract\SetProviderInterface;
use Rector\Set\Enum\SetGroup;
use Rector\Set\ValueObject\Set;

final class SymfonySetProvider implements SetProviderInterface
{
    /**
     * @return SetInterface[]
     */
    public function provide(): array
    {
        return [
            // holds rules bound to the exact Symfony package version they are available from,
            // so the whole set can be run at once, no matter the Symfony version in the project
            new Set(SetGroup::SYMFONY, 'Composer Based', __DIR__ . '/../../../config/sets/symfony/composer-based.php'),

            new Set(SetGroup::SYMFONY, 'Configs', __DIR__ . '/../../../config/sets/symfony/configs.php'),
            new Set(
                SetGroup::SYMFONY,
                'Code Quality',
                __DIR__ . '/../../../config/sets/symfony/symfony-code-quality.php'
            ),
            new Set(
                SetGroup::SYMFONY,
                'Constructor Injection',
                __DIR__ . '/../../../config/sets/symfony/symfony-constructor-injection.php'
            ),
            new Set(
                SetGroup::SYMFONY,
                'SwiftMailer to Symfony Mailer',
                __DIR__ . '/../../../config/sets/swiftmailer/swiftmailer-to-symfony-mailer.php'
            ),

            // attributes
            new Set(
                SetGroup::ATTRIBUTES,
                'FOS Rest',
                __DIR__ . '/../../../config/sets/fosrest/annotations-to-attributes.php'
            ),

            new Set(SetGroup::ATTRIBUTES, 'JMS', __DIR__ . '/../../../config/sets/jms/annotations-to-attributes.php'),

            new Set(
                SetGroup::ATTRIBUTES,
                'Sensiolabs',
                __DIR__ . '/../../../config/sets/sensiolabs/annotations-to-attributes.php'
            ),
            new Set(
                SetGroup::ATTRIBUTES,
                'Symfony',
                __DIR__ . '/../../../config/sets/symfony/annotations-to-attributes.php'
            ),
            new Set(
                SetGroup::ATTRIBUTES,
                'Symfony Validator',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony52-validator-attributes.php'
            ),
        ];
    }
}
