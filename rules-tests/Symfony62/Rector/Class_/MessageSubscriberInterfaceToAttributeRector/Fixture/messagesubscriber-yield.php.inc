<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageSubscriberInterfaceToAttributeRector\Fixture;

use App\Message\OtherSmsNotification;
use App\Message\SmsNotification;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

class SmsNotificationHandler implements MessageSubscriberInterface
{
    public function __invoke(SmsNotification $message)
    {
        // ...
    }

    public function handleOtherSmsNotification(OtherSmsNotification $message)
    {
        // ...
    }

    public static function getHandledMessages(): iterable
    {
        // handle this message on __invoke
        yield SmsNotification::class;

        // also handle this message on handleOtherSmsNotification
        yield OtherSmsNotification::class => [
            'method' => 'handleOtherSmsNotification',
            'priority' => 12,
            'bus' => 'messenger.bus.default',
        ];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\MessageSubscriberInterfaceToAttributeRector\Fixture;

use App\Message\OtherSmsNotification;
use App\Message\SmsNotification;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

class SmsNotificationHandler
{
    #[\Symfony\Component\Messenger\Attribute\AsMessageHandler]
    public function handleSmsNotification(SmsNotification $message)
    {
        // ...
    }
    #[\Symfony\Component\Messenger\Attribute\AsMessageHandler(priority: 12, bus: 'messenger.bus.default')]
    public function handleOtherSmsNotification(OtherSmsNotification $message)
    {
        // ...
    }
}

?>
