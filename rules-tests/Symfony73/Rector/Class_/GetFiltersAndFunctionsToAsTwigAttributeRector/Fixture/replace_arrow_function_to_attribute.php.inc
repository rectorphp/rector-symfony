<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersAndFunctionsToAsTwigAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class CommandExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new Twig\TwigFilter('commandStatus', fn(?array $cronData): string => $this->commandStatus($cronData)),
        ];
    }

    public function commandStatus(?array $cronData): string
    {
        return 'table-danger';
    }
}

-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersAndFunctionsToAsTwigAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class CommandExtension
{
    #[\Twig\Attribute\AsTwigFilter(name: 'commandStatus')]
    public function commandStatus(?array $cronData): string
    {
        return 'table-danger';
    }
}
