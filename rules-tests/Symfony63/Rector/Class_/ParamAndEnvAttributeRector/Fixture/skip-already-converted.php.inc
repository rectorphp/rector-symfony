<?php

namespace Rector\Symfony\Tests\Symfony63\Rector\Class_\ParamAndEnvAttributeRector\Fixture;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class SkipAlreadyConverted
{
    public function __construct(
        #[Autowire(param: '%kernel.debug%')]
        bool $debugMode,
    ) {
    }
}
