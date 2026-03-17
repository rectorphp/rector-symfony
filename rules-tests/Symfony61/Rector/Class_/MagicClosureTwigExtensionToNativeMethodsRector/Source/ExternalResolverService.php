<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\MagicClosureTwigExtensionToNativeMethodsRector\Source;

final class ExternalResolverService
{
    public function resolve(mixed $value): mixed
    {
        return $value;
    }
}
