<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SomeGetFunctions extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('some_function', [$this, 'someFunction']),
            new \Twig\TwigFunction('another_function', $this->anotherFunction(...)),
        ];
    }

    public function someFunction($value)
    {
        return $value;
    }

    public function anotherFunction($value)
    {
        return $value;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SomeGetFunctions extends AbstractExtension
{
    #[\Twig\Attribute\AsTwigFunction]
    public function someFunction($value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFunction]
    public function anotherFunction($value)
    {
        return $value;
    }
}

?>
