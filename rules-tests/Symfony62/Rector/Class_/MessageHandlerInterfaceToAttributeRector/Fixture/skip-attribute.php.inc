<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use App\Message\SmsNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SkipSmsNotificationHandler
{
    public function __invoke(SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}

?>
