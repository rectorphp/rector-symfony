<?php

namespace Rector\Symfony\Tests\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use App\Message\SmsNotification;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SmsNotificationHandler implements MessageHandlerInterface
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
class SmsNotificationHandler
{
    public function __invoke(SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}

?>
