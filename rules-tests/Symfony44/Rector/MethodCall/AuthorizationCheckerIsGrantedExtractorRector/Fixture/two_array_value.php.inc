<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class TwoArrayValue
{
    public function run(AuthorizationCheckerInterface $authorizationCheckerInterface)
    {
        $authorizationCheckerInterface->isGranted(['a', 'b']);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class TwoArrayValue
{
    public function run(AuthorizationCheckerInterface $authorizationCheckerInterface)
    {
        $authorizationCheckerInterface->isGranted('a') || $authorizationCheckerInterface->isGranted('b');
    }
}

?>
