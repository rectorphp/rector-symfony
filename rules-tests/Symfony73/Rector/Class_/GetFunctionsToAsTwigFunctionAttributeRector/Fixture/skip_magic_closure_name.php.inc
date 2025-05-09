<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SkipMagicClosureName extends AbstractExtension
{
    public function getFunctions(): array
    {
        $magic = 'anything';

        return [
            new \Twig\TwigFunction('another_function', $this->{$magic}(...)),
        ];
    }

    public function someFunction($value)
    {
        return $value;
    }

    public function anotherFunction($value)
    {
        return $value;
    }
}
