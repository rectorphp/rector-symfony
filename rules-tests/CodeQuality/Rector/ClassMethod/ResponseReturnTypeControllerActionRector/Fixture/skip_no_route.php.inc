<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SkipNoRoute extends AbstractController
{
    public function detail()
    {
        return $this->render('some_template');
    }
}
