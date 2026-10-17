<?php

namespace Rector\Symfony\Tests\HttpFoundation\Rector\New_\CookieConstructorDefaultsRector\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

final class SkipNoDefaults
{
    public function run()
    {
        return new Cookie('name', 'value');
    }
}
