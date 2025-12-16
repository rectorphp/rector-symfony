<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersToAsTwigFilterAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SomeGetFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new \Twig\TwigFilter('some_filter', [$this, 'someFilter']),
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

final class SomeGetFilter
{
    #[\Twig\Attribute\AsTwigFilter(name: 'some_filter')]
    public function someFilter($value)
    {
        return $value;
    }
}

?>
