<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersAndFunctionsToAsTwigAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SkipUnconvertibleGetFilters extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('some_function', [$this, 'someFunction']),
        ];
    }

    public function getFilters(): array
    {
        return [
            new \Twig\TwigFilter('some_filter', fn ($value) => $value),
        ];
    }

    public function someFunction($value)
    {
        return $value;
    }
}
