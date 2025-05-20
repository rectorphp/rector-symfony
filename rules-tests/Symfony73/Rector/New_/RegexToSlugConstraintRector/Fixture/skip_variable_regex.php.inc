<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\New_\RegexToSlugConstraintRector\Fixture;

use Symfony\Component\Validator\Constraints\Regex;

class SkipDifferentRegex
{
    public function createConstraint(string $regex = '/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
    {
        return new Regex($regex);
    }
}

?>
