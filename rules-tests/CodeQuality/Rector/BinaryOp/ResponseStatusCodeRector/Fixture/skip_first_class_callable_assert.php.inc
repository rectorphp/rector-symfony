<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\BinaryOp\ResponseStatusCodeRector\Fixture;

final class SkipFirstClassCallableAssert
{
    public function assert(mixed $value): string
    {
        return (string) $value;
    }

    public function run(): array
    {
        return array_map($this->assert(...), ['a', 'b']);
    }
}
