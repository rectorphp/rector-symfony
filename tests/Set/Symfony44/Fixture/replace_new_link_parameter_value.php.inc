<?php

namespace Rector\Symfony\Tests\Set\Symfony44\Fixture;

use Symfony\Component\WebLink\Link;

class ReplaceNewLinkParameterValue
{
    public function run()
    {
        return new Link('preload');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony44\Fixture;

use Symfony\Component\WebLink\Link;

class ReplaceNewLinkParameterValue
{
    public function run()
    {
        return new Link(\Symfony\Component\WebLink\Link::REL_PRELOAD);
    }
}

?>
