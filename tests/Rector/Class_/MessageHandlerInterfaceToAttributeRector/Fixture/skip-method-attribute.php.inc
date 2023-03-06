<?php

namespace Rector\Symfony\Tests\Rector\Class_\MessageHandlerInterfaceToAttributeRector\Fixture;

use App\Message\SmsNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

final readonly class SkipMethodSmsNotificationHandler
{

    #[AsMessageHandler]
    public function test(SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}

?>
