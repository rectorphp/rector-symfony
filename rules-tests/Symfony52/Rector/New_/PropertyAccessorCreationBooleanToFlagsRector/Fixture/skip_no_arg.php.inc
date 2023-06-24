<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\New_\PropertyAccessorCreationBooleanToFlagsRector\Fixture;

use Symfony\Component\PropertyAccess\PropertyAccessor;

class SkipNoArg
{
    public function createPropertyAccessor()
    {
        return new PropertyAccessor();
    }
}
