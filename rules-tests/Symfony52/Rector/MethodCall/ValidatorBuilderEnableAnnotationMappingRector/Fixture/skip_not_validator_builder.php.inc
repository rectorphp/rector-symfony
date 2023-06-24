<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\MethodCall\ValidatorBuilderEnableAnnotationMappingRector\Fixture;

class SkipNotValidatorBuilder
{
    public function run()
    {
        $d = new \DateTime('now');
        $d->format('Y-m-d');
    }
}
