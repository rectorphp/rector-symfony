<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

abstract class OnlyRemoveInterfaceFromAbstractClass implements MessageHandlerInterface
{
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

abstract class OnlyRemoveInterfaceFromAbstractClass
{
}

?>
