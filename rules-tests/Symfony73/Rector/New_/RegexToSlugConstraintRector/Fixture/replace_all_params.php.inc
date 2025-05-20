<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\New_\RegexToSlugConstraintRector\Fixture;

use Symfony\Component\Validator\Constraints\Regex;

class ReplaceAllParams
{
    public function createConstraint()
    {
        return new Regex(pattern: '/[a-z0-9]+(?:-[a-z0-9]+)*/', message: 'some message', htmlPattern: null, match: null, normalizer: null, groups: ['Default'], payload: null, options: []);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\New_\RegexToSlugConstraintRector\Fixture;

use Symfony\Component\Validator\Constraints\Regex;

class ReplaceAllParams
{
    public function createConstraint()
    {
        return new Symfony\Component\Validator\Constraints\Slug(message: 'some message', groups: ['Default'], payload: null, options: []);
    }
}

?>
