<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ReplaceSensioRouteAnnotationWithSymfonyRector\Fixture;

use Symfony\Component\Routing\Annotation\Route;

final class SkipAlreadyRouteAnnotation
{
    /**
     * @Route()
     */
    public function run()
    {
    }
}
