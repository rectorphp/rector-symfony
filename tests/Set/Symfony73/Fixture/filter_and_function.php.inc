<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersToAsTwigFilterAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SomeGetFilterAndFunction extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new \Twig\TwigFilter('some_filter', [$this, 'someFilter']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('some_function', [$this, 'someFunction']),
        ];
    }

    public function someFilter($value)
    {
        return $value;
    }

    public function someFunction($value)
    {
        return $value;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersToAsTwigFilterAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SomeGetFilterAndFunction
{
    #[\Twig\Attribute\AsTwigFilter(name: 'some_filter')]
    public function someFilter($value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFunction(name: 'some_function')]
    public function someFunction($value)
    {
        return $value;
    }
}

?>
