<?php

namespace Rector\Symfony\Tests\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use App\Message\SmsNotification;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

#[\Acme\DemoAttribute]
class DemoSmsNotificationHandler implements MessageHandlerInterface
{
    public function __invoke(SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use App\Message\SmsNotification;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

#[\Symfony\Component\Messenger\Attribute\AsMessageHandler]
#[\Acme\DemoAttribute]
class DemoSmsNotificationHandler
{
    public function __invoke(SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}

?>
