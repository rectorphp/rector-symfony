<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\MagicClosureTwigExtensionToNativeMethodsRector\Fixture;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Rector\Symfony\Tests\Symfony61\Rector\Class_\MagicClosureTwigExtensionToNativeMethodsRector\Source\ExternalResolverService;

final class SkipExternalNonStaticMethod extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('resolve', [ExternalResolverService::class, 'resolve']),
        ];
    }
}
