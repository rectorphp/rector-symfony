<?php

namespace Rector\Symfony\Tests\Rector\New_\PropertyAccessorCreationBooleanToFlagsRector\Fixture;

use Symfony\Component\PropertyAccess\PropertyAccessor;

class SkipNoArg
{
    public function createPropertyAccessor()
    {
        return new PropertyAccessor();
    }
}
