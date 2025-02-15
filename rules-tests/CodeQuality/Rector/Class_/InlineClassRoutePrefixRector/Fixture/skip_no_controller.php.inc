<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/city")
 */
final class SkipNoController
{
    /**
     * @Route("/street")
     */
    public function some()
    {
    }
}
