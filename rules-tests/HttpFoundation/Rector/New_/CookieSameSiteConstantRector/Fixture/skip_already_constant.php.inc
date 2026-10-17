<?php

namespace Rector\Symfony\Tests\HttpFoundation\Rector\New_\CookieSameSiteConstantRector\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

final class SkipAlreadyConstant
{
    public function run(Cookie $cookie)
    {
        return $cookie->withSameSite(Cookie::SAMESITE_LAX);
    }
}
