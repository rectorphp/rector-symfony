<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Component\Validator\Constraints\Count;

new Count(['min' => 1, 'groups' => ['one']], groups: ['two']);
