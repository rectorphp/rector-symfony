<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\Fixture;

use Rector\Symfony\Tests\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\Source\CustomType;

final class SkipExtendingCustomType extends CustomType
{
    public function getBlockPrefix()
    {
        return 'anything';
    }
}
