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
        ];
    }
}
