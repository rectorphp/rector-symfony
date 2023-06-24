<?php

namespace Rector\Symfony\Tests\Symfony25\Rector\MethodCall\AddViolationToBuildViolationRector\Fixture;

class SkipDifferentObject
{
    public function validate()
    {
        $this->context->addViolationAt();
    }
}
