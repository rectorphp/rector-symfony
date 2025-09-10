<?php

namespace Rector\Symfony\Tests\Set\Symfony42\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

class ReplaceNewCookieAndCreateParameterValue
{
    public function run()
    {
        $cookie = Cookie::create('name', 'value', 0, '/', null, false, true, false, 'none');

        return new Cookie('name', 'value', 0, '/', null, false, true, false, 'none');
    }
}

?>

-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony42\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

class ReplaceNewCookieAndCreateParameterValue
{
    public function run()
    {
        $cookie = Cookie::create('name', 'value', 0, '/', null, false, true, false, \Symfony\Component\HttpFoundation\Cookie::SAMESITE_NONE);

        return \Symfony\Component\HttpFoundation\Cookie::create('name', 'value', 0, '/', null, false, true, false, \Symfony\Component\HttpFoundation\Cookie::SAMESITE_NONE);
    }
}

?>

