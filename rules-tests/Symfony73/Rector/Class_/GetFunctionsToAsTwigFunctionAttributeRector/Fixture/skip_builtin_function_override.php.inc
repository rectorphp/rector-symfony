<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class SkipBuiltinFunctionOverride extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            // Override the built-in include function with higher priority
            new TwigFunction('include', $this->includeWithEvent(...), [
                'needs_environment' => true,
                'needs_context'     => true,
                'is_safe'           => ['html'],
            ]),
        ];
    }

    public function includeWithEvent(\Twig\Environment $env, array $context, $template)
    {
        return $template;
    }
}
