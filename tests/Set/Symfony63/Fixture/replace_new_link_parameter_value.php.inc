<?php

namespace Rector\Symfony\Tests\Set\Symfony63\Fixture;

use Symfony\Component\WebLink\Link;

class ReplaceNewLinkParameterValue
{
    public function run()
    {
        return new Link('acl');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony63\Fixture;

use Symfony\Component\WebLink\Link;

class ReplaceNewLinkParameterValue
{
    public function run()
    {
        return new Link(\Symfony\Component\WebLink\Link::REL_ACL);
    }
}

?>
