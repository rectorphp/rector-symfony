<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersAndFunctionsToAsTwigAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class GetFiltersAndTests extends AbstractExtension
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

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersAndFunctionsToAsTwigAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class GetFiltersAndTests
{
    #[\Twig\Attribute\AsTwigFilter(name: 'some_filter')]
    public function someFilter($value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigTest(name: 'some_test')]
    public function someTest($value)
    {
        return $value;
    }
}

?>
