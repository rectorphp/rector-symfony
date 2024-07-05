<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\SecurityAttributeToIsGrantedAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class SingleIsGranted
{
    #[Security("is_granted('ROLE_ADMIN')")]
    public function index()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\SecurityAttributeToIsGrantedAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class SingleIsGranted
{
    #[\Symfony\Component\Security\Http\Attribute\IsGranted(attribute: 'ROLE_ADMIN')]
    public function index()
    {
    }
}

?>
