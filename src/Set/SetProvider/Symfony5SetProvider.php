<?php

declare(strict_types=1);

namespace Rector\Symfony\Set\SetProvider;

use Rector\Set\Contract\SetInterface;
use Rector\Set\Contract\SetProviderInterface;
use Rector\Set\Enum\SetGroup;
use Rector\Set\ValueObject\ComposerTriggeredSet;

final class Symfony5SetProvider implements SetProviderInterface
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
                '5.0',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony50.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/console',
                '5.0',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony50/symfony50-console.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/debug',
                '5.0',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony50/symfony50-debug.php'
            ),

            // @todo handle types per package?
            // __DIR__ . '/../../../config/sets/symfony/symfony5/symfony50/symfony50-types.php'

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/config',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-config.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/console',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-console.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/dependency-injection',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-dependency-injection.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/event-dispatcher',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-event-dispatcher.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/forms',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-forms.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/framework-bundle',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-framework-bundle.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-foundation',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-http-foundation.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/inflector',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-inflector.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/notifier',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-notifier.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/security-http',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-security-http.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/security-core',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony51/symfony51-security-core.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '5.2',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony52.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '5.3',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony53.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '5.4',
                __DIR__ . '/../../../config/sets/symfony/symfony5/symfony54.php'
            ),
        ];
    }
}
