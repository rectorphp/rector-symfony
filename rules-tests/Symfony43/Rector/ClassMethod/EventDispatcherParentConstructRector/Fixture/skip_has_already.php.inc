<?php

namespace Rector\Symfony\Tests\Symfony43\Rector\ClassMethod\EventDispatcherParentConstructRector\Fixture;

use Symfony\Component\EventDispatcher\EventDispatcher;

final class SkipHasAlready extends EventDispatcher
{
    public function __construct()
    {
        parent::__construct();
        echo 'here is missing parent call';
    }
}
