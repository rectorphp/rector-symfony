<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\SecurityAttributeToIsGrantedAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class WithSecondArg
{
    #[Security("is_granted('ROLE_ADMIN', someArea)")]
    public function index()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\SecurityAttributeToIsGrantedAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class WithSecondArg
{
    #[\Symfony\Component\Security\Http\Attribute\IsGranted(attribute: 'ROLE_ADMIN', subject: 'someArea')]
    public function index()
    {
    }
}

?>
