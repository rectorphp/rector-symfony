<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\GetHelperControllerToServiceRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SkipAnotherCall extends AbstractController
{
    public function run($another)
    {
        $productRepository = $another->dispatchMessage('hey');
    }
}
