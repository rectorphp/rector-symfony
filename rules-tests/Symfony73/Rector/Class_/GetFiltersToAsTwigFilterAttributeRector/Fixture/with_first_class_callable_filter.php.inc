<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersToAsTwigFilterAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class WithFirstClassCallableFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new \Twig\TwigFilter('some_filter', $this->someFilter(...)),
            new \Twig\TwigFilter('another_filter', $this->anotherFilter(...)),
            new \Twig\TwigFilter('third_filter', $this->thirdFilter(...)),
        ];
    }

    public function someFilter($value)
    {
        return $value;
    }

    protected function anotherFilter($value)
    {
        return $value;
    }

    private function thirdFilter($value)
    {
        return $value;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersToAsTwigFilterAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class WithFirstClassCallableFilter
{
    #[\Twig\Attribute\AsTwigFilter(name: 'some_filter')]
    public function someFilter($value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFilter(name: 'another_filter')]
    public function anotherFilter($value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFilter(name: 'third_filter')]
    public function thirdFilter($value)
    {
        return $value;
    }
}

?>
