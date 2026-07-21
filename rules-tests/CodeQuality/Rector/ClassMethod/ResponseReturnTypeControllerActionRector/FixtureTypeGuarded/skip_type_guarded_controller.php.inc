<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\FixtureTypeGuarded;

use Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Source\AbstractCustomController;
use Symfony\Component\Routing\Annotation\Route;

class SkipTypeGuardedController extends AbstractCustomController
{
    #[Route]
    public function detail()
    {
        return $this->render('some_template');
    }
}
