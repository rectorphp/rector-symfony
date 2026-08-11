<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersAndFunctionsToAsTwigAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

final class SharedMethodFilterAndFunction extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('simple_array_to_html', $this->simpleArrayToHtml(...), ['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('normalize_string_value', $this->normalizeStringValue(...)),
            new TwigFunction('simple_array_to_html', $this->simpleArrayToHtml(...), ['is_safe' => ['html']]),
        ];
    }

    public function normalizeStringValue(string $value): string
    {
        return $value;
    }

    public function simpleArrayToHtml(array $values): string
    {
        return implode('<br />', $values);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFiltersAndFunctionsToAsTwigAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

final class SharedMethodFilterAndFunction
{
    #[\Twig\Attribute\AsTwigFunction(name: 'normalize_string_value')]
    public function normalizeStringValue(string $value): string
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFilter(name: 'simple_array_to_html', isSafe: ['html'])]
    #[\Twig\Attribute\AsTwigFunction(name: 'simple_array_to_html', isSafe: ['html'])]
    public function simpleArrayToHtml(array $values): string
    {
        return implode('<br />', $values);
    }
}

?>
