<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\AttributeGroup\SingleConditionSecurityAttributeToIsGrantedRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

final class SkipMultiples
{
    #[Security("has_role('SOME_USER') or has_role('SOME_USER2')")]
    public function index()
    {
    }
}
