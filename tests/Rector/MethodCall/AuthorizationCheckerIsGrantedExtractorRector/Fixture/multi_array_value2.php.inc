<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class MultiArrayValue2
{
    public function run(AuthorizationCheckerInterface $authorizationCheckerInterface)
    {
        $authorizationCheckerInterface->isGranted(['a', 'b', 'c', 'd']);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class MultiArrayValue2
{
    public function run(AuthorizationCheckerInterface $authorizationCheckerInterface)
    {
        $authorizationCheckerInterface->isGranted('a') || $authorizationCheckerInterface->isGranted('b') || $authorizationCheckerInterface->isGranted('c') || $authorizationCheckerInterface->isGranted('d');
    }
}

?>
