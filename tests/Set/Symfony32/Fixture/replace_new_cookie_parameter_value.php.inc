<?php

namespace Rector\Symfony\Tests\Set\Symfony32\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

class ReplaceNewCookieParameterValue
{
    public function run()
    {
        return new Cookie('name', 'value', 0, '/', null, false, true, false, 'lax');
    }
}

?>

-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony32\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

class ReplaceNewCookieParameterValue
{
    public function run()
    {
        return new Cookie('name', 'value', 0, '/', null, false, true, false, \Symfony\Component\HttpFoundation\Cookie::SAMESITE_LAX);
    }
}

?>
