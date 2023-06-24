<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\MethodCall\FormBuilderSetDataMapperRector\Fixture;

use Symfony\Component\Form\FormConfigBuilderInterface;

class SkipNotSetDataMapper
{
    public function run(FormConfigBuilderInterface $builder)
    {
        $builder->foo();
    }
}
