<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Source\AbstractClassWithHandlerInterface;

class ClassThatExtendsAbstractClassThatImplementsHandler extends AbstractClassWithHandlerInterface
{
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Source\AbstractClassWithHandlerInterface;

#[\Symfony\Component\Messenger\Attribute\AsMessageHandler]
class ClassThatExtendsAbstractClassThatImplementsHandler extends AbstractClassWithHandlerInterface
{
}

?>
