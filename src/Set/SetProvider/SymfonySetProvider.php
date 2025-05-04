<?php

declare(strict_types=1);

namespace Rector\Symfony\Set\SetProvider;

use Rector\Set\Contract\SetInterface;
use Rector\Set\Contract\SetProviderInterface;
use Rector\Set\Enum\SetGroup;
use Rector\Set\ValueObject\ComposerTriggeredSet;
use Rector\Set\ValueObject\Set;

final class SymfonySetProvider implements SetProviderInterface
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
                '2.5',
                __DIR__ . '/../../../config/sets/symfony/symfony25.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '2.6',
                __DIR__ . '/../../../config/sets/symfony/symfony26.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
                '2.7',
                __DIR__ . '/../../../config/sets/symfony/symfony27.php'
            ),

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

<<<<<<< HEAD
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

            // @todo split rest

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
<<<<<<< HEAD
=======
=======
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/symfony',
>>>>>>> 0f95e7a ([symfony 4.1] split to particular configs)
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

            // @todo split rest

            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
>>>>>>> b7c411c (move)
                '4.2',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony42.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '4.3',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony43.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '4.4',
                __DIR__ . '/../../../config/sets/symfony/symfony4/symfony44.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '5.0',
                __DIR__ . '/../../../config/sets/symfony/symfony50.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '5.1',
                __DIR__ . '/../../../config/sets/symfony/symfony51.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '5.2',
                __DIR__ . '/../../../config/sets/symfony/symfony52.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '5.3',
                __DIR__ . '/../../../config/sets/symfony/symfony53.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '5.4',
                __DIR__ . '/../../../config/sets/symfony/symfony54.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '6.0',
                __DIR__ . '/../../../config/sets/symfony/symfony60.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '6.1',
                __DIR__ . '/../../../config/sets/symfony/symfony61.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '6.2',
                __DIR__ . '/../../../config/sets/symfony/symfony62.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '6.3',
                __DIR__ . '/../../../config/sets/symfony/symfony63.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '6.4',
                __DIR__ . '/../../../config/sets/symfony/symfony64.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '7.0',
                __DIR__ . '/../../../config/sets/symfony/symfony70.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '7.1',
                __DIR__ . '/../../../config/sets/symfony/symfony71.php'
            ),
            new ComposerTriggeredSet(
                SetGroup::SYMFONY,
                'symfony/*',
                '7.2',
                __DIR__ . '/../../../config/sets/symfony/symfony72.php'
            ),

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
                __DIR__ . '/../../../config/sets/symfony/symfony52-validator-attributes.php'
            ),
        ];
    }
}
