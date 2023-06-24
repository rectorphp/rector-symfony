<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony43\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Source;

final class NotResponse
{
    public function getStatusCode(): string
    {
        return 'foo';
    }
}
