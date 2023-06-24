<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\MethodCall\ValidatorBuilderEnableAnnotationMappingRector\Fixture;

use Symfony\Component\Validator\ValidatorBuilder;

class SkipNotReaderArg
{
    public function run(ValidatorBuilder $builder, $variable)
    {
        $builder->enableAnnotationMapping($variable);
    }
}
