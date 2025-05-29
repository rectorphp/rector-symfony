<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\New_\RegexToSlugConstraintRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;

class ReplaceWithAlias
{
    public function createConstraint()
    {
        return new Assert\Regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\New_\RegexToSlugConstraintRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;

class ReplaceWithAlias
{
    public function createConstraint()
    {
        return new Symfony\Component\Validator\Constraints\Slug();
    }
}

?>
