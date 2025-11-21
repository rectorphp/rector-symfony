<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\SomeConvertedEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SkipParamConverter extends AbstractController
{
    #[ParamConverter('entity', class: SomeConvertedEntity::class)]
    #[Route('/some-action', name: 'some_action')]
    public function someAction(SomeConvertedEntity $entity)
    {
    }
}
