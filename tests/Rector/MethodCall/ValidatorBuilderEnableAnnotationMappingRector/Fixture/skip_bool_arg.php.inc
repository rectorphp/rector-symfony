<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ValidatorBuilderEnableAnnotationMappingRector\Fixture;

use Symfony\Component\Validator\ValidatorBuilder;

class SkipBoolArg
{
    public function run(ValidatorBuilder $builder)
    {
        $builder->enableAnnotationMapping(true);
    }
}
