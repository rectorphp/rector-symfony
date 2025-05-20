<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\New_\RegexToSlugConstraintRector\Fixture;

use Symfony\Component\Validator\Constraints\Regex;

class ReplaceParamArraySyntax
{
    public function createConstraint()
    {
        return new Regex(['pattern' => '/^[a-z0-9]+(?:-[a-z0-9]+)*$/']);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\New_\RegexToSlugConstraintRector\Fixture;

use Symfony\Component\Validator\Constraints\Regex;

class ReplaceParamArraySyntax
{
    public function createConstraint()
    {
        return new Symfony\Component\Validator\Constraints\Slug();
    }
}

?>
