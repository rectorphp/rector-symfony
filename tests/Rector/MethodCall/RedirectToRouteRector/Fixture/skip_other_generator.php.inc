<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\RedirectToRouteRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkipController extends AbstractController
{
    public function someAction(SomeGenerator $generator)
    {
        return $this->redirect($generator->generateUrl());
    }
}

?>
