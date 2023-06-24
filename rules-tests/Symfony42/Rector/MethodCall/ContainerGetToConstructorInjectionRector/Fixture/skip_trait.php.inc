<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

trait SkipTrait
{
    protected function traitMethod()
    {
        $someService = $this->getContainer()->get('some_service');
    }
}
