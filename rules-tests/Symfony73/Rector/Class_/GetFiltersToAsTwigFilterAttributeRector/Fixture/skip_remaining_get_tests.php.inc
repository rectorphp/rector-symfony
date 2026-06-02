<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersToAsTwigFilterAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SkipRemainingGetTests extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new \Twig\TwigFilter('some_filter', [$this, 'someFilter']),
        ];
    }

    public function getTests(): array
    {
        return [
            new \Twig\TwigTest('some_test', [$this, 'someTest']),
        ];
    }

    public function someFilter($value)
    {
        return $value;
    }

    public function someTest($value)
    {
        return $value;
    }
}
