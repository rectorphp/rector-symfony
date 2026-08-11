<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersAndFunctionsToAsTwigAttributeRector\Fixture;

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

    public function someFunction($value)
    {
        return $value;
    }
}

?>
