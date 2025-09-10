<?php

namespace Rector\Symfony\Tests\Set\Symfony51\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

class ReplaceCookieWithSameSiteParameterValue
{
    public function run()
    {
        $cookie = Cookie::create('name');
        $cookie->withSameSite('none');

        return $cookie;
    }
}

?>

-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony51\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

class ReplaceCookieWithSameSiteParameterValue
{
    public function run()
    {
        $cookie = Cookie::create('name');
        $cookie->withSameSite(\Symfony\Component\HttpFoundation\Cookie::SAMESITE_NONE);

        return $cookie;
    }
}

?>

