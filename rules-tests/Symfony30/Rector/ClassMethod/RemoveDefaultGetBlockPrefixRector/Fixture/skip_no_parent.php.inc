<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\Fixture;

final class SkipNoParent
{
    public function getBlockPrefix()
    {
        return 'unique';
    }
}
