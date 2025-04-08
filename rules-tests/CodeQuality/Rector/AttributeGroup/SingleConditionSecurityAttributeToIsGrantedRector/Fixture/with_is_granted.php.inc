<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\AttributeGroup\SingleConditionSecurityAttributeToIsGrantedRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class WithIsGranted
{
    #[Security("is_granted('SOME_USER')")]
    public function index()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\AttributeGroup\SingleConditionSecurityAttributeToIsGrantedRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class WithIsGranted
{
    #[\Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted('SOME_USER')]
    public function index()
    {
    }
}

?>
