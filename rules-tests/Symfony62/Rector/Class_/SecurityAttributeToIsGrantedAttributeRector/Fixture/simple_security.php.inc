<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\SecurityAttributeToIsGrantedAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class SimpleSecurity
{
    #[Security("is_granted('ROLE_ADMIN') and is_granted('ROLE_FRIENDLY_USER')")]
    public function index()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\Class_\SecurityAttributeToIsGrantedAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class SimpleSecurity
{
    #[\Symfony\Component\Security\Http\Attribute\IsGranted(new \Symfony\Component\ExpressionLanguage\Expression("is_granted('ROLE_ADMIN') and is_granted('ROLE_FRIENDLY_USER')"))]
    public function index()
    {
    }
}

?>
