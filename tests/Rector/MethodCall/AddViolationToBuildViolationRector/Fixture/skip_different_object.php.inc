<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AddViolationToBuildViolationRector\Fixture;

class SkipDifferentObject
{
    public function validate()
    {
        $this->context->addViolationAt();
    }
}
