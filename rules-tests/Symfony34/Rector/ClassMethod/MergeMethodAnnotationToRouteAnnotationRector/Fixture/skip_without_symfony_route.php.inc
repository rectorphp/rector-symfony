<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\ClassMethod\MergeMethodAnnotationToRouteAnnotationRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SkipWithoutSymfonyRoute
{
    /**
     * @Method({"GET", "HEAD"})
     */
    public function show($id)
    {
    }
}
