<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\CascadeValidationFormBuilderRector\Fixture;

final class SkipUnknownValue
{
    public function run()
    {
        return [
            [parent::PARAMETER => 'cat_id'],
        ];
    }
}
