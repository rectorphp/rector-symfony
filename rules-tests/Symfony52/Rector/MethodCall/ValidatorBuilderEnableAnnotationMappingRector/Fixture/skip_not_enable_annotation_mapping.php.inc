<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\MethodCall\ValidatorBuilderEnableAnnotationMappingRector\Fixture;

use Symfony\Component\Validator\ValidatorBuilder;

class SkipNotEnableAnnotationMapping
{
    public function run(ValidatorBuilder $builder)
    {
        $builder->foo();
    }
}
