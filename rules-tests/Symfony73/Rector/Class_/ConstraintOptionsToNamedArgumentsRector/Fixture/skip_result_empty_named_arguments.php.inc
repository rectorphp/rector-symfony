<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Component\Validator\Constraints\GroupSequence;

final class SkipResultEmptyNamedArguments
{
    public function run(bool $param)
    {
        $constraints = new GroupSequence(['group1', 'group2']);
    }
}
