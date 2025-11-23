<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SkipParamFetcher extends AbstractController
{
    public function someAction(\FOS\RestBundle\Request\ParamFetcher $paramFetcher)
    {
    }
}
