<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SkipDifferentClass extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('some_function', [DifferentClass::class, 'someFunction']),
            new \Twig\TwigFunction('some_function', $this->someFunction(...)),
        ];
    }

    public function someFunction($value)
    {
        return $value;
    }
}

?>
