<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

final class SkipGlobalsInterface extends AbstractExtension implements GlobalsInterface
{
    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('some_function', [$this, 'someFunction']),
        ];
    }

    public function getGlobals(): array
    {
        return [];
    }

    public function someFunction($value)
    {
        return $value;
    }
}
