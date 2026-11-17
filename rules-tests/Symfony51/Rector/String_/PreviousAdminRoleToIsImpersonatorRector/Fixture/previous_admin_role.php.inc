<?php

namespace Rector\Symfony\Tests\Symfony51\Rector\String_\PreviousAdminRoleToIsImpersonatorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PreviousAdminRole extends AbstractController
{
    public function run()
    {
        return $this->isGranted('ROLE_PREVIOUS_ADMIN');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony51\Rector\String_\PreviousAdminRoleToIsImpersonatorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PreviousAdminRole extends AbstractController
{
    public function run()
    {
        return $this->isGranted('IS_IMPERSONATOR');
    }
}

?>
