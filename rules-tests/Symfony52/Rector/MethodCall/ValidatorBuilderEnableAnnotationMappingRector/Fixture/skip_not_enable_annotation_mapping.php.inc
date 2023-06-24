<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\MethodCall\ValidatorBuilderEnableAnnotationMappingRector\Fixture;

use Symfony\Component\Validator\ValidatorBuilder;

class SkipNotEnableAnnotatinoMapping
{
    public function run(ValidatorBuilder $builder)
    {
        $builder->foo();
    }
}
