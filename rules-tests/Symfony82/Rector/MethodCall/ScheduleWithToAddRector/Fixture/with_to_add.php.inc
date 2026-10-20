<?php

namespace Rector\Symfony\Tests\Symfony82\Rector\MethodCall\ScheduleWithToAddRector\Fixture;

use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Schedule;

final class WithToAdd
{
    public function getSchedule(RecurringMessage $recurringMessage): Schedule
    {
        return (new Schedule())->with($recurringMessage);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony82\Rector\MethodCall\ScheduleWithToAddRector\Fixture;

use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Schedule;

final class WithToAdd
{
    public function getSchedule(RecurringMessage $recurringMessage): Schedule
    {
        return (new \Symfony\Component\Scheduler\Schedule())->add($recurringMessage);
    }
}

?>
