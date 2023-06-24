<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

use Rector\Symfony\Tests\Symfony42\Rector\New_\StringToArrayArgumentProcessRector\Source\TraversableClass;

class TestClass
{
    public function foo(): void
    {
        (new TraversableClass())->someMethod('some string that should remain a string', ['test_key' => 'test value']);
    }
}
