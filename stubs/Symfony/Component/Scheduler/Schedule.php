<?php

declare(strict_types=1);

namespace Symfony\Component\Scheduler;

if (class_exists('Symfony\Component\Scheduler\Schedule')) {
    return;
}

use Symfony\Component\Scheduler\RecurringMessage;

class Schedule
{
    /**
     * @deprecated since Symfony 8.2
     */
    public function with(RecurringMessage $message, RecurringMessage ...$messages): static
    {
    }

    public function add(RecurringMessage $message, RecurringMessage ...$messages): static
    {
    }
}
