<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Source;

final class NotResponse
{
    public function getStatusCode(): string
    {
        return 'foo';
    }
}
