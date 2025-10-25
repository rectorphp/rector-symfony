<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\RemoveConstructorAutowireServiceRector\Source;

final class AnotherClassWithoutConstructor
{
    public function __construct(
        PassedAsDependency $passedAsDependency
    ) {
    }
}
