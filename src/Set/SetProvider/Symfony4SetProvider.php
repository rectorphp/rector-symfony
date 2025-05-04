<?php

declare(strict_types=1);

namespace Rector\Symfony\Set\SetProvider;

use Rector\Set\Contract\SetInterface;
use Rector\Set\Contract\SetProviderInterface;
use Rector\Set\Enum\SetGroup;
use Rector\Set\ValueObject\ComposerTriggeredSet;

final class Symfony4SetProvider implements SetProviderInterface
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
                '4.0',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony40.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/dependency-injection',
                '4.0',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony40/symfony40-dependency-injection.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/process',
                '4.0',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony40/symfony40-process.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/validator',
                '4.0',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony40/symfony40-validator.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/var-dumper',
                '4.0',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony40/symfony40-var-dumper.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/forms',
                '4.0',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony40/symfony40-forms.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '4.1',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony41.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/console',
                '4.1',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony41/symfony41-console.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/framework-bundle',
                '4.1',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony41/symfony41-framework-bundle.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-foundation',
                '4.1',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony41/symfony41-http-foundation.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/workflow',
                '4.1',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony41/symfony41-workflow.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/framework-bundle',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-framework-bundle.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-foundation',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-http-foundation.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-kernel',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-http-kernel.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/monolog-bridge',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-monolog-bridge.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/cache',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-cache.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/config',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-config.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/dom-crawler',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-dom-crawler.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/forms',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-forms.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/finder',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-finder.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/framework-bundle',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-framework-bundle.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/process',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-process.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/serializer',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-serializer.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/translation',
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42/symfony42-translation.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/workflow',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-workflow.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/browser-kit',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-browser-kit.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/cache',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-cache.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/event-dispatcher',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-event-dispatcher.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/framework-bundle',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-framework-bundle.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-foundation',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-http-foundation.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-kernel',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-http-kernel.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/intl',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-intl.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/security-core',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-security-core.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/security-http',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-security-http.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/twig-bundle',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-twig-bundle.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/workflow',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43/symfony43-workflow.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/console',
                '4.4',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony44/symfony44-console.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/dependency-injection',
                '4.4',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony44/symfony44-dependency-injection.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-kernel',
                '4.4',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony44/symfony44-http-kernel.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/security-core',
                '4.4',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony44/symfony44-security-core.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/templating',
                '4.4',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony44/symfony44-templating.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '4.4',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony44.php'
            ),
        ];
    }
}
