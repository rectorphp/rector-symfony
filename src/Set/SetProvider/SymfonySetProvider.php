<?php

declare(strict_types=1);

namespace Rector\Symfony\Set\SetProvider;

use Rector\Set\Contract\SetInterface;
use Rector\Set\Contract\SetProviderInterface;
use Rector\Set\ValueObject\ComposerTriggeredSet;

final class SymfonySetProvider implements SetProviderInterface
{
    /**
     * @return SetInterface[]
     */
    public function provide(): array
    {
        return [
            new ComposerTriggeredSet('symfony', 'symfony/*', '', __DIR__ . '/../../../config/sets/twig.php'),
        ];
    }
}
