<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\FixtureTypeGuarded;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SkipTypeGuardedController extends AbstractController
{
    #[Route]
    public function detail()
    {
        return $this->render('some_template');
    }
}
