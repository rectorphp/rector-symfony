<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SingleArrayValue
{
    public function run(AuthorizationCheckerInterface $authorizationCheckerInterface)
    {
        $authorizationCheckerInterface->isGranted(['a']);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SingleArrayValue
{
    public function run(AuthorizationCheckerInterface $authorizationCheckerInterface)
    {
        $authorizationCheckerInterface->isGranted('a');
    }
}

?>
