<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersAndFunctionsToAsTwigAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class GetFunctionsAndFilters extends AbstractExtension
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

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersAndFunctionsToAsTwigAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class GetFunctionsAndFilters
{
    #[\Twig\Attribute\AsTwigFunction(name: 'some_function')]
    public function someFunction($value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFilter(name: 'some_filter')]
    public function someFilter($value)
    {
        return $value;
    }
}

?>
