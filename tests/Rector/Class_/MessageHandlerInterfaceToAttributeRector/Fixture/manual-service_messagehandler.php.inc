<?php

namespace Rector\Symfony\Tests\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use App\Message\SmsNotification;

class ManualSmsNotificationHandler
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

#[\Symfony\Component\Messenger\Attribute\AsMessageHandler(priority: 10, fromTransport: 'async')]
class ManualSmsNotificationHandler
{
    public function __invoke(SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}

?>
