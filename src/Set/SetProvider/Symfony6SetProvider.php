<?php

declare(strict_types=1);

namespace Rector\Symfony\Set\SetProvider;

use Rector\Set\Contract\SetInterface;
use Rector\Set\Contract\SetProviderInterface;
use Rector\Set\Enum\SetGroup;
use Rector\Set\ValueObject\ComposerTriggeredSet;

final class Symfony6SetProvider implements SetProviderInterface
{
    /**
     * @return SetInterface[]
     */
    public function provide(): array
    {
        return [
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/dependency-injection',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-dependency-injection.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/contracts',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-contracts.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/config',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-config.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/framework-bundle',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-framework-bundle.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/doctrine-bridge',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-doctrine-bridge.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/security-core',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-security-core.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/serializer',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-serializer.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/security-http',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-security-http.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/console',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-console.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/browser-kit',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-browser-kit.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-kernel',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-http-kernel.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/validator',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-validator.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/form',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-form.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/translation',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-translation.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/property-access',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-property-access.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/property-info',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-property-info.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/routing',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-routing.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/templating',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-templating.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/event-dispatcher',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-event-dispatcher.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/expression-language',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-expression-language.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/options-resolver',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony60/symfony60-options-resolver.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '6.1',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony61.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/serializer',
                '6.1',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony61/symfony61-serializer.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/validator',
                '6.1',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony61/symfony61-validator.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/console',
                '6.1',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony61/symfony61-console.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/twig-bridge',
                '6.1',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony61/symfony61-twig-bridge.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/security-core',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-security-core.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/security-http',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-security-http.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/mime',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-mime.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-kernel',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-http-kernel.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/framework-bundle',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-framework-bundle.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-foundation',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-http-foundation.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/twig-bridge',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-twig-bridge.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/translation',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-translation.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/doctrine-bridge',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-doctrine-bridge.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/messenger',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-messenger.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/mail-pace-mailer',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony62/symfony62-mail-pace-mailer.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '6.3',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony63.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/dependency-injection',
                '6.3',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony63/symfony63-dependency-injection.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-client',
                '6.3',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony63/symfony63-http-client.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/messenger',
                '6.3',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony63/symfony63-messenger.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/console',
                '6.3',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony63/symfony63-console.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/web-link',
                '6.3',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony63/symfony63-web-link.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '6.4',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony64.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/routing',
                '6.4',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony64/symfony64-routing.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/form',
                '6.4',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony64/symfony64-form.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-foundation',
                '6.4',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony64/symfony64-http-foundation.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/error-handler',
                '6.4',
                __DIR__ . '/../../../config/sets/symfony/symfony6/symfony64/symfony64-error-handler.php'
            ),
        ];
    }
}
