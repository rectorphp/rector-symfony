<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\FormBuilderSetDataMapperRector\Fixture;

class SkipNotFormBuilder
{
    public function run()
    {
        $d = new \DateTime('now');
        $d->format('Y-m-d');
    }
}
