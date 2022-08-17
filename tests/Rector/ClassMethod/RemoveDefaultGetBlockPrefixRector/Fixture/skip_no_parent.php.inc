<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\Fixture;

final class SkipNoParent
{
    public function getBlockPrefix()
    {
        return 'unique';
    }
}
