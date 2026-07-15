<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Source;

final class View
{
    public static function create($data = null, ?int $statusCode = null, array $headers = []): self
    {
        return new self();
    }
}
