<?php

namespace Rector\Symfony\Tests\Rector\Class_\MakeCommandLazyRector\FixturePhp80;

use Rector\Symfony\Tests\Rector\Class_\MakeCommandLazyRector\SourcePhp80\ParentClassWithPromotedPropertyCommand;

final class SkipNonStringCommandName extends ParentClassWithPromotedPropertyCommand
{
    public function __construct(string $foo)
    {
        parent::__construct($foo);
    }
}
