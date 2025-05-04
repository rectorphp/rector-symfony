<?php

declare(strict_types=1);

namespace Rector\Symfony\Set\SetProvider;

use Rector\Set\Contract\SetInterface;
use Rector\Set\Contract\SetProviderInterface;
use Rector\Set\Enum\SetGroup;
use Rector\Set\ValueObject\ComposerTriggeredSet;

final class Symfony3SetProvider implements SetProviderInterface
{
    /**
     * @return SetInterface[]
     */
    public function provide(): array
    {
        return [
            // symfony 3.0
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/bridge-swift-mailer',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-bridge-swift-mailer.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/class-loader',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-class-loader.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/console',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-console.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/forms',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-forms.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-foundation',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-http-foundation.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/http-kernel',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-http-kernel.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/process',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-process.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/property-access',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-property-access.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/security',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-security.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/translation',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-translation.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/twig-bundle',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-twig-bundle.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/validator',
                '3.0',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony30/symfony30-validator.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '3.1',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony31.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/yaml',
                '3.1',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony31/symfony31-yaml.php'
            ),

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '3.2',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony32.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '3.3',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony33.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '3.4',
                __DIR__ . '/../../../config/sets/symfony/symfony3/symfony34.php'
            ),
        ];
    }
}
