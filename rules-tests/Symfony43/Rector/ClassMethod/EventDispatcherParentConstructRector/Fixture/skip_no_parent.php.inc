<?php

namespace Rector\Symfony\Tests\Symfony43\Rector\ClassMethod\EventDispatcherParentConstructRector\Fixture;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class SkipImplementsInterface implements EventDispatcherInterface
{
    public function __construct()
    {
        echo 'here is missing parent call';
    }
}
