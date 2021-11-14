<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

trait SkipTrait
{
    protected function traitMethod()
    {
        $someService = $this->getContainer()->get('some_service');
    }
}
