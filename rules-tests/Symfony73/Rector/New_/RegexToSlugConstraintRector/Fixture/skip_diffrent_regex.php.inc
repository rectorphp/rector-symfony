<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\New_\RegexToSlugConstraintRector\Fixture;

use Symfony\Component\Validator\Constraints\Regex;

class SkipDifferentRegex
{
    public function createConstraint()
    {
        return new Regex('/^[a-z0-9]$/');
    }
}

?>
