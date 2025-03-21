<?php

declare(strict_types=1);

namespace Rector\Symfony\Enum;

final class SymfonyAttribute
{
    /**
     * @var string
     */
    public const AUTOWIRE = 'Symfony\Component\DependencyInjection\Attribute\Autowire';

    /**
     * @var string
     */
    public const AS_COMMAND = 'Symfony\Component\Console\Attribute\AsCommand';

    /**
     * @var string
     */
    public const COMMAND_OPTION = 'Symfony\Component\Console\Attribute\Command\Option';

    /**
     * @var string
     */
    public const COMMAND_ARGUMENT = 'Symfony\Component\Console\Attribute\Command\Argument';

    /**
     * @var string
     */
    public const EVENT_LISTENER_ATTRIBUTE = 'Symfony\Component\EventDispatcher\Attribute\AsEventListener';

    /**
     * @var string
     */
    public const ROUTE = 'Symfony\Component\Routing\Attribute\Route';
}
