<?php

namespace Rector\Symfony\Tests\Set\Symfony44\Fixture;

use Symfony\Component\WebLink\Link;

class ReplaceWithoutRelParameterValue
{
    public function run()
    {
        $link = new Link();
        return $link->withoutRel('preload');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony44\Fixture;

use Symfony\Component\WebLink\Link;

class ReplaceWithoutRelParameterValue
{
    public function run()
    {
        $link = new Link();
        return $link->withoutRel(\Symfony\Component\WebLink\Link::REL_PRELOAD);
    }
}

?>
