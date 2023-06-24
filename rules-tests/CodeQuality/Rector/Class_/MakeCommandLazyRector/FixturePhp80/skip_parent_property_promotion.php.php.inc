<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\MakeCommandLazyRector\FixturePhp80;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\MakeCommandLazyRector\Source\ParentClassWithPromotedPropertyCommand;

final class SkipParentPropertyPromotion extends ParentClassWithPromotedPropertyCommand
{
    protected static $defaultName = 'app:command';

    public function __construct(string $foo)
    {
        parent::__construct($foo);
    }
}
