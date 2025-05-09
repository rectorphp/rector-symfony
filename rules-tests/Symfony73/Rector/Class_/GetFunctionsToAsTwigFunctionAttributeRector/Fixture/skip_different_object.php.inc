<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SkipDifferentObject extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('some_function', [$differentObject, 'someFunction']),
            new \Twig\TwigFunction('some_function', $differentObject->someFunction(...)),
        ];
    }
}

?>
