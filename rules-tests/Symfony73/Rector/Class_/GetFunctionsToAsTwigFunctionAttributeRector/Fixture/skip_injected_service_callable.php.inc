<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SkipInjectedServiceCallable extends AbstractExtension
{
    public function __construct(
        private SomeInjectedService $myInjectedService
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('some_function', [$this, 'someFunction']),
            new \Twig\TwigFunction('function_name', [$this->myInjectedService, 'serviceFunction']),
        ];
    }

    public function someFunction($value)
    {
        return $value;
    }
}
