<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Source;

final class TypeList
{
    /**
     * @return string[]
     */
    public function getChoices(): array
    {
        return ['first', 'second'];
    }

    /**
     * @return string[]
     */
    public static function provideChoices(): array
    {
        return ['first', 'second'];
    }
}
