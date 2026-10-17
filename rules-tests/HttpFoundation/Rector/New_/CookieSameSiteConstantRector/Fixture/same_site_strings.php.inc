<?php

namespace Rector\Symfony\Tests\HttpFoundation\Rector\New_\CookieSameSiteConstantRector\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

final class SameSiteStrings
{
    public function run(Cookie $cookie)
    {
        $new = new Cookie('name', 'value', 0, '/', null, false, true, false, 'lax');
        $created = Cookie::create('name', 'value', 0, '/', null, false, true, false, 'none');
        $with = $cookie->withSameSite('strict');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\HttpFoundation\Rector\New_\CookieSameSiteConstantRector\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

final class SameSiteStrings
{
    public function run(Cookie $cookie)
    {
        $new = new Cookie('name', 'value', 0, '/', null, false, true, false, \Symfony\Component\HttpFoundation\Cookie::SAMESITE_LAX);
        $created = Cookie::create('name', 'value', 0, '/', null, false, true, false, \Symfony\Component\HttpFoundation\Cookie::SAMESITE_NONE);
        $with = $cookie->withSameSite(\Symfony\Component\HttpFoundation\Cookie::SAMESITE_STRICT);
    }
}

?>
