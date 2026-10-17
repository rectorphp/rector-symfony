<?php

namespace Rector\Symfony\Tests\HttpFoundation\Rector\New_\CookieConstructorDefaultsRector\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

final class ConstructorDefaults
{
    public function run()
    {
        return new Cookie('name', 'value', 0, '/', null, false, true, false, null);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\HttpFoundation\Rector\New_\CookieConstructorDefaultsRector\Fixture;

use Symfony\Component\HttpFoundation\Cookie;

final class ConstructorDefaults
{
    public function run()
    {
        return new Cookie('name', 'value', 0, '/', null, null, true, false, 'lax');
    }
}

?>
