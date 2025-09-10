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
            new \Twig\TwigFunction('third_function', $this->thirdFunction(...)),
        ];
    }

    public function someFunction($value)
    {
        return $value;
    }

    protected function anotherFunction($value)
    {
        return $value;
    }

    private function thirdFunction($value)
    {
        return $value;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SomeGetFunctions
{
    #[\Twig\Attribute\AsTwigFunction('some_function')]
    public function someFunction($value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFunction('another_function')]
    public function anotherFunction($value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFunction('third_function')]
    public function thirdFunction($value)
    {
        return $value;
    }
}

?>
