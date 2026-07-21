<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SkipReturnInClosureOnly extends AbstractController
{
    #[Route]
    public function detail()
    {
        $callback = function () {
            return 'hey';
        };

        $callback();
    }
}
