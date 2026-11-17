<?php

namespace Rector\Symfony\Tests\Symfony51\Rector\String_\PreviousAdminRoleToIsImpersonatorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SkipOtherRole extends AbstractController
{
    public function run()
    {
        return $this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_PREVIOUS_ADMIN_EXTRA');
    }
}
