<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Annotation\Route;

final class SkipPublicSetterWithoutReturn extends Controller
{
    /**
     * @Route("/some-action", name="some_action")
     */
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);

        $this->getRequest()->getSomething();
    }
}
