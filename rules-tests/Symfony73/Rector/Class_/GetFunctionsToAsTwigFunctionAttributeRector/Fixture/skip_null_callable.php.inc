<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;

final class SkipNullCallable extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('some_function', [$this, 'someFunction']),
            new \Twig\TwigFunction('my_form_function', null, ['is_safe' => ['html']]),
        ];
    }

    public function someFunction($value)
    {
        return $value;
    }
}
