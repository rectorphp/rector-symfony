<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class KeepBuiltinConvertCustom extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('include', $this->includeWithEvent(...), ['needs_environment' => true]),
            new TwigFunction('custom_function', [$this, 'customFunction']),
        ];
    }

    public function includeWithEvent(Environment $env, $template)
    {
        return $template;
    }

    public function customFunction($value)
    {
        return $value;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class KeepBuiltinConvertCustom extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('include', $this->includeWithEvent(...), ['needs_environment' => true]),
        ];
    }

    public function includeWithEvent(Environment $env, $template)
    {
        return $template;
    }

    #[\Twig\Attribute\AsTwigFunction(name: 'custom_function')]
    public function customFunction($value)
    {
        return $value;
    }
}

?>
