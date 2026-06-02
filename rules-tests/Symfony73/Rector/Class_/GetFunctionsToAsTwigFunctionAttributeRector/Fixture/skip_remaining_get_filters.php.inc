<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SkipRemainingGetFilters extends AbstractExtension
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
            new \Twig\TwigFilter('some_filter', [$this, 'someFilter']),
        ];
    }

    public function someFunction($value)
    {
        return $value;
    }

    public function someFilter($value)
    {
        return $value;
    }
}
