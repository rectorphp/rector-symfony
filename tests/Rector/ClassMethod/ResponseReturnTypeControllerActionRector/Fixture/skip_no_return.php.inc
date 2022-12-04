<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SkipNoReturn extends AbstractController
{
    #[Route]
    public function detail()
    {
    }
}
