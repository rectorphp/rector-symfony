<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\SplitAndSecurityAttributeToIsGrantedRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

#[Security("(is_granted('ROLE_USER') and is_granted('ROLE_ADMIN')) or is_granted('ROLE_SUDO')")]
final class TwoSecurityAttributes
{

}
