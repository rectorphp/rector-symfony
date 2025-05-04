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
        ];
    }
}
