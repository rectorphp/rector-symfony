<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\AttributeGroup\SingleConditionSecurityAttributeToIsGrantedRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class ControllerWithSecurityAttribute
{
    #[Security("has_role('SOME_USER')")]
    public function index()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\AttributeGroup\SingleConditionSecurityAttributeToIsGrantedRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class ControllerWithSecurityAttribute
{
    #[\Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted('SOME_USER')]
    public function index()
    {
    }
}

?>
