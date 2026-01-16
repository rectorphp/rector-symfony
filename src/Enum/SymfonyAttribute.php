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

    public const string ROUTE = 'Symfony\Component\Routing\Attribute\Route';

    public const string IS_GRANTED = 'Symfony\Component\Security\Http\Attribute\IsGranted';

    public const string REQUIRED = 'Symfony\Contracts\Service\Attribute\Required';
}
