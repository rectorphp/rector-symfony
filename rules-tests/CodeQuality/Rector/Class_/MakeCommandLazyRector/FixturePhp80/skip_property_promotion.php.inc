<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\MakeCommandLazyRector\FixturePhp80;

use Symfony\Component\Console\Command\Command;

final class SkipPropertyPromotion extends Command
{
    public function __construct(
        private InviteRegistrationGeneratorInterface $inviteRegistration
    ) {
        parent::__construct();
    }
}
