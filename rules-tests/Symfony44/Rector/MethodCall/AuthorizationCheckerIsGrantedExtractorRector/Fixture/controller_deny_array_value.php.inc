<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccessController extends AbstractController
{
    public function someMethod()
    {
        if ($this->isGranted(['ROLE_USER', 'ROLE_ADMIN'])) {

        }
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccessController extends AbstractController
{
    public function someMethod()
    {
        if ($this->isGranted('ROLE_USER') || $this->isGranted('ROLE_ADMIN')) {

        }
    }
}

?>
