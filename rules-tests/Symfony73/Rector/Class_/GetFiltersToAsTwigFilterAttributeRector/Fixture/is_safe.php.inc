<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersToAsTwigFilterAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class IsSafe extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new \Twig\TwigFilter('some_filter', [$this, 'someFilter'], [
                'is_safe' => ['html'],
            ]),
        ];
    }

    public function someFilter($value)
    {
        return $value;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersToAsTwigFilterAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class IsSafe
{
    #[\Twig\Attribute\AsTwigFilter(name: 'some_filter', isSafe: ['html'])]
    public function someFilter($value)
    {
        return $value;
    }
}

?>
