<?php

namespace Rector\Symfony\Tests\Symfony63\Rector\Class_\ParamAndEnvAttributeRector\Fixture;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class SkipFormatMissMatch
{
    public function __construct(
        #[Autowire('%kernel_ebug')]
        bool $debugMode,
    ) {
    }
}
