<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\EventDispatcherParentConstructRector\Fixture;

use Symfony\Component\EventDispatcher\EventDispatcher;

final class SomeEventDispatcher extends EventDispatcher
{
    public function __construct()
    {
        echo 'here is missing parent call';
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\EventDispatcherParentConstructRector\Fixture;

use Symfony\Component\EventDispatcher\EventDispatcher;

final class SomeEventDispatcher extends EventDispatcher
{
    public function __construct()
    {
        echo 'here is missing parent call';
        parent::__construct();
    }
}

?>
