<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\Fixture;

use Symfony\Component\Form\AbstractType;

class SkipDifferentNameType extends AbstractType
{
    public function getBlockPrefix()
    {
        return 'unique';
    }
}
