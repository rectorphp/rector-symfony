<?php

namespace Rector\Symfony\Tests\Rector\Class_\MakeCommandLazyRector\Fixture;

use Symfony\Component\Console\Command\Command;

final class SkipConstructorDependencyCommand extends Command
{
    public function __construct(InviteRegistrationGeneratorInterface $inviteRegistration)
    {
        parent::__construct();
    }
}
