<?php

namespace Rector\Symfony\Tests\Set\Symfony44\Fixture;

use Symfony\Component\WebLink\Link;

class ReplaceWithRelParameterValue
{
    public function run()
    {
        $link = new Link();
        return $link->withRel('preload');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony44\Fixture;

use Symfony\Component\WebLink\Link;

class ReplaceWithRelParameterValue
{
    public function run()
    {
        $link = new Link();
        return $link->withRel(\Symfony\Component\WebLink\Link::REL_PRELOAD);
    }
}

?>
