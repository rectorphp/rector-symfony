<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Source\SmsNotification;

final class ManualSmsNotificationHandler
{
    public function __invoke(SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Source\SmsNotification;

#[\Symfony\Component\Messenger\Attribute\AsMessageHandler(priority: 10, fromTransport: 'async')]
final class ManualSmsNotificationHandler
{
    public function __invoke(SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}

?>
