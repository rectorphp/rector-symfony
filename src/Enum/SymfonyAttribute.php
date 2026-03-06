<?php

declare(strict_types=1);

namespace Rector\Symfony\Enum;

final class SymfonyAttribute
{
    public const string AUTOWIRE = 'Symfony\Component\DependencyInjection\Attribute\Autowire';

    public const string AS_COMMAND = 'Symfony\Component\Console\Attribute\AsCommand';

    public const string COMMAND_OPTION = 'Symfony\Component\Console\Attribute\Option';

    public const string COMMAND_ARGUMENT = 'Symfony\Component\Console\Attribute\Argument';

    public const string AS_EVENT_LISTENER = 'Symfony\Component\EventDispatcher\Attribute\AsEventListener';

    // Workflow listener attributes (Symfony 7.1+)
    public const string AS_ANNOUNCE_LISTENER = 'Symfony\Component\Workflow\Attribute\AsAnnounceListener';

    public const string AS_COMPLETED_LISTENER = 'Symfony\Component\Workflow\Attribute\AsCompletedListener';

    public const string AS_ENTER_LISTENER = 'Symfony\Component\Workflow\Attribute\AsEnterListener';

    public const string AS_ENTERED_LISTENER = 'Symfony\Component\Workflow\Attribute\AsEnteredListener';

    public const string AS_GUARD_LISTENER = 'Symfony\Component\Workflow\Attribute\AsGuardListener';

    public const string AS_LEAVE_LISTENER = 'Symfony\Component\Workflow\Attribute\AsLeaveListener';

    public const string AS_TRANSITION_LISTENER = 'Symfony\Component\Workflow\Attribute\AsTransitionListener';

    public const string ROUTE = 'Symfony\Component\Routing\Attribute\Route';

    public const string IS_GRANTED = 'Symfony\Component\Security\Http\Attribute\IsGranted';

    public const string REQUIRED = 'Symfony\Contracts\Service\Attribute\Required';
}
