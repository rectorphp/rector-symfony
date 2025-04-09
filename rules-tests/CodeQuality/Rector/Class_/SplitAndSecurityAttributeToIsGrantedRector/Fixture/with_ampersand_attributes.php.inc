<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\SplitAndSecurityAttributeToIsGrantedRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

#[Security("is_granted('ROLE_USER') && is_granted('ROLE_ADMIN')")]
final class WithAmpersandAttributes
{
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\SplitAndSecurityAttributeToIsGrantedRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

#[\Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted('ROLE_USER')]
#[\Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted('ROLE_ADMIN')]
final class WithAmpersandAttributes
{
}

?>
