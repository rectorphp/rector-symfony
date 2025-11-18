<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source;

use Symfony\Component\HttpFoundation\RequestStack;

final class SomeClassWithRequestStack
{
    public function __construct(RequestStack $requestStack)
    {
    }
}
