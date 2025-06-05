<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersToAsTwigFilterAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class WithFirstClassCallableFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new \Twig\TwigFilter('some_filter', $this->someFilter(...)),
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

final class WithFirstClassCallableFilter extends AbstractExtension
{
    #[\Twig\Attribute\AsTwigFilter('some_filter')]
    public function someFilter($value)
    {
        return $value;
    }
}

?>
